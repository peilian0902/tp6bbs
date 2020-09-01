<?php
declare (strict_types = 1);

namespace app\index\controller;

use think\facade\Session;
use app\common\model\Sms;
use app\common\model\User;
use app\common\exception\ValidateException;

class Reset extends Base
{
    public function create()
    {
        return $this->fetch('create');
    }

    public function save()
    {
        if (!$this->request->isPost() || !$this->request->isAjax()) {
            $message = '对不起，你访问页面不存在。';
            // 在跳转前把错误提示消息写入 session 里
            Session::flash('danger', $message);
            return $this->error($message, '[page.reset]');
        }

        $param = $this->request->post();
        try {
            User::resetPassword($param);
        } catch (ValidateException $e) {
            return $this->error('对不起，你填写的信息不正确。', null, ['errors' => $e->getData()]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        $message = '恭喜你重置密码成功。';
        Session::set('success', $message);
        //return $this->success($message, '[page.login]');
        return $this->success($message, 'login/create');
    }

    /**
     * 发送重置验证码
     * @Author   zhanghong(Laifuzi)
     */
    public function send_code()
    {
        if (!$this->request->isPost() || !$this->request->isAjax()) {
            $message = '对不起，你访问页面不存在。';
            // 在跳转前把错误提示消息写入 session 里
            Session::flash('danger', $message);
            return $this->error($message, '[page.reset]');
        }

        $mobile = $this->request->post('mobile');
        if (empty($mobile)) {
            return $this->error('对不起，注册手机号码不能为空。');
        } else if (!User::where('mobile', $mobile)->count()) {
            return $this->error('对不起，你填写的手机号码还未注册。');
        }

        try {
            $sms = new Sms();
            $sms->sendCode($mobile);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success('验证码发送成功。');
    }

    /**
     * 验证手机号码是否已注册
     * @Author   zhanghong(Laifuzi)
     */
    public function mobile_present()
    {
        if (!$this->request->isPost() || !$this->request->isAjax()) {
            $message = '对不起，你访问页面不存在。';
            // 在跳转前把错误提示消息写入 session 里
            Session::flash('danger', $message);
            return $this->error($message, '[page.reset]');
        }

        $mobile = $this->request->post('mobile');
        if (empty($mobile)) {
            echo('false');
        } else if (User::where('mobile', $mobile)->count()) {
            echo('true');
        } else {
            echo('false');
        }
    }
}
