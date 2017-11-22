<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\App\Controllers;

use App\Api\v1\Core\App\Controllers\Controller;
use App\Api\v1\MarineTraffic\VesselTrack\Domain\Repositories\VesselTrackRepository;
use App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests\FindByCoordinatesRange;
use App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests\FindByMmsi;
use App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests\FindByTimeInterval;
use Illuminate\Http\Request;

/**
 * Class VesselTrackController
 *
 * Vessel track controller will handle the request and will call the respective classes to validate the input and fetch the requested information.
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\App\Controllers
 */
class VesselTrackController extends Controller
{
    /**
     * Default message for successful response.
     *
     * @var string
     */
    protected $responseMessage = "Vessel tracks successfully received";

    /**
     * Default response code for the successful response
     *
     * @var int
     */
    protected $responseCode = 200;

    /**
     * The default status of the successful report
     *
     * @var string
     */
    protected $responseStatus = "success";

    /**
     * The VesselTrackRepository. It will be responsible to call the respective methods to fetch the data from the data source.
     *
     * @var VesselTrackRepository
     */
    protected $repository;

    /**
     * VesselTrackController constructor.
     *
     * @param VesselTrackRepository $repository
     */
    public function __construct(VesselTrackRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns all vessel tracks
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $data = $this->repository->all();

        return $this->toOutputFormat($request, $data);
    }

    /**
     * The method that handles the mmsi route.
     *
     * @param Request $request
     * @param $mmsi
     * @return array
     */
    public function findByMmsi(Request $request,$mmsi)
    {
        //call the validator
        $validator = new FindByMmsi($mmsi);
        $array = $validator
            ->validate()
            ->result();

        //fetch the data from the repository
        $data = $this->repository->findByMmsi($array);

        return $this->toOutputFormat($request, $data);
    }

    /**
     * The method that handles the time route.
     *
     * @param Request $request
     * @param $from
     * @param $to
     * @return array
     */
    public function findByTimeInterval(Request $request,$from,$to)
    {
        //call the validator
        $validator = new FindByTimeInterval($from,$to);
        $array = $validator
            ->validate()
            ->result();

        //fetch the data from the repository
        $data = $this->repository->findByTimeInterval($array);

        return $this->toOutputFormat($request, $data);
    }

    /**
     * The method that handles the coordinates route.
     *
     * @param Request $request
     * @param $from
     * @param $to
     * @return array
     */
    public function findByCoordinatesRange(Request $request,$from,$to)
    {
        //call the validator
        $validator = new FindByCoordinatesRange($from,$to);
        $array = $validator
            ->validate()
            ->result();

        //fetch the data from the repository
        $data = $this->repository->findByCoordinatesRange($array);

        return $this->toOutputFormat($request, $data);
    }
}
