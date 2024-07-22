<?php

namespace App\Repositories;

interface SettingRepositoryInterface{
  public function all();

  public function create(array $data);

  public function update($id, array $data);
}