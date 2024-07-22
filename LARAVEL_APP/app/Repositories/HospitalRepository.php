<?php

namespace App\Repositories;

use App\Models\Hospital;

class HospitalRepository implements HospitalRepositoryInterface{

  protected $model;

  public function __construct(Hospital $model){
    $this->model = $model;
  }

  public function all($perpage = 6){
    return $this->model->paginate($perpage);
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