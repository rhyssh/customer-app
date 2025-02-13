<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('customer') ? $this->route('customer') : null;
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($id)],
            'phone' => ['required', 'string', 'max:50', Rule::unique('customers', 'phone')->ignore($id)],
            'bank_account_number' => ['required', 'numeric'],
            'about' => ['required', 'string', 'max:500'],
        ];
    }
}
