<?php

namespace app\model\order;

use app\model\authority\AdminUser;
use app\model\user\User;
use think\Model;
use utils\Time;

class OrderLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'order_log';

    //关联管理员
    public function adminUser()
    {
        return $this->hasOne(AdminUser::class, 'admin_id', 'admin_id')->bind(["username"]);
    }

    public function getLogTimeAttr($value): string
    {
        return Time::format($value);
    }

    // 操作者
    public function getOperatorAttr($value, $data): string|null
    {
        if ($data["admin_id"] > 0) {
            return AdminUser::where("admin_id", $data["admin_id"])->value("username");
        } else {
            return User::where("user_id", $data["user_id"])->value("username");
        }
    }
}
