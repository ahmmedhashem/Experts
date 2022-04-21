<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
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
            'name' => 'required|max:100',
            'slug' => 'required|max:100|string|unique:products,slug,' . $this -> id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'required|array|min:1', //[]
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable',
            'brand_id' => 'required|exists:brands,id'
        ];
    }

    public function messages() {
        return [
            'name.required' => __('admin/product.name required'),
            'name.max' =>  __('admin/product.name max'),
            'slug.unique' =>  __('admin/product.slug unique'),
            'slug.required' => __('admin/product.slug required' ),
            'slug.string' => __('admin/product.slug string' ),
            'slug.max' => __('admin/product.slug max' ),
            'description.required' => __('admin/product.desc required' ),

            'description.max' => __('admin/product.desc max'),
            'short_description.max' =>  __('admin/product.short desc max'),
            'categories.required' =>  __('admin/product.category required'),
            'categories.array' => __('admin/product.ategory array' ),
            'categories.min' => __('admin/product.category min' ),

            'categories.*.numeric' => __('admin/product.category values'),
            'categories.*.exists' =>  __('admin/product.category not exist'),
            'brand_id.required' =>  __('admin/product.brand required'),
            'brand_id.exists' => __('admin/product.brand not exist' ),

        ];
    }
}
