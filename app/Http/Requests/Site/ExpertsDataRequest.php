<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ExpertsDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'type' => 'required|in:1,2',
            'gender' => 'required|in:1,2',
            'name' => 'required|max:100|string',
            'nationality_id' => 'required|numeric',
            'phone' => 'required|max:14|string',
            'alt_phone' => 'required|max:14|string',
            'current_location' => 'required|max:100|string',
            'institution' => 'required|max:100|string',

            'langauges' => 'required|array|min:1', //[]
            'languages.*' => 'numeric|exists:languages,id',
            'willing_to_study' => 'required|in:1,2',
            'willing_to_consultancy' => 'required|in:1,2',
            'available_to_request' => 'required|in:1,2',
        ];
    }



    // public function messages() {
    //     return [
    //         'name.required' => __('admin/product.name required'),
    //         'name.max' =>  __('admin/product.name max'),
    //         'slug.unique' =>  __('admin/product.slug unique'),
    //         'slug.required' => __('admin/product.slug required' ),
    //         'slug.string' => __('admin/product.slug string' ),
    //         'slug.max' => __('admin/product.slug max' ),
    //         'description.required' => __('admin/product.desc required' ),

    //         'description.max' => __('admin/product.desc max'),
    //         'short_description.max' =>  __('admin/product.short desc max'),
    //         'categories.required' =>  __('admin/product.category required'),
    //         'categories.array' => __('admin/product.ategory array' ),
    //         'categories.min' => __('admin/product.category min' ),

    //         'categories.*.numeric' => __('admin/product.category values'),
    //         'categories.*.exists' =>  __('admin/product.category not exist'),
    //         'brand_id.required' =>  __('admin/product.brand required'),
    //         'brand_id.exists' => __('admin/product.brand not exist' ),

    //     ];
    // }
}
