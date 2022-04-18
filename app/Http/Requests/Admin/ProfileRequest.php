<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,' . $this -> id,
            'password' => 'nullable|confirmed|min:8'
        ];
    }

    public function messages() {
        return [
            'email.required' => __('admin/profile.email required'),
            'email.email' =>  __('admin/profile.email valid'),
            'email.unique' =>  __('admin/profile.email exist'),
            'password.confirmed' => __('admin/profile.password not match' ),
            'password.min' => __('admin/profile.password min' ),
        ];
    }
}
