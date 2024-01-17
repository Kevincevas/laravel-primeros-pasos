<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;


class PutRequest extends FormRequest
{

    static public function myRules()
    {
        
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
        return [
             "title" => "required|min:5|max:500",
             "slug" => "required|min:5|max:500|unique:posts,slug,".$this->route('post')->id, //indica que el slug del post no sea tomado por otro registro
             "content" => "required|min:10",
             "category_id" => "required",
             "description" => "required|min:10",
             "posted" => "required",
             "image" => "mimes:jpeg,jpg,png|max:10240",
        ];
    }
}
