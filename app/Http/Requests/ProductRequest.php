<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'product_name' => ['required', 'string'],
            'product_slug' => ['required', 'string', 'unique:products,product_name'],
            'product_code' => ['required', 'string', 'max:10'],
            'qty'          => ['required', 'integer'],
            'price'        => ['required'],
            'image'        => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'brand_id'     => ['required', 'integer'],
            'category_id'  => ['required', 'integer'],
            'status'       => ['required', 'in:0,1'],
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'qty.required'=> 'The quantity field is required.',
            'qty.integer'=> 'The quantity must be an integer.',
            'brand_id.required'=> 'The brand field is required.',
            'brand_id.integer'=> 'The quantity must be an integer.',
            'category_id.required'=> 'The category field is required.',
            'category_id.integer'=> 'The quantity must be an integer.',
            'image.image'=> 'The product image be a file of type: png,jpg,jpeg.',
        ];
    }
}
