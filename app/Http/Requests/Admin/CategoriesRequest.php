<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'type' => 'required|in:1,2',
            'name' => 'required|string|max:100',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Category name is required',
            'name.string' =>  'category name should be string',
            'name.max' =>  'category name maximum 100 char'
        ];
    }
}
