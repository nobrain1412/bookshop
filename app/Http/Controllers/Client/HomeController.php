<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $bestSellingBooks = Book::with('categories')->get();
        $bookFeatured = Book::where('featured', 1)->latest()->first();
        $newestBooks = Book::latest()->take(3)->get();
        $authorsWithBooks = Author::with('books')->get();
        $authors =  Author::withCount('books')->get();
        $posts = Post::all();
        return view('client.home',compact('bestSellingBooks'
            ,'bookFeatured'
            ,'newestBooks'
            ,'authorsWithBooks'
            ,'authors'
            ,'posts'
        ));
    }
}
