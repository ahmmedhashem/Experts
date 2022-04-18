<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActivitiesRequest extends FormRequest
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
            'criteria_id' => 'required|numeric|max:100|exists:main_criterias,id',
            'name' => 'required|string|max:100',
        ];
    }

    public function messages() {
        return [
            'criteria_id.exists' =>  __('المعيار اللذي قمت باختياره غير موجود'),
            'criteria_id.required' => __('من فضلك اختر معيار'),
            'criteria_id.numeric' => __('يجب ان يكون اسم المعيار ارقام'),
            'name.max' =>  __('يجب ان لا يتعدي الاسم ١٠٠ حرف'),
            'name.required' => __('من فضلك ادخل اسم المعيار'),
            'name.string' => __('يجب ان يكون اسم المعيار احرف'),
        ];
    }
}
