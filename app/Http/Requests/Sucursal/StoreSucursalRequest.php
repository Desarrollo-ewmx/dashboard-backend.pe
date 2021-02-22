<?php
namespace App\Http\Requests\Sucursal;
use Illuminate\Foundation\Http\FormRequest;

class StoreSucursalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'suc'     => 'required|max:50|unique:sucursales,suc',
      'direc'   => 'required|max:200|string',
      'ser_cot' => 'required|max:150|exists:catalogos,value',
    ];
  }
  public function attributes() {
    return [
      'suc'     => 'sucursal',
      'direc'   => 'dirección',
      'ser_cot' => 'serie'
    ];
  }
}