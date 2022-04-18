<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|max:100|unique:users,email,' . $this -> id,
            'password' => 'required_without:id|max:100|confirmed'
        ];
    }

    public function messages() {
        return [
            'name.max' =>  __('يجب ان لا يتعدي الاسم ١٠٠ حرف'),
            'name.required' => __('من فضلك ادخل اسم المعيار'),
            'name.string' => __('يجب ان يكون اسم المعيار احرف'),

            'email.max' =>  __('يجب ان لا يتعدي البريد الالكتروني ١٠٠ حرف'),
            'email.required' => __('من فضلك ادخل البريد الالكتروني'),
            'email.email' => __('من فضلك ادخل بريد الكتروني صالح'),
            'email.unique' => __('هذا البريد موجود من قبل'),

            'password.max' =>  __('يجب ان لا تتعدي كلمه المرور ١٠٠ حرف'),
            'password.required' => __('من فضلك ادخل كلمه المرور'),
            'password.string' => __('يجب ان تكون كلمه المرور احرف'),
            'password.confirmed' => __('كلمه المرور غير متطابقه'),
        ];
    }
}
