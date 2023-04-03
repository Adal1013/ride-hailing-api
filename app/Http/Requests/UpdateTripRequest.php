<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
      $intRule = 'required|int';
      return [
        'riderId' => 'required|int|exists:riders,id',
        'originLatitude' => $intRule,
        'originLongitude' => $intRule,
        'installments' => $intRule,
      ];
    }
}
