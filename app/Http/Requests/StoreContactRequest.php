<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'contact' => ['required', 'string', 'size:9', 'regex:/^[0-9]{9}$/', 'unique:contacts,contact'],
            'email' => ['required', 'email', 'unique:contacts,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 5 characters.',
            'contact.required' => 'The contact field is required.',
            'contact.size' => 'The contact must be exactly 9 digits.',
            'contact.regex' => 'The contact must contain only numbers.',
            'contact.unique' => 'This contact number is already registered.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
        ];
    }
}
