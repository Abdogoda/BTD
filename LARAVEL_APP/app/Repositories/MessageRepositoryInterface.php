<?php

namespace App\Repositories;

interface MessageRepositoryInterface{
  public function all();

  public function unreaded_count();

  public function read($id);
  
  public function read_all();

  public function delete($id);
}