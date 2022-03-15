<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'estado' => 'required|max:2',
            'cidade' => 'required|max:7',
            'titulo' => 'required|max:50',
            'descricao' => 'required|max:500',
            'avaliacao' => 'required',
            'fotos.*' => 'mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'avaliacao.required' => 'A posta',
        ];
    }
}
