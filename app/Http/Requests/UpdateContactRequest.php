<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $contactId = $this->route('contact')->id;

        return [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'contact' => [
                'required',
                'string',
                'digits:9',
                Rule::unique('contacts', 'contact')->ignore($contactId)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contactId)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 5 characters.',
            'contact.required' => 'The contact field is required.',
            'contact.digits' => 'The contact must be 9 digits.',
            'contact.unique' => 'The contact has already been taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
        ];
    }
}

