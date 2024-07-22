<?php

namespace App\Repositories;

use App\Models\Tumor;

class TumorRepository implements TumorRepositoryInterface{

  protected $model;

  public function __construct(Tumor $model){
    $this->model = $model;
  }

  public function all(){
    return $this->model->all();
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