<?php
namespace App\Repositories\Actividad;

interface ActividadInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $id_modelo);
}