<?php

namespace app\model\setting;

use think\Model;

class Config extends Model
{
    protected $pk = 'id';
    protected $table = 'config';
    protected $json = ['data'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    //商户后台登陆后需返回默认配置项
    const SHOP_LAYOUT = 'topMenu';
    const SHOP_NAVTHEME = 'dark';

    // 定义全局的查询范围
    protected $globalScope = ['del'];

    public function scopeDel($query)
    {
        $query->where('is_del',0);
    }
}
