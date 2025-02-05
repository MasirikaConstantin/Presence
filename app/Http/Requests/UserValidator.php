<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidator extends FormRequest
{
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
            'name' => 'required|string|max:255',
            //'adresse' => 'required|string|max:255',
            'lieu_id' => 'required|exists:lieus,id',
            'password' => 'required|min:6',
            "email"=>"required|email|unique:utilisateurs,email",
            "categorie_id"=>"required|exists:categories,id",
            'image'=> ["nullable",'max:5120', 'mimes:png,jpg,jpeg,gif,PNG,JPEG,JPG'],

        ];
    }
}
