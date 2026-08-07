<?php

namespace app\validate\promotion;

use app\model\promotion\PointsExchange;
use think\Validate;

class PointsExchangeValidate extends Validate
{
    protected $rule = [
        "product_id" => "checkUnique",
    ];

    protected $message = [
        'product_id.checkUnique' => '已存在相同的积分商品',
    ];

    protected $scene = [
        'create' => [
            'product_id',
        ],
        'update' => [
            'product_id',
        ],
    ];


    // 验证唯一
    public function checkUnique($value, $rule, $data = [], $field = '')
    {
        $id = isset($data['id']) ? $data['id'] : 0;
        $query = PointsExchange::where('product_id', $value)->where('id', '<>', $id);
        return $query->count() === 0;
    }
}
