<?php

namespace App\Http\Requests\Backend\Pembayaran;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePembayaranRequest.
 */
class StorePembayaranRequest extends FormRequest
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
            // 'uuid_pembayaran'     => ['required', 'max:191'],
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
            // 'uuid_pembayaran.required'    => 'The :attribute field is required.',
            // 'uuid_pembayaran.max'         => 'The :attribute field must have less than :max characters',
        ];
    }
}
