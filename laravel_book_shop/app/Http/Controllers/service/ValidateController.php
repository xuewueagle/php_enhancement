<?php

namespace App\Http\Controllers\service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tool\Validate\ValidateCode;
use App\Tool\SMS\SendTemplateSMS;
use App\Models\M3Result;
use App\Entity\TempPhones;

/**
 *  验证相关逻辑
 */
class ValidateController extends Controller {

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

    /**
     * 发送短信验证码
     * @param Request $request
     */
    public function sendSMS(Request $request) {

        $m3_result = new M3Result();

        $phone = $request->input('phone', '');
        if ($phone == '') {
            $m3_result->status = 1;
            $m3_result->message = '手机号不能为空';
            return $m3_result->toJson();
        }

        if (strlen($phone) != 11 || $phone[0] != '1') {
            $m3_result->status = 2;
            $m3_result->message = '手机号格式不正确';
            return $m3_result->toJson();
        }

        $sendSMS = new SendTemplateSMS;
        $code = '';
        $charset = '1234567890';
        $len = strlen($charset) - 1;
        for ($i = 0; $i < 6; $i++) {
            $code .= $charset[mt_rand(0, $len)];
        }

        $smsTimeInterval = 60; // 短信验证码的有效时间间隔  此处设置为60分钟
        $m3_result = $sendSMS->sendTemplateSMS($phone, [$code, $smsTimeInterval], 1);

        // 短信验证码发送成功后，入库保存
        if ($m3_result->status == 0) {
            $tempPhone = TempPhones::where('phone', $phone)->first();
            if ($tempPhone == null) {
                $tempPhone = new TempPhones();
            }

            $tempPhone->phone = $phone;
            $tempPhone->code = $code;
            $tempPhone->deadline = date('Y-m-d H-i-s', time() + $smsTimeInterval * 60);
            $tempPhone->save();
        }

        return $m3_result->toJson();
    }

}
