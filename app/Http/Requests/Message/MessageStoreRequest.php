<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
class MessageStoreRequest extends FormRequest
{
    function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([ 
                    'message' => 'The given data is invalid', 
                    'errors' => $validator->errors(),
                    'status' => false,
                ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
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
     * @return array
     */
    public function rules()
    {
        return [
            'to' => 'required',
            'message' => 'required'
        ];
    }
}
