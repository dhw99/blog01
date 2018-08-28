<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //上传缩略图片
    public function upload(Request $upload){
        $file = $upload->file('Filedata');
        //验证是否验证成功
        if ($file->isValid()){
            $type = $file->extension();//获取类型
            $path = public_path().str_replace('/','\\','/uploads/');
            $name = time().rand(100,999).'.'.$type;
            $val = $file->move($path,$name);
            if ($val){
                $fname = 'uploads/'.$name;
                $img = Image::make($fname);
                $pic = 'pic'.$name;//缩略图名字
                $img->resize(365,247)->save($path.$pic);
                return 'uploads/'.$pic;
            }else{
                return '上传失败！';
            }
        }
    }
    public function upload1(Request $upload){
        $file = $upload->file('Filedata');
        //验证是否验证成功
        if ($file->isValid()){
            $type = $file->extension();//获取类型
            $path = public_path().str_replace('/','\\','/uploads/');
            $name = time().rand(100,999).'.'.$type;
            $val = $file->move($path,$name);
            if ($val){
                $fname = 'uploads/'.$name;
                $img = Image::make($fname);
                $pic = 'art'.$name;//缩略图名字
                $img->resize(760,450)->save($path.$pic);
                return 'uploads/'.$pic;
            }else{
                return '上传失败！';
            }
        }
    }
    public function upload2(Request $upload){
        $file = $upload->file('Filedata');
        //验证是否验证成功
        if ($file->isValid()){
            $type = $file->extension();//获取类型
            $path = public_path().str_replace('/','\\','/uploads/');
            $name = time().rand(100,999).'.'.$type;
            $val = $file->move($path,$name);
            if ($val){
                $fname = 'uploads/'.$name;
                $img = Image::make($fname);
                $pic = 'tou'.$name;//缩略图名字
                $img->resize(150,150)->save($path.$pic);
                return 'uploads/'.$pic;
            }else{
                return '上传失败！';
            }
        }
    }
}
