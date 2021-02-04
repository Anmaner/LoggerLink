<?php

namespace App\Http\Requests\Logger;

use App\Models\Logger\Logger;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoggerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'redirect' => 'url|nullable|max:255',
            'code' => 'max:255',
            'status' => Rule::in( Logger::getStatusList() )
        ];
    }
}
