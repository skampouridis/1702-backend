<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PositionController extends Controller
{
    /**
     * Holds the Request object
     *
     * @var Request
     */
    protected $request;

    /**
     * PositionController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        $positions = Position::query();

        // Check for valid mmsi, single or multiple
        if ($this->request->filled('mmsi')) {

            if (is_numeric($mmsi = $this->request->input('mmsi'))) { // Single
                $positions = $positions->where('mmsi', $mmsi);
            } else if (($commas = substr_count($mmsi, ',')) > 0 && count($mmsiArray = explode(',', $mmsi)) == $commas + 1) { // Multiple
                $positions = $positions->whereIn('mmsi', $mmsiArray);
            } else {
                throw new BadRequestHttpException();
            }
        }

        // Check for a valid longtitude_min
        if ($this->request->filled('longtitude_min')) {

            if (is_numeric($longtitude_min = $this->request->input('longtitude_min'))) {
                $positions = $positions->where('longtitude', '>=', $longtitude_min);
            } else {
                throw new BadRequestHttpException();
            }
        }

        // Check for a valid longtitude_max
        if ($this->request->filled('longtitude_max')) {

            if (is_numeric($longtitude_max = $this->request->input('longtitude_max'))) {
                $positions = $positions->where('longtitude', '<=', $longtitude_max);
            } else {
                throw new BadRequestHttpException();
            }
        }

        // Check for a valid latitude_min
        if ($this->request->filled('latitude_min')) {

            if (is_numeric($latitude_min = $this->request->input('latitude_min'))) {
                $positions = $positions->where('latitude', '>=', $latitude_min);
            } else {
                throw new BadRequestHttpException();
            }
        }

        // Check for a valid latitude_max
        if ($this->request->filled('latitude_max')) {

            if (is_numeric($latitude_max = $this->request->input('latitude_max'))) {
                $positions = $positions->where('latitude', '<=', $latitude_max);
            } else {
                throw new BadRequestHttpException();
            }
        }

        // Check for a valid time_min
        if ($this->request->filled('time_min')) {
            $positions = $positions->where('timestamp', '>=', $this->request->input('time_min'));
        }

        // Return an Eloquent collection of Positions
        return $positions->get();
    }

    /**
     * Returns a single Position based on its id.
     *
     * @param $id
     * @return Collection
     */
    public function get($id)
    {
        $position  = Position::findOrFail($id); // 404 if not found

        // Return an Eloquent collection with a single Position
        return Collection::make($position);
    }

    /**
     * Creates a new resource.
     *
     * @return Collection
     */
    public function create()
    {
        $position = Position::create($this->request->all());

        // Return an Eloquent collection with a single Position
        return Collection::make($position);
    }

    /**
     * Deletes a resource.
     *
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $position  = Position::findOrFail($id); // 404 if not found
        $position->delete();

        // Return the id of the deleted resource
        return response(['deleted_id' => $id]);
    }

    /**
     * Updates a resource.
     *
     * @param $id
     * @return Collection
     */
    public function update($id)
    {
        $position  = Position::findOrFail($id); // 404 if not found

        $position->fill($this->request->all());
        $position->save();

        // Return an Eloquent collection with a single Position
        return Collection::make($position);
    }
}