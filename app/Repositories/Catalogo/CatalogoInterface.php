<?php
namespace App\Repositories\Catalogo;

interface CatalogoInterface {
  public function store($request);
  
  public function getAllCache($input);
}