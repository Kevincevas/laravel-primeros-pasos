<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{

    // funcion para generar url limpia a partir del titulo del post
    protected function prepareForValidation()
    {
        $this->merge([
            // 'slug' => Str::slug($this->title)
            // 'slug' => Str::of($this->title)->slug()->append('-adicional')
            'slug' => str($this->title)->slug()
        ]);
    }

    static public function myRules()
    {
        return [
             "title" => "required|min:5|max:500",
             "slug" => "required|min:5|max:500|unique:posts",
             "content" => "required|min:10",
             "category_id" => "required",
             "description" => "required|min:10",
             "posted" => "required",
        ];
    }

    //API 
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if($this->expectsJson())
        {
            $response = new Response($validator->errors(), 400);
            throw new ValidationException($validator, $response);
        }
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
