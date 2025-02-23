<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangeAvatarRequest extends FormRequest
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
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'avatar.required' => 'The avatar image is required.',
            'avatar.image' => 'The file must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif,jfif.',
            'avatar.max' => 'The avatar must not be greater than 2MB.',
        ];
    }
}
