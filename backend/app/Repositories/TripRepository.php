<?php 
namespace App\Repositories;
use App\Models\Trip;

class TripRepository implements TripRepositoryInterface{
    protected $model;

    public function __construct(Trip $tripModel)
    {
        $this->model = $tripModel;
    }
    public function create($data) {
        return $this->model->create($data);
    }
}
