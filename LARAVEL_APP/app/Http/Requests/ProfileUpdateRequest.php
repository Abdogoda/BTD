<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest{

    public function rules(): array{
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['required', new ValidPhoneNumber, Rule::unique(User::class)->ignore($this->user()->id)],
            'address' => ['nullable', 'string', 'max:255'],
            'year_of_birth' => ['nullable', 'numeric', 'digits:4', 'between:1920,'.date('Y')],
            'picture' => ['nullable', 'image'],
        ];
    }
}