<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShahrRequest extends FormRequest
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
            'shahr_name' => 'required|unique:shahr,shahr_name, '.$this->shahr.'',
        ];
    }

    public function attributes(){
        return [
            'shahr_name' => 'نام شهر',
        ];
    }
}
