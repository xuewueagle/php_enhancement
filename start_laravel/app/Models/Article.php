<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    // 模型默认是没有开启软删除功能的,开启软删除
    use SoftDeletes;
    /**
     * 允许赋值的字段
     *
     * @var array
     */
    //protected $fillable = ['category_id', 'title', 'content'];
    
    /**
     * 不允许赋值的字段--$fillable 和 $guarded 只能定义其中的一个
     *
     * @var array
     */
    protected $guarded = [];
    
    
    
    /** 模型方法
     * 获取文章列表
     *
     * @return mixed
     */
    public function articleList()
    {
        $data = $this->select('category_id', 'title', 'content')
            ->where('title', '<>', '文章1')
            ->whereIn('id', [1, 2, 3])
            ->groupBy('category_id')
            ->orderBy('id', 'desc')
            ->get();
        return $data;
    }
}
