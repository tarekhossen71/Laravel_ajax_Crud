<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=> false,
                'errors'=>$validator->errors(),
            ], 200),
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
        $rulse = [
            'name'    => ['required'],
            'email'   => ['required', 'email'],
            'phone'   => ['required'],
            'roll'    => ['required'],
            'reg'     => ['required'],
            'board'   => ['required'],
            'session' => ['required'],
            'avater'  => ['required'],
        ];

        if (request()->update != '') {
            $rulse['avater'][0] = 'nullable';
        }
        return $rulse;
    }
}
