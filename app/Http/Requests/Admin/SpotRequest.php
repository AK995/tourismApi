<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class SpotRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'locale_name' => 'required',
            // 'spot_name' => 'required',
            'avatar' => 'mimes:jpeg,bmp,png,gif',
            // 'level' => 'required',
            // pics:小图集
            // 'pics' => 'required|array',
        ];
    }

    public function messages(){
        return[
            'avatar.mimes' => '图片必须是jpeg,bmp,png,gif格式的图片',
        ];
    }
}
