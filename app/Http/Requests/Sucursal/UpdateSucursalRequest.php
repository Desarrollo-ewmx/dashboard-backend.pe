<?php
namespace App\Http\Requests\Sucursal;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSucursalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'logo'      => 'nullable|max:1024|image',
      'suc'       => 'required|max:50|unique:sucursales,suc,'.$this->id_sucursal,
      'direc'     => 'required|max:200|string',
      'ser_cotiz' => 'required|max:150|exists:catalogos,value',
    ];
  }
  public function attributes() {
    return [
      'suc'       => 'sucursal',
      'direc'     => 'dirección',
      'ser_cotiz' => 'serie'
    ];
  }
}