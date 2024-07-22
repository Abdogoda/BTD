<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface{

  protected $model;

  public function __construct(Setting $model){
    $this->model = $model;
  }
  
  public function all(){
    return $this->model->all();
  }

  public function create(array $data){
    return $this->model->create($data);
  }

  public function update($id, array $data){
    $record = $this->model->find($id);
    return $record->update($data);
  }
}