<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientAddPointsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pharmacy_id' => 'required',
            'client_id' => 'required',
            'points' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'pharmacy_id.required' => 'pharmacy_id is mandatory',
            'client_id.required' => 'client_id is mandatory',
            'points.required' => 'points is mandatory',
        ];
    }
}
