<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityComment extends Model
{
    use HasFactory;
    protected $table = "community_comments";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
