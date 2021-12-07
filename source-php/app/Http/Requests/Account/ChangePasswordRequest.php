<?php

namespace App\Http\Requests\Account;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new_password' => 'required',
            'old_password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => _trans('Mật khẩu bắt buộc phải có'),
            'old_password.required' => _trans('Mật khẩu cũ bắt buộc phải có'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $message = [];
        foreach ($errors as $key=>$error) {
            $message[] = $errors[$key][0];
        }
        throw new HttpResponseException(response()->json([
            'status'=>  200,
            'message' => $message[0],
            'data' =>[],
            'success' => false,
        ], 200));

    }
}
