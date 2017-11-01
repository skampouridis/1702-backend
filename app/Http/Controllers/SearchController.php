<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Resources\SearchCollection;
use App\Http\Resources\Search as SearchResource;
use App\Http\Resources\VesselTrackCollection;
use App\Search;
use App\Vessel;
use App\VesselTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SearchCollection(Search::with('vessels')->get());
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $search = Search::with(['vessels','tracks'])->findOrFail($id);

        return new SearchResource($search);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function searchValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'ip' => 'required|ip',
            'vessels.*' => 'integer',
            'location.lat.from' => 'required_with:location.lat.to,location.lon.from,location.lon.to',
            'location.lat.to' => 'required_with:location.lat.from,location.lon.from,location.lon.to',
            'location.lon.from' => 'required_with:location.lat.from,location.lat.to,location.lon.to',
            'location.lon.to' => 'required_with:location.lat.from,location.lat.to,location.lon.from',
            'time.from' => 'date_format:Y-m-d H:i:s|required_with:time.to',
            'time.to' => 'date_format:Y-m-d H:i:s|required_with:time.from'
        ]);
    }

    /**
     * @param Request               $request
     * @param Client                $client
     * @param VesselTrackCollection $tracks
     * @param array                 $vessel_ids
     */
    private function save(Request $request, Client $client, VesselTrackCollection $tracks, $vessel_ids = [])
    {

        $vessel_track_ids = [];

        $search = new Search();
        $search->client_id = $client->id;
        $search->results = $tracks->count();

        if (!empty($request->location)) {
            $search->lat_from = $request->location['lat']['from'];
            $search->lat_to = $request->location['lat']['to'];
            $search->lon_from = $request->location['lon']['from'];
            $search->lon_to = $request->location['lon']['to'];
        }

        if (!empty($request->time)) {
            $search->time_from = $request->time['from'];
            $search->time_to = $request->time['to'];
        }

        if ($tracks->count()) {
            foreach ($tracks as $track) {
                $vessel_track_ids[] = $track->id;
            }
        }

        $search->save();

        $search->vessels()->attach($vessel_ids);
        $search->tracks()->attach($vessel_track_ids);

    }

    /**
     * Check if Client has reached Request limit
     * @param $client
     * @return bool
     */
    private function requestLimitReached(Client $client)
    {
        $requestLimit = 10;
        $beforeOneHour = date('Y-m-d H:i:s', strtotime('-1 days'));

        $requests = Search::where('client_id', '=', $client->id)
                          ->where('created_at', '>=', $beforeOneHour)
                          ->get();

        return $requests->count() >= $requestLimit;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {

        $request->merge(['ip' => $request->getClientIp()]);

        /** Validate Request Data */
        if ($validator = $this->searchValidator($request)->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ])->setStatusCode(408);
        }

        $client = Client::firstOrCreate(['ip' => $request->ip]);

        /** Check Request Limit */
        if ($this->requestLimitReached($client)) {
            return response()->json([
                'errors' => ['Request per hour limit reached. Limit is 10 Requests per hour']
            ])->setStatusCode(409);
        }

        $vesselTracks = VesselTrack::select('*');
        $vessel_ids = Vessel::whereIn('mmsi', $request->vessels)->pluck('id')->toArray();

        /** Vessels Filter on Tracks */
        if (sizeof($vessel_ids)) {
            $vesselTracks->whereIn('vessel_id', $vessel_ids);
        }

        /** Location range Filter on Tracks */
        if (!empty($request->location)) {

            $vesselTracks->whereBetween('lat', [
                $request->location['lat']['from'],
                $request->location['lat']['to']
            ]);

            $vesselTracks->whereBetween('lon', [
                $request->location['lon']['from'],
                $request->location['lon']['to']
            ]);

        }

        /** Time range Filter on Tracks */
        if (!empty($request->time)) {

            $vesselTracks->whereBetween('timestamp', [
                $request->time['from'],
                $request->time['to']
            ]);

        }

        /** execute search */
        $tracks = new VesselTrackCollection($vesselTracks->with('vessel')->get());

        /** Log search and results */
        $this->save($request, $client, $tracks, $vessel_ids);

        /** Response based to Client selection Available formats json, xml, csv */
        if (isset($request->response_format) && in_array($request->response_format, ['xml', 'csv'])) {
            if ($request->response_format == 'xml') {
                return response()->xml($tracks);
            } else if ($request->response_format == 'csv') {
                return response()->csv($tracks);
            }
        }

        return $tracks;

    }

}

