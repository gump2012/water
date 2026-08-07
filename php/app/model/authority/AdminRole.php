<?php

namespace app\model\authority;

use think\Model;

class AdminRole extends Model
{
    protected $pk = 'role_id';
    protected $table = 'admin_role';
    protected $json = ["authority_list"];
    protected $jsonAssoc = true;


    public function getAuthorityListAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setAuthorityListAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }
}
