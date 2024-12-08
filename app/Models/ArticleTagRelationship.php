<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTagRelationship extends Model
{
    protected $table = 'article_tag_relationship';
    protected $fillable = ['article_id', 'tag_id'];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
