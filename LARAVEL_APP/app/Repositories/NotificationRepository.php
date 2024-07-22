<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationRepository implements NotificationRepositoryInterface{

  protected $model;

  public function __construct(Notification $model){
    $this->model = $model;
  }

  public function all($notification_for, $doctor_id = null){
    if($doctor_id){
      return $this->model->where('notification_for', $notification_for)->where('doctor_id', $doctor_id)->orderBy('created_at', 'DESC')->get();
    }else{
      return $this->model->where('notification_for', $notification_for)->orderBy('created_at', 'DESC')->get();
    }
  }

  public function unreaded_count($notification_for, $doctor_id = null){
    if($doctor_id){
      return $this->model->where('notification_for', $notification_for)->where('read', 0)->where('doctor_id', $doctor_id)->count();
    }else{
      return $this->model->where('notification_for', $notification_for)->where('read', 0)->count();
    }
  }

  public function read($id){
    $record = $this->model->find($id);
    $record->read = 1;
    return $record->save();
  }
  
  public function read_all($notification_for, $doctor_id = null){
    if($doctor_id){
      $records = $this->model->where('notification_for', $notification_for)->where('doctor_id', $doctor_id)->get();
    }else{
      $records = $this->model->where('notification_for', $notification_for)->get();
    }
    foreach ($records as $record) {
      $record->read = 1;
      $record->save();
    }
    return true;
  }
  
    public function delete($id){
      $record = $this->model->find($id);
      return $record->delete();
    }
}