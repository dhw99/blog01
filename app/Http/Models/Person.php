<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Person extends Model
{
    public $table = 'person';
    protected $primaryKey='about_id';
    protected $guarded = [];
    public $timestamps = false;


    //验证数据
    public function validate($data){
        $rules = [
            'about_author'=>'required|max:50',
            'about_email'=>'email',
            'about_content'=>'required|max:3500',
        ];
        $msg = [
            'about_author.required'=>'个人名字不能为空',
            'about_author.max'=>'个人名字长度不能超过50',
            'about_email.email'=>'必须是正确的电子邮箱格式',
            'about_content.required'=>'介绍内容不能为空',
            'about_content.max'=>'介绍内容长度不能超过3500',
        ];
        $yan = Validator::make($data,$rules,$msg);
        return $yan->errors()->all();
    }
}
