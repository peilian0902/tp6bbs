<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
//app目录下面定义provider.php文件（只能在全局定义，不支持应用单独定义），系统会自动批量绑定类库到容器中
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
];
