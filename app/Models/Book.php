<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'books';
    protected $fillable = [
        'title',
        'slug',
        'image_url',
        'price',
        'stock_quantity',
        'view',
        'page',
        'publication_date',
        'page_count',
        'publisher',
        'language',
        'description_short',
        'description',
        'author_id',
        'status',
        'featured'
    ];
    public function images()
    {
        return $this->hasMany(BookImage::class, 'book_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_books', 'book_id', 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

}
