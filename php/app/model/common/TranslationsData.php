<?php

namespace app\model\common;

use app\model\content\ArticleCategory;
use app\model\product\ProductArticle;
use think\Model;
use utils\Time;

class TranslationsData extends Model
{
    protected $pk = 'id';
    protected $table = 'translations_data';

    protected $createTime = false;
    protected $updateTime = false;


	// 关联语种
	public function locales()
	{
		return $this->belongsTo(Locales::class,'locale_id','id')
			->field(['id','locale_code','language']);
	}
}
