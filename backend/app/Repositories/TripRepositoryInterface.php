<?php

namespace App\Repositories;
use App\Models\Trip;

interface TripRepositoryInterface {
    public function create($data);
}