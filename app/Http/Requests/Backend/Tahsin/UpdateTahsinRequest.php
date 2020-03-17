<?php

namespace App\Http\Requests\Backend\Tahsin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateTahsinRequest.
 */
class UpdateTahsinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'uuid_tahsin'     => ['required', 'max:191'],
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
            // 'uuid_tahsin.required'    => 'The :attribute field is required.',
            // 'uuid_tahsin.max'         => 'The :attribute field must have less than :max characters',
        ];
    }
}
