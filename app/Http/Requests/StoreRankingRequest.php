<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRankingRequest extends FormRequest
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
            'date' => ['required'],
            'gender' => ['required', Rule::in(['men','women','mixed'])],
            'type' => ['required', Rule::in(['singles','doubles'])],
            'ranking' => 'required|gt:0',
            'player' => 'required',
            'country' => 'required',
            'age' => 'required|gt:0',
            'points' => 'required',
            'tournaments' => 'required'
        ];
    }
}
