<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Filesystem;
use app\common\validate\Avatar as AvatarValidate;
use app\common\exception\ValidateException;

class Upload
{
    /**
     * 保存上传图片
     * @Author   zhanghong(Laifuzi)
     * @param    File               $file         文件信息
     * @return   array
     */
    static public function saveImage($file): array
    {
        // 所有上传文件都保存在项目 public/storage/uploads 目录里
        //$save_name = Filesystem::disk('public')->putFile('uploads', $file, 'md5');
        //$save_name = str_replace('\\','/',$save_name);//win操作系统下删除了 \ 分隔符

        //修改：实现在保存之前用 Avatar 验证一下上传图片是否合法
        $validate = new AvatarValidate;
        if (!$validate->batch(true)->check(['file' => $file])) {
            $e = new ValidateException('上传图片失败');
            $e->setData($validate->getError());
            throw $e;
        }

        // 所有上传文件都保存在项目 public/storage/uploads 目录里
        $save_name = Filesystem::disk('public')->putFile('uploads', $file, 'md5');
        $save_name = str_replace('\\','/',$save_name);//win操作系统下删除了 \ 分隔符

        return [
            'ext' => $file->extension(),
            // 文件实际存储在 public/storage 目录里
            'save_path' => '/storage/'.$save_name,
            'sha1' => $file->hash("sha1"),
            'md5' => $file->hash("md5"),
            'size' => $file->getSize(),
            'origin_name' => $file->getOriginalName(),
        ];
    }


}