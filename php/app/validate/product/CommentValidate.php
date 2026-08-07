<?php

namespace app\validate\product;

use think\Validate;

class CommentValidate extends Validate
{
    protected $rule = [
        'content' => 'require|max:500',
    ];

    protected $message = [
        'content.require' => '评论内容不能为空',
        'content.max' => '评论名称最多500个字符',
    ];

    protected $scene = [
        'create' => ['content'],
        'update' => ['content'],
    ];
}
