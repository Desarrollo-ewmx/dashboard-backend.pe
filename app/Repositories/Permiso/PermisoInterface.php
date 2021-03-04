<?php
namespace App\Repositories\Permiso;

interface PermisoInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);
  
  public function getFindOrFail($id_permiso, $relaciones);

  public function update($request, $id_permiso);
  
  public function getAllCache();

  public function eliminarCache();
}