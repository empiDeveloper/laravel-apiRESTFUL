<?php

namespace App\Http\Requests\Candidate;

use App\Http\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CandidateCreateRequest extends FormRequest
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
            'name' => 'required',
            'source' => 'required',
            'owner' => 'required|exists:users,id',
        ];
    }
    /**
     * Response exception.
     *
     * @return object
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseTrait::responseError($validator->errors()->first(), 400));
    }
}
