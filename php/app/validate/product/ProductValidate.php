<?php

namespace app\validate\product;

use app\model\product\Product;
use think\Validate;

class ProductValidate extends Validate
{
    protected $rule = [
        'product_name' => 'require|max:100',
        'product_sn' => 'checkUnique',
    ];

    protected $message = [
        'product_name.require' => '商品管理名称不能为空',
        'product_name.max' => '商品管理名称最多100个字符',
        'product_sn.checkUnique' => '商品货号已存在',
    ];

    // 验证唯一
    protected function checkUnique($value, $rule, $data = [], $field = '')
    {
        $id = isset($data['product_id']) ? $data['product_id'] : 0;
        $query = Product::where('product_sn', $value)->where('product_id', '<>', $id);
        return $query->count() === 0;
    }
}
