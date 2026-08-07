<?php

namespace app\validate\setting;

use think\Validate;

class FriendLinksValidate extends Validate
{
    protected $rule = [
        'link_title' => 'require|max:100',
    ];

    protected $message = [
        'link_title.require' => '友情链接名称不能为空',
        'link_title.max' => '友情链接名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'link_title',
        ],
        'update' => [
            'link_title',
        ],
    ];
}
