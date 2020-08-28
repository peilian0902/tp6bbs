<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Cache;
use think\facade\Config;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class Sms
{
    protected $easysms;

    public function __construct()
    {
        $cfg = Config::get('easysms');
        if (!is_array($cfg)) {
            $cfg = [];
        }
        $this->easysms = new EasySms($cfg);
    }

    /**
     * 发送短信
     * @Author   zhanghong(Laifuzi)
     * @param    string             $mobile 手机号码
     * @return   bool
     */
    public function sendCode(string $mobile): bool
    {
        //$code = mt_rand(100000, 999999);
        $code = 654321;
        //$content = '您的验证码是'.$code.'。如非本人操作，请忽略本短信';
        //$this->sendByYunPian($mobile, $content);

        //$content = '【一缕阳光】您的验证码是'.$code.'，请在10钟内输入。';
        //$this->sendByYunZhiXun($mobile, $content);

        //首先启动Redis服务 然后根据php的redis扩展连接的redis服务

        // 短信发送成功后把发送的验证码保存在redis里
        Cache::store('redis')->set($mobile, $code, 60 * 5);//现在60秒 x 5 过期 即5分钟过期
        return true;
    }

    /**
     * 云片平台发送短信方法
     * @Author   zhanghong(Laifuzi)
     * @param    string             $mobile  手机号码
     * @param    string             $content 短信内容
     * @return   array
     */
    private function sendByYunPian(string $mobile, string $content): array
    {
        try {
            return $this->easysms->send($mobile, [
                'content'  => $content,
            ]);

        } catch (NoGatewayAvailableException $exception) {
            throw new \Exception($exception->getException('yunpian')->getMessage());
        }
    }

    /**
     * 云之讯平台发送短信方法
     * @Author   zhanghong(Laifuzi)
     * @param    string             $mobile  手机号码
     * @param    string             $content 短信内容
     * @return   array
     */
    private function sendByYunZhiXun(string $mobile, string $content): array
    {
        try {
            $result = $this->easysms->send(15240707477, [
                'template' => '562302',
                'data' => [
                    'params' => '8946,3',   // 模板参数，多个参数使用 `,` 分割，模板无参数时可为空
                    'uid' => '',  // 用户 ID，随状态报告返回，可为空
                    //'mobiles' => '18888888888,188888888889',    // 批量发送短信，手机号使用 `,` 分割，不使用批量发送请不要设置该参数
                ],
            ]);

            return $result;

//            return $this->easysms->send($mobile, [
//                'content'  => $content,
//            ]);

        } catch (NoGatewayAvailableException $exception) {
            throw new \Exception($exception->getException('yunzhixun')->getMessage());
        }
    }
}