<?php
namespace App\Repositories\Sucursal;

interface SucursalInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

  public function store($request);

  public function update($request, $id_sucursal);
  
  public function getFindOrFail($id_sucursal, $relaciones);
}