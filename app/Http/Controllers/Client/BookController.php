<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function bookDetail(Request $request,$id) {
        $bookFeatured = Book::where('featured', 1)->latest()->first();
        $book = Book::find($id);
        $categoryId = $book->categories->first()->id; // Lấy id của danh mục sách
        $booksInCategory = Category::find($categoryId)->books; // Lấy sách thuộc danh mục
        return view('client.product-detail',compact('bookFeatured','book','booksInCategory'));
    }
}
