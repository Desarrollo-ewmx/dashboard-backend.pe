<?php
namespace App\Repositories\Sistema;

interface SistemaInterface {
  public function sistemaFindOrFail();

  public function update($request);
}