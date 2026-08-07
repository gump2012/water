<?php

namespace app\validate\promotion;

use think\Validate;

class TimeDiscountValidate extends Validate
{
    protected $rule = [
        'discount_id'    => 'require|number|>=:1',
        'promotion_name' => 'require|chsDash|max:50',
        'start_time'     => 'require|date',
        'end_time'       => 'require|date',
        'item ' => 'require',
    ];

    protected $scene = [
        'create' => [
            'promotion_name',
            'start_time',
            'end_time',
            'item'
        ],
        'update' => [
            'discount_id',
            'promotion_name',
            'start_time',
            'end_time',
            'item'
        ],
    ];
}
