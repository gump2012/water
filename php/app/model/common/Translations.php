<?php

namespace app\model\common;

use app\model\content\ArticleCategory;
use app\model\product\ProductArticle;
use think\Model;
use utils\Time;

class Translations extends Model
{
    protected $pk = 'id';
    protected $table = 'translations';

    protected $createTime = false;
    protected $updateTime = false;

    public function tdata()
    {
        return $this->hasMany(TranslationsData::class, 'data_id', 'id');
    }

}
