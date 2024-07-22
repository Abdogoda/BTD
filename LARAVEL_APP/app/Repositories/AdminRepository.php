<?php

namespace App\Repositories;

use App\Models\User;

class AdminRepository implements AdminRepositoryInterface{

  protected $model;

  public function __construct(User $model){
    $this->model = $model;
  }

  public function all(){
    return $this->model->where('role', 'admin')->get();
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