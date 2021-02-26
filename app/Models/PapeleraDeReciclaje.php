<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PapeleraDeReciclaje extends Model {
  protected $table = 'papelera_de_reciclaje';
  protected $primaryKey = 'id';
  protected $guarded = [];

  public function papelera() {
    return $this->morphTo();
  }
  public function usuario(){
    return $this->belongsTo('App\Models\User', 'user_id');
  }
}
