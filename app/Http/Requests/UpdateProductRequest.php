<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($this->product)],
            'category_id' => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'date' => ['date'],
            'images' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,gif']
        ];
    }
}
