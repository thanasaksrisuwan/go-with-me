<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    protected $driverService;
    public function __construct(DriverService $driverService) {
        $this->driverService = $driverService;
    }
    public function show(Request $request)
    {
        return $this->driverService->getDriver($request);
    }

    public function update(StoreDriverRequest $request)
    {
        return $this->driverService->update($request);
    }
}
