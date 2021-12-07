<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CreateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return true
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
            'Description' => 'required',
            'Owner_id' => 'required',
            'ResId' => 'required',
            'PositionRating' => 'required',
            'PriceRating' => 'required',
            'QualityRating' => 'required',
            'ServiceRating' => 'required',
            'SpaceRating' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'Description.required' => __('is_required',['name'=>'Mô tả']),
            'Owner_id.required' => __('is_required',['name'=>'ID user']),
            'ResId.required' => __('is_required',['name'=>'ID nhà hàng']),
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
            'success' => false,
            'message' =>  $message[0],
        ], 200));
    }
}
