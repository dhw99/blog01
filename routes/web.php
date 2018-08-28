<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前台页面路由
Route::namespace('Index')->group(function (){
    Route::get('/','IndexController@index');//前台首页
    Route::get('list/{art_id}','IndexController@list');//展示文章
    Route::get('nav/{cate_id}','IndexController@info');//分类文章列表
    Route::get('about/{about_id}','IndexController@about');//关于我介绍
    Route::match(['get','post'],'search','IndexController@search');//关于我介绍
});


/*
 * 后台路由
 */
//后台用户注册和登录
Route::match(['get','post'],'admin/login','Admin\UserController@aLogin');
Route::match(['get','post'],'admin/reg','Admin\UserController@aRegister');
Route::middleware('checkLogin')->namespace('admin')->prefix('admin')->group(function (){
    Route::get('exit','UserController@exit');//退出
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    //分类
    Route::get('cList','CateController@list');
    Route::get('cDel/{cate_id}','CateController@del');
    Route::post('cpDel','CateController@delete');//批量删除
    Route::post('changeSort','CateController@changeSort');//排序
    Route::match(['get','post'],'cAdd','CateController@add');
    Route::match(['get','post'],'cEdit/{cate_id}','CateController@edit');//编辑
    //上传图片
    Route::post('upload','CommonController@upload');
    Route::post('upload1','CommonController@upload1');
    Route::post('upload2','CommonController@upload2');
    //文章
    Route::get('aList','ArticleController@list');
    Route::match(['get','post'],'aAdd','ArticleController@add');
    Route::get('aDel/{art_id}','ArticleController@del');//单个删除
    Route::post('wpDel','ArticleController@delete');//文章批量删除
    Route::match(['get','post'],'aEdit/{art_id}','ArticleController@edit');//文章编辑
    Route::post('aSort','ArticleController@changeSort');//文章排序
    //友情链接
    Route::get('lList','LinkController@list');
    Route::match(['get','post'],'lAdd','LinkController@add');
    Route::match(['get','post'],'lEdit/{link_id}','LinkController@edit');//友情链接编辑
    Route::get('lDel/{link_id}','LinkController@del');//单个删除
    Route::post('lpDel','LinkController@delete');//链接批量删除
    Route::post('lSort','LinkController@changeSort');//链接排序

    //导航管理
    Route::match(['get','post'],'nAdd','NavController@add');
    Route::get('nList','NavController@list');
    Route::match(['get','post'],'nEdit/{nav_id}','NavController@edit');
    Route::get('nDel/{nav_id}','NavController@del');//单个删除
    Route::post('npDel','NavController@delete');//导航批量删除
    Route::post('nSort','NavController@changeSort');//导航排序
    //轮播图
    Route::get('sList','SlideController@list');
    Route::match(['get','post'],'sAdd','SlideController@add');
    Route::match(['get','post'],'sEdit/{slide_id}','SlideController@edit');
    Route::get('sDel/{slide_id}','SlideController@del');//单个删除
    Route::post('spDel','SlideController@delete');//链接批量删除
    Route::post('spDel','SlideController@delete');//导航批量删除
    Route::post('sSort','SlideController@changeSort');//导航排序
    //关于我
    Route::get('aboutList','PersonController@list');//个人介绍列表
    Route::match(['get','post'],'aboutAdd','PersonController@add');//个人介绍列表
    Route::match(['get','post'],'aboutEdit/{about_id}','PersonController@edit');//个人介绍列表
    Route::get('aboutDel/{about_id}','PersonController@del');//个人介绍列表
});


