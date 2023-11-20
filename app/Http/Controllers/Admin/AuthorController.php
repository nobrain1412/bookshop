<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::paginate(3);
        return view('admin.author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.author.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $request->image = uploadFile('authors', $request->file('image'));
            } else {
                $request->image = null;
            }
            if (!$request->slug) {
                $request->slug = Str::slug($request->name);
            } else {
                $request->slug = Str::slug($request->slug);
            }
            $author = new Author();
            $author->name = $request->name;
            $author->biography = $request->biography;
            $author->nationality = $request->nationality;
            $author->birth_date = $request->birth_date;
            $author->email = $request->email;
            $author->phone = $request->phone;
            $author->slug = $request->slug;
            $author->status = $request->status;
            $author->image = $request->image;
            $author->facebook = $request->facebook;
            $author->instagram = $request->instagram;
            $author->twitter = $request->twitter;

            if ($author->save()) {
                toastr()->success('Thêm mới tác giả thành công!', 'success');
                return redirect()->route('author.index');
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
        $author = Author::find($id);
        return view('admin.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $author = Author::find($id);
            $params = $request->except('_token', 'image');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::delete('/public/' . $author->image);
                $request->image = uploadFile('authors', $request->file('image'));
                $params['image'] = $request->image;
            } else {
                $request->image = $author->image;
            }
            if (!$request->slug) {
                $params['slug'] = Str::slug($params['name']);
            } else {
                $params['slug'] = Str::slug($request->slug);
            }
            // Cập nhật thông tin cơ bản của danh mục
            $author->update($params);
            toastr()->success('Cập nhật tác giả bài viết thành công!', 'success');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                // Lỗi duplicate entry
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp. Vui lòng nhập tên khác']);
            }
            toastr()->error('Có lỗi xảy ra !', 'error');
        }

        return redirect()->route('author.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $deleted = Author::where('id', $id)->delete();
            if ($deleted) {
                toastr()->success('Xóa tác giả thành công!', 'success');
            } else {
                toastr()->error('Có lỗi xảy ra', 'error');
            }
            return redirect()->route('author.index');
        }
    }
}
