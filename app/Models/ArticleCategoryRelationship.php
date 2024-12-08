<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategoryRelationship extends Model
{
    protected $table = 'article_category_relationship';

    protected $fillable = ['article_id', 'category_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   
}
