<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ModelController extends Controller
{
    
    public function index(Article $articleModel){
        $data = $articleModel->get();
        dump($data);
        dump($data->toArray());
        // 查询包括软删除的数据在内的所有数据
        $data1 = Article::withTrashed()->get();
        dump($data1);
        
        // 恢复删除的方法
        //$articleModel->where('id', $id)->restore();
       
    }
    
    /**
     * 查询
     * @param Article $articleModel
     */
    public function get(Article $articleModel){
        $data = Article::select('category_id', 'title', 'content')
        ->where('title', '<>', '文章1')
        ->whereIn('id', [1, 2, 3])
        ->groupBy('category_id')
        ->orderBy('id', 'desc')
        ->get();
        dump($data->toArray());
        
        $data1 = $articleModel->articleList();
        dump($data1->toArray());
    }
    
    /**
     * 插入数据
     * @param Article $articleModel
     */
    public function store(Article $articleModel){
        $data = [
            'category_id'=>'6',
            'title'=>'文章6',
            'content'=>'内容6'
        ];
        $result = $articleModel->create($data);
        dump($result);
        // 返回新增数据的id
        dump($result->id);
    }
    
    /**
     * 更新数据
     * @param Article $articleModel
     */
    public function update(Article $articleModel){
        $id = 6;
        $data = [
            'category_id'=>'2',
            'title'=>'文章6',
            'content'=>'内容6'
        ];
        $result = $articleModel->where('id',$id)->update($data);
        dump($result); // 1   ---更新成功返回1
    }
    
    /**
     * 删除
     */
    public function delete(Article $articleModel){
        $id = 6;
        $result = $articleModel->where('id',$id)->delete();
        dump($result);// 1   ---删除成功返回1
        
        // 彻底删除
        //$articleModel->where('id', $id)->forceDelete();
    }
    
    
}
