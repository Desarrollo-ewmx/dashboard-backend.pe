<?php
namespace App\Http\Requests\Permiso;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermisoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'desc'    => 'required|max:1000|string',
    ];
  }
  public function attributes() {
    return [
      'desc'    => 'descripción'
    ];
  }
}