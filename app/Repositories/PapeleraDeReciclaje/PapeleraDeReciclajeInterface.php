<?php
namespace App\Repositories\PapeleraDeReciclaje;

interface PapeleraDeReciclajeInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

  public function getFindOrFail($id_registro);

  public function store($info);

  public function restore($id_registro);

  public function destroy($id_registro);

  public function destroyAllPapeleraByIdFk($id_registro, $id_consulta);

  public function tablas($registro, $metodo);
}