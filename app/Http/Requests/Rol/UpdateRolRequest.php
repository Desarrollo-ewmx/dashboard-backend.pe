<?php
namespace App\Http\Requests\Rol;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRolRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nom'     => 'required|max:80|unique:roles,nom,'.$this->id_rol,
      'permis'  => 'required|exists:permissions,id|array',
      'desc'    => 'nullable|max:30000|string',
    ];
  }
  public function attributes() {
    return [
      'nom'     => 'rol',
      'permis'  => 'permisos',
      'desc'    => 'descripción'
    ];
  }
}