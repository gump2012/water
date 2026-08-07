<?php

namespace app\model\common;

use app\model\content\ArticleCategory;
use app\model\product\ProductArticle;
use think\Model;
use utils\Time;

class Locales extends Model
{
    protected $pk = 'id';
    protected $table = 'locales';

    protected $createTime = false;
    protected $autoWriteTimestamp = 'int';
    protected $updateTime = 'last_updated';

    // 关联货币
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
}
