<?php

namespace app\validate\setting;

use think\Validate;

class CronsValidate extends Validate
{
    protected $rule = [
        'cron_name' => 'require|max:100',
    ];

    protected $message = [
        'cron_name.require' => '计划任务名称不能为空',
        'cron_name.max' => '计划任务名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'cron_name',
        ],
        'update' => [
            'cron_name',
        ],
    ];
}
