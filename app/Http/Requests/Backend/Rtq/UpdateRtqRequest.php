<?php

namespace App\Http\Requests\Backend\Rtq;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRtqRequest.
 */
class UpdateRtqRequest extends FormRequest
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
            'nama_santri'     => ['required', 'max:191'],
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
            'nama_santri.required'    => 'The :attribute field is required.',
            'nama_santri.max'         => 'The :attribute field must have less than :max characters',
        ];
    }
}
