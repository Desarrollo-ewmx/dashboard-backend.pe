<?php
namespace App\Http\Requests\Imagen;
use Illuminate\Foundation\Http\FormRequest;

class StoreManyImagenRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
     // 'file'  => 'required|max:1024|image',
    ];
  }
  public function attributes() {
    return [
      'file'  => 'archivos',
    ];
  }
}