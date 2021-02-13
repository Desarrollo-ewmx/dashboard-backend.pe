<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class QuejaYSugerencia extends Model {
  use HasFactory;
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'quejas_y_sugerencias';
  protected $primaryKey = 'id';
  protected $guarded = [];
  
  protected $dates = ['deleted_at'];
  protected $softCascade = ['archivos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function usuario(){
    return $this->belongsTo('App\Models\User');
  }
  public function archivos() {
    return $this->belongsToMany('App\Models\Archivo', 'queja_y_sugerencia_archivo');
  }
  public function sucursales() {
    return $this->belongsToMany('App\Models\Sucursal', 'queja_y_sugerencia_sucursal');
  }
}
