<?php
namespace App\Http\Requests\Sucursal;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSucursalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'sucursal'  => 'required|max:50',
      'direccion' => 'required|max:200|string',
      'serie'     => 'required|max:150|exists:catalogos,id',
      'logo'      => 'nullable|max:1024|image',
    ];
  }
}