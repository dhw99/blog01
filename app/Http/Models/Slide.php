<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Slide extends Model
{
    public $table = 'slide';
    protected $primaryKey = 'slide_id';
    protected $guarded = [];
    public $timestamps = false;

    //表单验证
    public function check($data){
        $rules = [
            'slide_name'=>'required|max:25',
            'slide_url'=>'required|max:250',
        ];
        $msg = [
            'slide_name.required'=>'轮播图名称不能为空',
            'slide_name.max'=>'轮播图名称长度不能超过25',
            'slide_url.required'=>'轮播图地址不能为空',
            'slide_url.max'=>'轮播图地址长度不能超过250',
        ];
        $yan = Validator::make($data,$rules,$msg);
        return $yan->errors()->all();
    }
}
