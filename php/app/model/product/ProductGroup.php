<?php

namespace app\model\product;

use think\Model;

class ProductGroup extends Model
{
    protected $pk = 'product_group_id';
    protected $table = 'product_group';
    protected $autoWriteTimestamp = 'int';
    protected $createTime = 'add_time';
    protected $json = ['product_ids'];
    protected $jsonAssoc = true;
}
