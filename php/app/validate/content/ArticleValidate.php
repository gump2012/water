<?php

namespace app\validate\content;

use think\Validate;

class ArticleValidate extends Validate
{
    protected $rule = [
        'article_title' => 'require|max:100',
    ];

    protected $message = [
        'article_title.require' => '文章标题名称不能为空',
        'article_title.max' => '文章标题名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'article_title',
        ],
        'update' => [
            'article_title',
        ],
    ];
}
