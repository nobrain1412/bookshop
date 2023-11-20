<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryBook extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'category_books';
    public $timestamps = true;
    public $fillable = ['category_id','book_id'];
}
