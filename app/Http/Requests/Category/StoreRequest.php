<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    // funcion para generar url limpia a partir del titulo de la categoria
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => str($this->title)->slug()
        ]);
    }

    static public function myRules(){
        return [
            "title" => "required|min:5|max:255",
            "slug" => "required|min:5|max:255|unique:categories",
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->myRules();        
    }
}
