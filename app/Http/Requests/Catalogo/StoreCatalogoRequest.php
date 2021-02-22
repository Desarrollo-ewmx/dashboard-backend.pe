<?php
namespace App\Http\Requests\Catalogo;
use Illuminate\Foundation\Http\FormRequest;

class StoreCatalogoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'input' => 'required|in:Cotizaciones (Serie),Pedidos (Serie)',
      'valor' => 'required|max:150|alpha_unique_where:catalogos,'.$this->input.',value',
    ];
  }
}