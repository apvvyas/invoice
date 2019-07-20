<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'personal.firstName'=>'required',
            'personal.lastName'=>'required',
            'personal.phone'=>'required|regex:/[0-9]{9}/',
            'personal.passwordConf' => 'same:personal.password',

            'business.name'=>'required',
            'business.address1'=>'required',
            'business.address2'=>'required',
        ];
    }
}
