<?php

namespace App\Repositories;

interface NotificationRepositoryInterface{
  public function all($notification_for, $doctor_id = null);

  public function unreaded_count($notification_for, $doctor_id = null);

  public function read($id);
  
  public function read_all($notification_for, $doctor_id = null);

  public function delete($id);
}