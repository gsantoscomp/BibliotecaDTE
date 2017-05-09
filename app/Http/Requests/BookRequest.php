<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
                'bk_title' => 'required|max:240',
                'bk_author' => 'required|max:240',
                'bk_owner' => 'required|max:240',
                'bk_description' => 'required|max:240'
        ];
    }
}
