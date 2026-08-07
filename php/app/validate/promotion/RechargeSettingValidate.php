<?php

namespace app\validate\promotion;

use think\Validate;

class RechargeSettingValidate extends Validate
{
    protected $rule = [
        '' => 'require|max:100',
    ];

    protected $message = [
        '.require' => '余额充值名称不能为空',
        '.max' => '余额充值名称最多100个字符',
    ];
}
