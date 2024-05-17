<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->isMethod('PUT')) {
            return [
                'name' => 'required|string|min:3',
                'department_id' => 'required',
                'designation_id' => 'required',
                'phone_number' => 'required|string|min:10|max:10',
            ];
        } else {
            return [
                'name' => 'required|string|min:3',
                'department_id' => 'required',
                'designation_id' => 'required',
                'phone_number' => 'required|string|min:10|max:10',
            ];
        }
    }
}
