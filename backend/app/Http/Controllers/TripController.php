<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\StoreTripRequest;
use App\Models\Trip;
use App\Services\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{
    use ResponseHelper;

    protected $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }
    public function show(Request $request, Trip $trip)
    {
        return $this->tripService->getTrip($request, $trip);
    }

    public function store(StoreTripRequest $request)
    {
        return $this->tripService->createTrip($request);
    }

    public function accept(Request $request, Trip $trip)
    {
        return $this->tripService->acceptTrip($request, $trip);
    }

    public function start(Request $request, Trip $trip)
    {
        return $this->tripService->startTrip($request, $trip);
    }

    public function end(Request $request, Trip $trip)
    {
        return $this->tripService->endTrip($request, $trip);
    }

    public function location(LocationRequest $request, Trip $trip)
    {
       return $this->tripService->updateTripLocation($request, $trip);
    }
}
