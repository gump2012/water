<?php

namespace app\model\content;

use think\Model;
use utils\Util;

class ArticleCategory extends Model
{
    protected $pk = 'article_category_id';
    protected $table = 'article_category';

    const CATEGORY_SN_ISSUE = 'bzzx'; //帮助中心文章分类
    // 查询帮助的分类
    public function scopeIssue($query)
    {
        $query->where('category_sn', self::CATEGORY_SN_ISSUE);
    }

    public function getArticleCategoryNameAttr($value, $data)
    {
        if (empty($value)) {
            return $value;
        }
        if (php_sapi_name() != 'cli' && !empty(request()->header('X-Locale-Code'))) {
            $cache = Util::lang($value);
            if ($cache) {
                return $cache;
            } else {
                return $value;
            }
        } else {
            return $value;
        }
    }
}
