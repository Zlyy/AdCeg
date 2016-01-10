<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAdvertRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|min:3|max:50',
            'content' => 'required|min:10|max:1000',
            'contact' => 'required|min:3|max:50',
            'expired_at' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png|max:2048',
            'tags_list' => 'required',
        ];
    }

}
