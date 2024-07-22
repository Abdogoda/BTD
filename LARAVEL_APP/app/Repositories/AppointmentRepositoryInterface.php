<?php

namespace App\Repositories;

interface AppointmentRepositoryInterface{
  public function all($id, $status=null);

  public function find($id);

  public function create(array $data);

  public function update_status($id, string $status);

  public function delete($id);
}