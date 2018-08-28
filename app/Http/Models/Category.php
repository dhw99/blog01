<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Category extends Model
{
    public $table = 'category';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];

    //获取分类树
    public function getTree($data , $pid=0){
        $arr = [];
        $chu = count($data);
        foreach ($data as $k=>$v){
            if ($v->cate_pid == $pid){
                $data[$k]['name']=$data[$k]['cate_name'];
                $arr[] = $data[$k];
                foreach ($data as $k1=>$v1){
                    if ($v1->cate_pid == $v->cate_id){
                        $data[$k1]['name'] = '|-------'.$data[$k1]['cate_name'];
                        $arr[] = $data[$k1];
                    }
                }
            }
        }
        $end = count($arr);
        if ($end != $chu){
            $arr2 = [];
            foreach ($data as $s=>$z){
                $arr2[] = $z;
            }
            $arr1 = array_diff($arr2,$arr);
            $arr = array_merge($arr,$arr1);
        }
        return $arr;
    }

    //表单验证
    public function check($data){
        $rules = [
            'cate_name'=>'required|max:25',
            'cate_title'=>'required|max:50',
        ];
        $msg = [
            'cate_name.required'=>'分类名称不能为空',
            'cate_name.max'=>'分类名称长度不能超过25',
            'cate_title.required'=>'分类名称不能为空',
            'cate_title.max'=>'分类名称长度不能超过25',
        ];
        $yan = Validator::make($data,$rules,$msg);
        return $yan->errors()->all();
    }
}
