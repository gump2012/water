<?php

namespace app\validate\user;

use think\Validate;
use utils\Util;

class UserAddressValidate extends Validate
{
    protected $rule = [
        'address' => 'require|max:100',
        "email" => "checkEmail",
        "mobile" => "checkMobile",
    ];

    protected $message = [
        'address.require' => '收货地址名称不能为空',
        'address.max' => '收货地址名称最多100个字符',
        'email.checkEmail' => '邮箱格式不正确',
        'mobile.checkMobile' => '手机号格式不正确',
    ];

    protected $scene = [
        'create' => [
            'address',
            'email',
            'mobile'
        ],
        'update' => [
            'address',
            'email',
            'mobile'
        ],
    ];

    // 邮箱验证
    public function checkEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    // 手机号验证
    public function checkMobile($value)
    {
        //移除非数字字符，确保仅保留数字
        $mobile = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        if (!Util::validateMobile($mobile)) {
            return false;
        }
        return true;
    }
}
