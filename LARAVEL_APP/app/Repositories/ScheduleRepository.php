<?php

namespace App\Repositories;

use App\Models\ClinicSchedule;

class ScheduleRepository implements ScheduleRepositoryInterface{

  protected $model;

  public function __construct(ClinicSchedule $model){
    $this->model = $model;
  }

  public function all($doctor_id){
    return $this->model->where('doctor_id', $doctor_id)->get();
  }

  public function find($id){
    return $this->model->find($id);
  }

  public function create(array $data){
    return $this->model->create($data);
  }

  public function update($id, array $data){
    $record = $this->model->find($id);
    return $record->update($data);
  }

  public function delete($id){
    return $this->model->destroy($id);
  }
}