<?php
namespace App\Http\Requests\Rol;
use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nom'     => 'required|max:80|unique:roles,nom|string',
      'slug'    => 'required|max:40|unique:roles,name|string',
      'permis'  => 'required|exists:permissions,id|array',
      'desc'    => 'nullable|max:30000|string',
    ];
  }
  public function attributes() {
    return [
      'nom'   => 'rol',
      'slug'  => 'slug',
      'permis'  => 'permisos',
      'desc'  => 'descripción'
    ];
  }
}