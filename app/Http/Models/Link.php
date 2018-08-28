<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Link extends Model
{
    public $table = 'link';
    protected $primaryKey = 'link_id';
    protected $guarded = [];

    //表单验证
    public function check($data){
        $rules = [
            'link_name'=>'required|max:30',
            'link_url'=>'required|max:200',
        ];
        $msg = [
            'link_name.required'=>'链接名称不能为空',
            'link_name.max'=>'链接名称长度不能超过30',
            'link_url.required'=>'链接地址不能为空',
            'link_url.max'=>'链接地址长度不能超过200',
        ];
        $yan = Validator::make($data,$rules,$msg);
        return $yan->errors()->all();
    }
}
