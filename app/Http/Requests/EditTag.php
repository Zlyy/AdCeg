<?php

namespace App\Http\Requests;

use App\Tag;
use App\Http\Requests\Request;

class EditTag extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        $user = app('auth')->user();
        if (($user->admin === 1)) {
            return true;
        } else {
            return FALSE;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
                //
        ];
    }

}
