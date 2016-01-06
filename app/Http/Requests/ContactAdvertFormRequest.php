<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactAdvertFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        if(\Auth::user()) {
//            return true;
//        } else {
//            return redirect('/login')->with('message', 'Aby wysłać wiadomość musisz być zalogowany');
//        }
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
            'message' => 'required',
        ];
    }
}
