<?php

namespace app\validate\setting;

use think\Validate;

class AppVersionValidate extends Validate
{
    protected $rule = [
        '' => 'require|max:100',
    ];

    protected $message = [
        '.require' => 'APP版本管理名称不能为空',
        '.max' => 'APP版本管理名称最多100个字符',
    ];
}
