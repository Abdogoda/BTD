<?php

namespace App\Repositories;

interface ScheduleRepositoryInterface{
  public function all($id);

  public function find($id);

  public function create(array $data);

  public function update($id, array $data);

  public function delete($id);
}