<?php

namespace app\validate\promotion;

use think\Validate;

class SignInSettingValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:100',
    ];

    protected $message = [
        'name.require' => '积分签到名称不能为空',
        'name.max' => '积分签到名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'name',
        ],
        'update' => [
            'name',
        ],
    ];
}
