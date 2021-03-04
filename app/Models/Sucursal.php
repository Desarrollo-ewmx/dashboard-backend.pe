<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Sucursal extends Model {
  use HasFactory;
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'sucursales';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['etiquetas']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function usuarios() {
    return $this->belongsToMany('App\Models\User', 'user_sucursal');
  }
  public function etiquetas() {
    return $this->hasMany('App\Models\SucursalEtiqueta');
  }
  public function actividades() {
    return $this->morphMany('App\Models\Actividad', 'actividad');
  }
}
