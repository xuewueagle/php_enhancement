<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "这里是index方法";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "这里是create方法";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$name)
    {
        return '地址栏传的参数是：'.$id.'和'.$name;
    }
    
    // http://www.laravel.test.com/article/edits/123/%E5%91%B5%E5%91%B5?music=%E5%9B%BD%E6%AD%8C&book=%E7%99%BD%E5%A4%9C%E8%A1%8C
    public function edits(Request $request,$id,$name)
    {
        // 获取请求参数（与路由参数是有区别的，$id,$name是路由参数）
        $music = $request->input('music'); // 在控制器中更推荐使用 $request 
        $book  = request()->input('book');
        /*
         * <<<EOF 和 EOF; 之间的文本, 可以不用转义, 比如单引号和双引号
一般用于输出长的html文本或者文本赋值
例子：
$str = <<<EOF
123123123
EOF;
这里的EOF是一个标记，即是以EOF开头的必须以EOF结尾
你可以换成其他字符也没问题
还必须注意，EOF;这个结尾必须有分号，而且EOF必须顶格，之前没有任何字符，包括空格
         *  1.PHP定界符的作用就是按照原样，包括换行格式什么的，输出在其内部的东西； 
            2.在PHP定界符中的任何特殊字符都不需要转义； 
            3.PHP定界符中的PHP变量会被正常的用其值来替换
         */
        
        // php定界符 之间的文本, 可以不用转义, 比如单引号和双引号
        // //下面<<<php后面不能有空格
        $str = <<<php
            id： $id <br>
            name： $name <br>
            music： $music <br>
            book： $book <br>
php;
        //dump($request->all()); //打印数据但不 die 掉
        //dd($request->all()); // 打印数据并 die 掉
        //echo $request->all()['book'];
        //dump($request->only('music', 'book')); // 从一大堆请求参数中获取指定的请求参数
        dump($request->except('music')); // 排除某个参数(music)剩下的全要
        
        return $str;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 获取请求参数（与路由参数是有区别的）
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
