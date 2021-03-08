<?php
namespace App\Http\Requests\Sucursal;
use Illuminate\Foundation\Http\FormRequest;

class StoreSucursalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'suc'       => 'required|max:50|unique:sucursales,suc',
      'ser_cotiz' => 'required|max:150|exists:catalogos,value',
      'direc'     => 'required|max:200|string',


      "etiquetas"         => "array",
      'etiquetas.*.tip'   => 'required|max:2',
      'etiquetas.*.value' => 'required|max:2',
      'etiquetas.*.text'  => 'required|max:2',
      'etiquetas.*.url'   => 'required|max:2',
    ];
  }
  public function attributes() {
    return [
      'suc'       => 'sucursal',
      'ser_cotiz' => 'serie',
      'direc'     => 'dirección',

      
      'etiquetas.*.tip' => 'etiquetas (tipo)'

    ];
  }
}