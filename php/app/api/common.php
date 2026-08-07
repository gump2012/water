<?php

// 初始化全局请求参数
request()->userId = 0;
function test($arr, $is_die = true)
{
    echo "<pre>";
    echo print_r($arr);
    if ($is_die) {
        die();
    }
}
