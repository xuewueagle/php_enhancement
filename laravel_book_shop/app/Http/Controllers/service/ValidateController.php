<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tool\Validate\ValidateCode;

/**
 *  验证相关逻辑
 */
class ValidateController extends Controller
{
    
    /**
     * 调用显示图片验证码
     * @param Request $request
     * @return type
     */
    public function create(Request $request) {
        $validateCode = New ValidateCode();
        $request->session()->put('validate_code', $validateCode->getCode());
        return $validateCode->doimg();
        
    }
    
    
    
}
