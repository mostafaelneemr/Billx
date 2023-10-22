<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->segment(3);
        switch ($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }

            case 'POST':
            {
                return [
                    'name' => 'required|string|min:3|max:100',
                    'email' => 'required|email|max:255|unique:customers,email',
                    'address' => 'required|string|max:255',
                    'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
                    'city' => 'nullable|string|max:255',
                    'gender' => 'required|string|in:male,female',
                    'details' => 'nullable|string',
                ];
            }

            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|min:3|max:100',
                    'email' => 'required|email|max:255|exists:customers,email'.$id,
                    'address' => 'required|string|max:255',
                    'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
                    'city' => 'nullable|string|max:255',
                    'gender' => 'required|string|in:male,female',
                    'details' => 'nullable|string',
                ];
            }
        };
    }
}
