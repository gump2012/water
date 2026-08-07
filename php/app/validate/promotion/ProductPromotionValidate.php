<?php

namespace app\validate\promotion;

use think\Validate;

class ProductPromotionValidate extends Validate
{
    protected $rule = [
        'promotion_name' => 'require|max:100',
        'promotion_type_data' => 'require'
    ];

    protected $message = [
        'promotion_name.require' => '优惠活动名称不能为空',
        'promotion_name.max' => '优惠活动名称最多100个字符',
        'promotion_type_data.require' => '优惠规则不能为空'
    ];

    protected $scene = [
        'create' => [
            'promotion_name',
            'promotion_type_data'
        ],
        'update' => [
            'promotion_name',
            'promotion_type_data'
        ],
    ];
}
