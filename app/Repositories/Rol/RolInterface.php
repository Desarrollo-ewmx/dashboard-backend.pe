<?php
namespace App\Repositories\Rol;

interface RolInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

  public function store($request);

  public function update($request, $id_rol);
  
  public function getFindOrFail($id_rol, $relaciones);
}