<?php
// 这是admin应用的middleware定义文件
//注册中间件
return [
    //tpauth中间件
    //'tpadmin.admin' => \tpadmin\middleware\AuthCheck::class,
    //tprole中间件
    //'tpadmin.admin.role' => \tpadmin\middleware\RoleCheck::class,

    // 全局请求缓存
    //\think\middleware\CheckRequestCache::class,
    // 多语言加载
    //\think\middleware\LoadLangPack::class,
    // Session初始化
    //\think\middleware\SessionInit::class,


    //定义别名 可以直接在应用配置目录下的middleware.php中先预定义中间件（其实就是增加别名标识）

];
