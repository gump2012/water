<?php

namespace app\validate\content;

use app\model\content\ArticleCategory;
use think\Validate;

class ArticleCategoryValidate extends Validate
{
    protected $rule = [
        'article_category_name' => 'require|max:100|checkUnique',
        'category_sn' => 'checkUnique',
    ];

    protected $message = [
        'article_category_name.require' => '分类名称名称不能为空',
        'article_category_name.max' => '分类名称名称最多100个字符',
        'category_sn.checkUnique' => '该分类编码已存在',
        'article_category_name.checkUnique' => '该分类名称已存在',
    ];

    protected $scene = [
        'create' => [
            'article_category_name',
            'category_sn'
        ],
        'update' => [
            'article_category_name',
            'category_sn',
        ],
    ];

    // 验证唯一
    public function checkUnique($value, $rule, $data = [], $field = '')
    {
        $id = isset($data['article_category_id']) ? $data['article_category_id'] : 0;
        $query = ArticleCategory::where($field, $value)->where('article_category_id', '<>', $id);
        return $query->count() === 0;
    }
}
