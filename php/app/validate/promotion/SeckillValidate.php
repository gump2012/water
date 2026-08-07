<?php

namespace app\validate\promotion;

use think\Validate;

class SeckillValidate extends Validate
{
    protected $rule = [
        'seckill_name' => 'require|max:100',
    ];

    protected $message = [
        'seckill_name.require' => '秒杀活动名称不能为空',
        'seckill_name.max' => '秒杀活动名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'seckill_name',
        ],
        'update' => [
            'seckill_name',
        ],
    ];
}
