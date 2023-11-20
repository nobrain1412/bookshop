<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'authors';
    public $timestamps = 'true';
    public $fillable = [
        'name','slug','biography','nationality','image','birth_date','email','phone','status','facebook','instagram','twitter'
    ];
    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
