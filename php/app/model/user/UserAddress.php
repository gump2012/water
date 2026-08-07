<?php

namespace app\model\user;

use think\Model;

class UserAddress extends Model
{
    protected $pk = 'address_id';
    protected $table = 'user_address';
    protected $json = ["region_ids", "region_names"];
    protected $jsonAssoc = true;

    public function getRegionNameAttr($value, $data)
    {
        if (isset($data['region_names'])) {
            if (isset($data['region_names'][1]) && $data['region_names'][0] == $data['region_names'][1]) {
                unset($data['region_names'][1]);
            }
            return implode(' ', $data['region_names']);
        } else {
            return '';
        }
    }
}
