<?php

namespace App\Services;
use App\Events\TripAccepted;
use App\Events\TripCreated;
use App\Events\TripEnded;
use App\Events\TripLocationUpdated;
use App\Events\TripStarted;
use App\Helpers\ResponseHelper;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripService
{
    use ResponseHelper;

    public function getTrip(Request $request, Trip $trip)
    {
        if ($trip->user_id === $request->user()->id) {
            return $trip;
        }

        if ($trip->driver && $request->user()->driver) {
            if ($trip->driver->id === $request->user()->driver->id) {
                return $trip;
            }
        }

        return $this->errorResponse('Error trip not found.', 404);
    }

    public function createTrip($request)
    {
        $trip = $request->user()->trips()->create($request->only([
            'origin',
            'destination',
            'destination_name'
        ]));

        try {
            TripCreated::dispatch($trip, $request->user());
            return $this->successResponse('Trip created successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function acceptTrip(Request $request, Trip $trip)
    {
        $request->validate([
            'driver_location' => 'required'
        ]);

        $trip->update([
            'driver_id' => $request->user()->id,
            'driver_location' => $request->driver_location
        ]);

        $trip->load('driver.user');

        try {
            TripAccepted::dispatch($trip, $trip->user());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $trip;
    }

    public function startTrip(Request $request, Trip $trip)
    {
        $trip->update([
            'is_started' => true
        ]);

        $trip->load('driver.user');

        try {
            TripStarted::dispatch($trip, $trip->user());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $trip;
    }

    public function endTrip(Request $request, Trip $trip)
    {
        $trip->update([
            'is_completed' => true
        ]);

        $trip->load('driver.user');

        try {
            TripEnded::dispatch($trip, $trip->user());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $trip;
    }

    public function updateTripLocation(Request $request, Trip $trip)
    {
        $trip->update([
            'driver_location' => $request->driver_location
        ]);

        $trip->load('driver.user');

        try {
            TripLocationUpdated::dispatch($trip, $trip->user());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $trip;
    }
}