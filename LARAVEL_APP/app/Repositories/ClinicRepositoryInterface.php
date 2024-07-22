<?php

namespace App\Repositories;

interface ClinicRepositoryInterface{
  public function all($id);

  public function find($id);

  public function create(array $data);

  public function update($id, array $data);

  public function delete($id);
}