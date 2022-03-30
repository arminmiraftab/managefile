<?php

namespace  App\Http\Requests\CategoryqqqwwwwqRequest ;

use Illuminate\Foundation\Http\FormRequest;

class  UpdateCategoryqqqwwwwqRequest  extends FormRequest
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
            //
        ];
    }
}
