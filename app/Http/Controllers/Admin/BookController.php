<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(3);
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('admin.book.add', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        try {
            $imageNames = [];
            if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
                $request->image_url = uploadFile('books', $request->file('image_url'));
            } else {
                $request->image_url = null;
            }
            if (!$request->slug) {
                $request->slug = Str::slug($request->title);
            }
            $book = new Book();
            $book->title = $request->title;
            $book->slug = $request->slug;
            $book->image_url = $request->image_url;
            $book->price = $request->price;
            $book->stock_quantity = $request->stock_quantity;
            $book->page = $request->page;
            $book->publication_date = $request->publication_date;
            $book->page_count = $request->page_count;
            $book->publisher = $request->publisher;
            $book->language = $request->language;
            $book->featured = $request->featured;
            $book->description_short = $request->description_short;
            $book->description = $request->description;
            $book->status = $request->status;
            $book->author_id = $request->author_id;
            if ($request->book_image) {
                foreach ($request->file('book_image') as $file) {
                    $imageNames[] = uploadFile('book_images', $file);
                }
            }
            $book->save();
            $book->categories()->attach($request->category_id);
            $bookId = $book->id;
            foreach ($imageNames as $imageName) {
                BookImage::create([
                    'book_id' => $bookId,
                    'book_image' => $imageName
                ]);
            }
            if ($book->save()) {
                toastr()->success('Thêm mới sách thành công', 'success');
                return redirect()->route('book.index');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // Lỗi duplicate entry
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp.Vui lòng sửa đường dẫn']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        $authors = Author::all();
        $images = BookImage::where('book_id', $id)->get();
        return view('admin.book.edit', compact('authors', 'categories', 'book', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        try {
            $imageNames = [];
            $book = Book::find($id);
            if (!$request->slug) {
                $params['slug'] = Str::slug($request->title);
            }
            $params = $request->except('_token', 'image_url');
            if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
                Storage::delete('/public/' . $book->image_url);
                $request->image_url = uploadFile('books', $request->file('image_url'));
                $params['image_url'] = $request->image_url;
            } else {
                $request->image_url = $book->image_url;
            }
            $bookImages = BookImage::where('book_id', $id)->get();
            if ($request->hasFile('book_image')) {
                BookImage::where('book_id', $id)->delete();
                foreach ($bookImages as $image) {
                    Storage::delete('/public/' . $image->book_image);
                }
                foreach ($request->file('book_image') as $file) {
                    $imageNames[] = uploadFile('book_image', $file);
                }
                foreach ($imageNames as $imageName) {
                    BookImage::create([
                        'book_id' => $id,
                        'book_image' => $imageName
                    ]);
                }
            }
            $book->update($params);
            $book->categories()->sync($request->input('category_id'));
            toastr()->success('Cập nhật sách thành công!', 'success');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp. Vui lòng nhập tên khác']);
            }
            toastr()->error('Có lỗi xảy ra !', 'error');
        }

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $deleted = Book::where('id', $id)->delete();
            if ($deleted) {
                toastr()->success('Xóa sách thành công!', 'success');
            } else {
                toastr()->error('Có lỗi xảy ra', 'error');
            }
            return redirect()->route('book.index');
        }
    }
}
