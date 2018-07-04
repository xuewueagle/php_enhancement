<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class DatabaseController extends Controller
{
    // 创建路由创建控制器写填充的方式非常之不优雅--命令行创建填充文件去填充数据更现代化
    public function insert(){
        //DB::insert('insert into articles (category_id,title,content) values (1,"文章1","内容1")');
        
        DB::table('articles')->insert([
            [
                'category_id'=>2,
                'title'=>'文章2',
                'content'=>'内容2'
            ],
            [
                'category_id'=>3,
                'title'=>'文章3',
                'content'=>'内容3'
            ]
        ]);
    }
    
    /**
     * 查询方法
     */
    public function get(){
//        $data = DB::table('articles')->get();
//        dump($data);
        //dump($data[0]);
        $data = DB::table('articles')->where('id',1)->get();
        dump($data);
        
        $data = DB::table('articles')
                ->select('category_id', 'title', 'content')
                ->where('title', '<>', '文章1')
                ->whereIn('id', [1, 2, 3])
                ->groupBy('category_id')
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();
        dump($data);
        
        // ->get() 还可以替换为 first、count、sum、pluck、value;
        $data1 = DB::table('articles')->pluck('content','title');
        dump($data1);
        
        $data2 = DB::table('articles')->value('title');
        dump($data2);
        
        // ->leftJoin('users as u', 'u.id', 'articles.user_id') ;
        
        // Between
//        ->whereBetween('created_at', [$start, $end]);
//        //or
//        ->where('created_at', '>=', $start)->where('created_at', '<=', $end);
    }
}
