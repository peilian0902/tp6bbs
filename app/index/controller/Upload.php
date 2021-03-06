<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\model\Upload as UploadModel;
use app\common\exception\ValidateException;

class Upload extends Base
{
    public function create()
    {
        return $this->save_image();
    }


    public function save()
    {
        return $this->save_image();
    }

    private function save_image00()
    {
        // 绑定控制名称
        $backcall = $this->request->param('backcall');
        // 图片预览宽度(px)
        $width = $this->request->param('width', 100);
        // 图片预览高度(px)
        $height = $this->request->param('height', 100);

        if ($this->request->isPost()) {
            // 保存上传图片
            $file = $this->request->file('image');
            $upload_info = UploadModel::saveImage($file);
            // 保存成功的图片路径
            $image = $upload_info['save_path'];
        } else {
            // 当前图片路径
            $image = $this->request->param('image');
        }

        return $this->fetch('create', [
            'backcall' => $backcall,
            'width' => $width,
            'height' => $height,
            'image' => $image,
        ]);
    }

    private function save_image()
    {
        // 绑定控制名称
        $backcall = $this->request->param('backcall');
        // 图片预览宽度(px)
        $width = $this->request->param('width');
        // 图片预览高度(px)
        $height = $this->request->param('height');
        // 当前图片路径
        $image = $this->request->param('image');
        // 错误信息
        $error_msg = '';

        if ($this->request->isPost()) {
            $file = $this->request->file('image');
            try {
                $upload_info = UploadModel::saveImage($file);
                $image = $upload_info['save_path'];
            } catch (ValidateException $e) {
                $errors = $e->getData();
                // 获取异常错误提示信息
                $error_msg = $errors['file'];
            }
        }

        //指定模板 传递参数
        return $this->fetch('create', [
            'backcall' => $backcall,
            'width' => $width,
            'height' => $height,
            'image' => $image,
            'error_msg' => $error_msg,
        ]);
    }
}
