<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Article extends Model
{
    public $table = 'article';
    protected $primaryKey = 'art_id';
    protected $guarded = [];

    //表单验证
    public function check($data){
        $rules = [
            'art_content'=>'required|max:8000',
            'art_title'=>'required|max:50',
        ];
        $msg = [
            'art_content.required'=>'文章内容不能为空',
            'art_content.max'=>'文章内容不能超过8000字',
            'art_title.required'=>'文章标题不能为空',
            'art_title.max'=>'文章标题不能超过50',
        ];
        $yan = Validator::make($data,$rules,$msg);
        return $yan->errors()->all();
    }
}
