<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OstanRequest extends FormRequest
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
            'ostan_name' => 'required|unique:ostan,ostan_name, '.$this->ostan.'',
        ];
    }

    public function attributes(){
        return [
            'ostan_name' => 'نام استان',
        ];
    }
}
