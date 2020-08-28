<?php
declare (strict_types = 1);

namespace app\index\controller;

use think\Request;
use app\common\validate\User as UserValidate;

class Verify extends Base
{
    /**
     * AJAX验证手机验证码
     * @return \think\response\Json|void
     */
    public function valid_code()
    {
        if (!$this->request->isAjax()) {
            return $this->redirect('/');
        } else if (!$this->request->isPost()) {
            return $this->error('对不起，你访问页面不存在。', '/');
        }

        $is_valid = false;

        $validate = new UserValidate();
        $param = $this->request->post();
        if (isset($param['sms_code'])) {
            $sms_code = $param['sms_code'];
            $is_valid = $validate->checkCode($sms_code, '', $param);
        }

        if ($is_valid === true) {
            echo('true');
        } else {
            echo('false');
        }
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
