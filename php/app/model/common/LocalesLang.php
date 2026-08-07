<?php

namespace app\model\common;

use app\model\content\ArticleCategory;
use app\model\product\ProductArticle;
use think\Model;
use utils\Time;

class LocalesLang extends Model
{
    protected $pk = 'id';
    protected $table = 'locales_lang';

    protected $createTime = false;


}
