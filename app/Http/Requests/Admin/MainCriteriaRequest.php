<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MainCriteriaRequest extends FormRequest
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
            // 'slug' => 'required|max:100|string|unique:products,slug,' . $this -> id,
            'name' => 'required|string|max:100',
        ];
    }

    public function messages() {
        return [
            // 'slug.max' =>  __('يجب ان لا يتعدي الاسم في الرابط ١٠٠ حرف'),
            // 'slug.required' => __('من فضلك ادخل اسم المعيار في الرابط'),
            // 'slug.string' => __('يجب ان يكون اسم المعيار احرف'),
            // 'slug.unique' => __('هذا الاسم موجود من قبل'),

            'name.max' =>  __('يجب ان لا يتعدي الاسم ١٠٠ حرف'),
            'name.required' => __('من فضلك ادخل اسم المعيار'),
            'name.string' => __('يجب ان يكون اسم المعيار احرف'),
        ];
    }
}
