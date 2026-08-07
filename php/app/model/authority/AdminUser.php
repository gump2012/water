<?php

namespace app\model\authority;

use app\model\merchant\AdminUserShop;
use app\model\user\User;
use think\Model;
use utils\Time;

class AdminUser extends Model
{
    protected $pk = 'admin_id';
    protected $table = 'admin_user';
    protected $json = ['extra', 'auth_list', 'menu_tag', 'order_export'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;

    // 关联角色
    public function role()
    {
        return $this->hasOne(AdminRole::class, 'role_id', 'role_id')->bind(["role_name"]);
    }

    // 添加时间
    public function getAddTimeAttr($value)
    {
        return Time::format($value);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id')->field(['user_id', 'mobile', 'username', 'nickname']);
    }

    public function userShop()
    {
        return $this->hasMany(AdminUserShop::class, 'admin_id', 'admin_id');
    }


}
