<?php
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            //'yunpian',
            'yunzhixun',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
//        'yunpian' => [
//            'api_key' => env('easysms.yunpian_api_key'),
//            'signature' => env('easysms.yunpian_signature'),
//        ],
        'yunzhixun' => [
            'app_id' => env('easysms.yunzhixun_appid'),
            'sid' => env('easysms.yunzhixun_account_sid'),
            'token' => env('easysms.yunzhixun_auth_token'),
        ],
    ],
];
