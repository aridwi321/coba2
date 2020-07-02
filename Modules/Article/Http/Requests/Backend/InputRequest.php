<?php

namespace Modules\Article\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class InputRequest extends FormRequest
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
            // 'category_id'       => 'required|numeric',
            'user_id'       => 'required|numeric',

            // 'weight'            => 'required|Integer',
            // 'User_id'           => 'required|numeric',
        ];
    }
}
