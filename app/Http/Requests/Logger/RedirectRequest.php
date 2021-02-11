<?php

namespace App\Http\Requests\Logger;

use Illuminate\Foundation\Http\FormRequest;

class RedirectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country.*' => 'exists:countries,name',
            'url.*' => 'url'
        ];
    }
}
