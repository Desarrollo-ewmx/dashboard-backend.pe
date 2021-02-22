<?php
namespace App\Repositories\Sucursal;

interface SucursalInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit);

  public function store($request);

  public function update($request, $id_sucursal);
  
  public function getFindOrFailCache($request);

  public function eliminarCache($id_sucursal);
}