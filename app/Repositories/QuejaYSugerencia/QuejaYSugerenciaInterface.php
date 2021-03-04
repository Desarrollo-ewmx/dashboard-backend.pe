<?php
namespace App\Repositories\QuejaYSugerencia;

interface QuejaYSugerenciaInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

  public function store($request);
  
  public function getFindOrFail($id_queja_y_sugerencia, $relaciones);
}