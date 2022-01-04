<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title'          => 'required|string',
            'recurring_at'   => 'required|numeric|min:1|max:30',
            'total'          => 'required|numeric|min:0',
            'balance'        => 'required|numeric|min:0',
            'monthly'        => 'required|numeric|min:0.01',
            'limit'          => 'required|numeric|min:0|max:1'
        ];
    }
}
