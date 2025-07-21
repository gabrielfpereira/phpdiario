<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'status',
        'views',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'allow_comments',
        'is_pinned',
        'published',
        'image',
        'author',
        'published_at',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
