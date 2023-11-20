<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookImage extends Model
{
    use HasFactory;
    protected $table = 'book_images';
    public $timestamps = true;
    public $fillable = ['book_id','book_image'];
}
