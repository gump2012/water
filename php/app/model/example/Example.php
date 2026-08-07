<?php

namespace app\model\example;

use think\Model;

class Example extends Model
{
    protected $pk = 'example_id';
    protected $table = 'example';

    /**
     * 该数据能不能删除
     * @param $userId
     * @return bool
     */
    public function canDelete($userId): bool
    {
        if ($this->user_id != $userId) {
            return false;
        }
        if ($this->status == 1) {
            return true;
        }
        return false;
    }

    /**
     * 该数据能不能编辑
     * @param $userId
     * @return bool
     */
    public function canEdit($userId): bool
    {
        if ($this->user_id != $userId) {
            return false;
        }
        if ($this->status == 1) {
            return true;
        }
        return false;
    }
}
