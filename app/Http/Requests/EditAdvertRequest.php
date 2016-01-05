<?php

namespace App\Http\Requests;

use App\Adverts;
use App\Http\Requests\Request;

class EditAdvertRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = app('auth')->user();
        $advert = Adverts::findOrFail($this->id);
        if(($advert->user_id === $user->id) ||($user->admin === 1)) {
            return true;
        }
        else {
            return FALSE;
        }
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            
        ];
    }
}
