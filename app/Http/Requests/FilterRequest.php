<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'filter_name' => 'required',
            'filter_text' => 'required',
        ];
    }

    public function attributes(){
        return [
            'filter_name' => 'نام فیلتر',
            'filter_text' => 'label فیلتر',
        ];
    }
}
