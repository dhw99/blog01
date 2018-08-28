<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Nav extends Model
{
    public $table = 'nav';
    protected $primaryKey = 'nav_id';
    protected $guarded = [];
    public $timestamps = false;

    //表单验证
    public function check($data){
        $rules = [
            'nav_name'=>'required|max:30',
            'nav_url'=>'required|max:200',
        ];
        $msg = [
            'nav_name.required'=>'导航名称不能为空',
            'nav_name.max'=>'导航名称长度不能超过30',
            'nav_url.required'=>'导航地址不能为空',
            'nav_url.max'=>'导航地址长度不能超过20',
        ];
        $yan = Validator::make($data,$rules,$msg);
        return $yan->errors()->all();
    }
}
