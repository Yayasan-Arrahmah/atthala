<?php

namespace App\Http\Requests\Frontend\Amalan;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAmalanRequest.
 */
class UpdateAmalanRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => ['required', 'max:191'],
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'    => 'The :attribute field is required.',
            'title.max'         => 'The :attribute field must have less than :max characters',
        ];
    }
}
