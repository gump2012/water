<?php

namespace app\model\authority;

use think\Model;

class Suppliers extends Model
{
    protected $pk = 'suppliers_id';
    protected $table = 'suppliers';

    public function adminUser()
    {
        return $this->hasMany(AdminUser::class, 'suppliers_id', 'suppliers_id');
    }

    // 区域数组格式
    public function getRegionsAttr($value, $data)
    {
        return [$data['country'],$data["province"], $data["city"], $data["district"]];
    }
}
