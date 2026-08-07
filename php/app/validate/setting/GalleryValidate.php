<?php

namespace app\validate\setting;

use think\Validate;

class GalleryValidate extends Validate
{
    protected $rule = [
        'gallery_name' => 'require|max:100',
    ];

    protected $message = [
        'gallery_name.require' => '相册名称不能为空',
        'gallery_name.max' => '相册名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'gallery_name',
        ],
        'update' => [
            'gallery_name',
        ],
    ];
}
