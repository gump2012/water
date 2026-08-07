<?php

namespace app\model\decorate;

use think\Model;
use utils\Util;

class PcNavigation extends Model
{
    protected $pk = 'id';
    protected $table = 'pc_navigation';
    protected $json = ['link'];
    protected $jsonAssoc = true;

    // 导航栏位置
    const TYPE_MAIN = 1;
    const TYPE_TOP_BAR = 2;
    const TYPE_BOTTOM = 3;
    const TYPE_SIDEBAR = 4;
    const TYPE_NAME = [
        self::TYPE_MAIN => '主导航',
        self::TYPE_TOP_BAR => '顶部导航',
        self::TYPE_BOTTOM => '底部导航',
        self::TYPE_SIDEBAR => '侧边导航',
    ];

    // 导航栏位置
    public function getTypeNameAttr($value, $data)
    {
        return self::TYPE_NAME[$data["type"]] ?? "";
    }


}
