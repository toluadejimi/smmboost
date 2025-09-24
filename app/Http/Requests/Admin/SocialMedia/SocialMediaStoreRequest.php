<?php

namespace App\Http\Requests\Admin\SocialMedia;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaStoreRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:191',
            'status' => 'nullable|numeric|in:0,1',
            'icon' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:4096'
        ];
    }
}
