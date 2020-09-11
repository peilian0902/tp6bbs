<?php

use think\facade\Route;

// 首页
//Route::get('/', 'index/index')->name('page.root');

// 注册
Route::post('signup/check_unique', 'register/check_unique')->name('signup.check_unique');
Route::get('signup', 'register/create')->name('page.signup');
Route::post('signup/save', 'register/save')->name('page.signup.save');

// 注册
//Route::post('signup/send_code', 'register/send_code')->name('signup.send_code');
//Route::post('signup/check_unique', 'register/check_unique')->name('signup.check_unique');
//Route::get('signup', 'register/create')->name('page.signup');
//Route::post('signup', 'register/save')->name('page.signup.save');
//
//// 验证填写的手机验证码是否正确
Route::post('verify/valid_code', 'verify/valid_code')->name('verify.valid_code');

// 用户登录与退出
Route::get('login', 'login/create')->name('page.login');
Route::post('login', 'login/save')->name('page.login.save');//{:url('[page.login.save]')}路径不成功
//Route::post('logout', 'login/delete')->name('page.logout');
Route::post('page/logout', 'login/delete');

// 重置密码
// 发送手机验证码
Route::post('reset/send_code', 'reset/send_code')->name('reset.send_code');
// 验证手机是否已注册
Route::post('reset/mobile_present', 'reset/mobile_present')->name('reset.mobile_present');
// 重置密码表单和保存方法
Route::get('reset', 'reset/create')->name('page.reset');
Route::post('reset', 'reset/save')->name('page.reset.save');

// 个人中心
Route::get('user/edit', 'user/edit')->name('user.edit');
Route::put('user/update', 'user/update')->name('user.update');
Route::get('user/<id>', 'user/read')->name('user.read');

//Route::get('/home/:name',function ($name){
//    return '你的姓名是:'.$name;
//});