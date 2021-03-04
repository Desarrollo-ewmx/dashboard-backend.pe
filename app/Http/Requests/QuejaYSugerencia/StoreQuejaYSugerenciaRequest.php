<?php
namespace App\Http\Requests\QuejaYSugerencia;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuejaYSugerenciaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'tipo'    => 'required|max:35|in:Queja,Sugerencia',
      'deprto'  => 'required|max:35|in:Ventas,Producción,Logística,Facturación,Sistema,Otro',
      'obs'     => 'required|max:30000|string',
    ];
  }
  public function attributes() {
    return [
      'tipo'    => 'tipo',
      'deprto'  => 'departamento',
      'obs'     => 'observaciones',
    ];
  }
}