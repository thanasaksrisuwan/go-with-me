<?php

namespace App\Services;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreDriverRequest;
use Illuminate\Http\Request;

class DriverService {
    use ResponseHelper;

    public function getDriver(Request $request) {
        $user = $request->user();
        $user->load('driver');
        return $user;
    }

    public function update(StoreDriverRequest $request) {
        $user = $request->user();

        $user->update($request->only('name'));

        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'license_plate'
        ]));

        $user->load('driver');

        return $user;
    }
}