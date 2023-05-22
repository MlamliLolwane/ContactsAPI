<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'cell_phone' => 'string|min:10',

            'whatsapp' => 
            'string|min:10|required_without:email|required_if:preffered_contact_method,=,"whatsapp"|required_if:preffered_contact_method,=,"both"',

            'email' => 'string|required_without:whatsapp|required_if:preffered_contact_method,=,"email"|required_if:preffered_contact_method,=,"both"',

            'preffered_contact_method' => 'required:in:whatsapp,email,both',
            'learner_id' => 'integer'
        ];
    }
}
