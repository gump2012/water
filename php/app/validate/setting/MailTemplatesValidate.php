<?php

namespace app\validate\setting;

use think\Validate;

class MailTemplatesValidate extends Validate
{
    protected $rule = [
        'template_subject' => 'require|max:100',
        'template_content' => 'require',
    ];

    protected $message = [
        'template_subject.require' => '邮件的主题不能为空',
        'template_subject.max' => '邮件的主题最多100个字符',
        'template_content.require' => '邮件的内容不能为空',
    ];

    protected $scene = [
        'create' => [
            'template_subject',
            'template_content'
        ],
        'update' => [
            'template_subject',
            'template_content'
        ],
    ];
}
