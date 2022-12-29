<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentValidationRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=>false,
                'errors'=> $validator->errors(),
            ],200),
        );
    }
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $roles = [
            'name'=> ['required'],
            'email'=> ['required','email'],
            'birthday'=> ['required'],
            'avater'=> ['required'],
        ];

        if(request()->update != null){
            $roles['avater'][0] = 'nullable';
        }

        return $roles;
    }
}
