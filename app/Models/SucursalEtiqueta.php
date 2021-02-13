<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class SucursalEtiqueta extends Model {
  use HasFactory;
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'sucursal_etiquetas';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
//  protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA
  
  public function sucursal() {
		return $this->belongsTo('App\Models\Sucursal');
  }
}