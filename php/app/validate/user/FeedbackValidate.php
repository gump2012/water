<?php

namespace app\validate\user;

use think\Validate;

class FeedbackValidate extends Validate
{
    protected $rule = [
        'content' => 'require',
        'email' => 'checkEmail',
    ];

    protected $message = [
        'content.require' => '内容不能为空',
        'email.checkEmail' => '邮箱格式不正确',
    ];

    // 邮箱验证
    public function checkEmail($value, $rule, $data = [], $field = '')
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}
