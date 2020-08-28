<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');


// 定义GET请求路由规则 并设置name变量规则
Route::get('new/:name', 'Index/index')->pattern(['name' => '[\w|\-]+']);
//不需要开头添加^或者在最后添加$，也不支持模式修饰符，系统会自动添加。

// 路由到blog控制器
Route::get('blog/:id','Index/index');
