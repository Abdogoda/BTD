<?php

namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository implements AppointmentRepositoryInterface{

  protected $model;

  public function __construct(Appointment $model){
    $this->model = $model;
  }

  public function all($doctor_id, $status = null){
    if($status){
      return $this->model->where('doctor_id', $doctor_id)->where('status', $status)->orderBy('created_at', 'asc')->get();
    }else{
      return $this->model->where('doctor_id', $doctor_id)->orderBy('created_at', 'asc')->get();
    }
  }

  public function find($id){
    return $this->model->find($id);
  }

  public function create(array $data){
    return $this->model->create($data);
  }

  public function update_status($id, string $status){
    $record = $this->model->find($id);
    return $record->update(['status' => $status]);
  }

  public function delete($id){
    return $this->model->destroy($id);
  }
}