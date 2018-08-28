<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Admin;

class UserController extends Controller
{
    //登录页面---aLogin
    public function aLogin(Request $input){
        if ($input->isMethod('POST')){
            //处理登录信息
            $val = $input->except('_token');
            //验证数据
            $rule = [
                'aname'=>'required|max:25',
                'pass'=>'required|max:25',
                'code' => 'required|captcha'
            ];
            $msg = [
                'aname.required'=>'用户名不能为空',
                'pass.required'=>'输入密码不能为空',
                'code.required'=>'验证码不能为空',
                'code.captcha'=>'验证码不正确',
                'aname.max'=>'用户名长度不能超过25',
            ];
            $validator = Validator::make($val,$rule,$msg);
            if ($validator->fails()){
                return redirect('admin/login')->withErrors($validator)
                    ->withInput();
            }
            //解密
            $ret = Admin::where('aname',$val['aname'])->first();
            if ($ret){
                if ($val['pass'] == decrypt($ret->pass)){
                    session(['info'=>$ret]);
                    return redirect('admin/index');//跳到主页
                }else{
                    return back()->with('error','请输入正确的密码');
                }
            }else{
                return back()->with('error','用户不存在');
            }

        }else{
            return view('admin.login');
        }
    }

    //注册页面---aRegister
    public function aRegister(Request $input){
        if ($input->isMethod('POST')){
            $val = $input->except('_token');
            //验证数据
            $rule = [
                'aname'=>'required|max:25',
                'email'=>'required|email:email',
                'pass'=>'required|max:25',
                'pass1'=>'required|same:pass',
                'code' => 'required|captcha'
            ];
            $msg = [
                'aname.required'=>'用户名不能为空',
                'pass.required'=>'输入密码不能为空',
                'pass1.required'=>'再次密码不能为空',
                'email.required'=>'电子邮箱不能为空',
                'code.required'=>'验证码不能为空',
                'code.captcha'=>'验证码不正确',
                'email.email'=>'输入正确的电子邮件格式',
                'pass1.same'=>'两次输入密码不相等',
                'aname.max'=>'用户名长度不能超过25',
            ];
            $validator = Validator::make($val,$rule,$msg);
            if ($validator->fails()){
                return redirect('admin/reg')->withErrors($validator)
                            ->withInput();
            }
            //密码加密
            $val['pass'] = encrypt($val['pass']);
            $value = array_except($val,['code','pass1']);
            $ret = DB::table('admin')->insert($value);
            if ($ret){
                return redirect('admin/login');
            }else{
                return redirect('admin/reg')->with('error','注册失败');
            }
        }else{
            return view('admin.register');
        }
    }
    //用户退出
    public function exit(){
        session(['info'=>null]);
        if (!session('info')){
            return redirect('admin/login')->with('error','退出成功！');
        }
    }
}
