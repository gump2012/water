<?php

namespace app\model\product;

use think\Model;

class ProductAttributesTpl extends Model
{
    protected $pk = 'tpl_id';
    protected $table = 'product_attributes_tpl';
    protected $json = ['tpl_data'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;


    public function getTplDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setTplDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }
}
