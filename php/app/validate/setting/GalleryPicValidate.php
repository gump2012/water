<?php

namespace app\validate\setting;

use think\Validate;

class GalleryPicValidate extends Validate
{
    protected $rule = [
        'pic_name' => 'require|max:100',
    ];

    protected $message = [
        'pic_name.require' => '相册图片名称不能为空',
        'pic_name.max' => '相册图片名称最多100个字符',
    ];

    protected $scene = [];
}
