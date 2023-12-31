<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'contents', 'user_id','image_at', 'category_id'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function goods()
    {
        return $this->hasMany('App\Models\Good');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }
}
