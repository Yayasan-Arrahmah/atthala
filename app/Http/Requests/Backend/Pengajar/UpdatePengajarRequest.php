<?php

namespace App\Http\Requests\Backend\Pengajar;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePengajarRequest.
 */
class UpdatePengajarRequest extends FormRequest
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
            'nama_pengajar'     => ['required', 'max:191'],
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
            'nama_pengajar.required'    => 'The :attribute field is required.',
            'nama_pengajar.max'         => 'The :attribute field must have less than :max characters',
        ];
    }
}
