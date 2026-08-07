<?php

namespace app\model\product;

use think\Model;

class ProductSpecs extends Model
{
    protected $pk = 'spec_id';
    protected $table = 'product_specs';
    protected $json = ['spec_data'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;
}
