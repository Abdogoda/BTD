<?php

namespace App\Repositories;

use App\Models\Doctor;

class DoctorRepository implements DoctorRepositoryInterface{

  protected $model;

  public function __construct(Doctor $model){
    $this->model = $model;
  }

  public function all($perpage = 6){
    return $this->model->paginate($perpage);
  }

  public function find($id){
    return $this->model->find($id);
  }

  public function update($id, array $data){
    $record = $this->model->find($id);
    return $record->update($data);
  }

}