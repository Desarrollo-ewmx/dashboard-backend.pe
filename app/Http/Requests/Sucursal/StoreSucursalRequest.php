<?php
namespace App\Http\Requests\Sucursal;
use Illuminate\Foundation\Http\FormRequest;

class StoreSucursalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'sucursal'  => 'required|max:50',
      'direccion' => 'required|max:200|string',
      'serie'     => 'required|max:150|exists:catalogos,id',
    ];
  }
}