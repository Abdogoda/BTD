<?php

namespace App\Repositories;

interface DoctorRepositoryInterface{
  public function all($perpage=6);
  public function find($id);
  public function update($id, array $data);
}