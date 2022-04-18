<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MissionsRequest extends FormRequest
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
            'rule_id' => 'required|numeric|max:100|exists:roles,id',
            'name' => 'required|string|max:100',
        ];
    }

    public function messages() {
        return [
            'rule_id.exists' =>  __('المهمه اللتي قمت باختيارها غير موجوده'),
            'rule_id.required' => __('من فضلك اختر المهمه'),
            'rule_id.numeric' => __('يجب ان يكون اسم المهمه ارقام'),
            'name.max' =>  __('يجب ان لا يتعدي الاسم ١٠٠ حرف'),
            'name.required' => __('من فضلك ادخل اسم المعيار'),
            'name.string' => __('يجب ان يكون اسم المعيار احرف'),
        ];
    }
}
