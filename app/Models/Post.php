<?php

namespace App\Models;
use App\Models\User;
use App\Models\PostType;
use App\Models\Post_Type_Post;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\comment;
use App\Models\Replies;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    public $table = 'posts';
    protected $fillable=['title','content','slug','image','user_id','status','view'];
    protected $casts = [
        'status' => 'integer',
    ];

    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
    public function postTypes()
    {
        return $this->belongsToMany(PostType::class, 'post_type_post', 'post_id', 'post_type');
    }
    public function postTypePosts()
    {
        return $this->hasMany(Post_Type_Post::class, 'post_id');
    }


}

