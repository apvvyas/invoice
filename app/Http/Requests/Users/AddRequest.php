<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personal[firstName]'=>'required',
            'personal[lastName]'=>'required',
            'personal[email]'=>'required | email | unique:users' ,
            'personal[phone]'=>'required|regex:/(01)[0-9]{9}/',
            'personal[password]' => 'required',
            'personal[passwordConf]' => 'required_with:personal[password]|same:personal[password]',

            'business[name]'=>'required',
            'business[address1]'=>'required',
            'business[address2]'=>'required',
            'business[city]'=>'required',
            'business[state]'=>'required',
            'business[country]'=>'required',
            'business[postal]'=>'required',
        ];
    }
}
