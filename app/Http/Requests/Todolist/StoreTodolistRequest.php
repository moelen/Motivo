<?php

namespace App\Http\Requests\Todolist;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodolistRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
            ],
        ];
    }
}
