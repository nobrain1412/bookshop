<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostTypeRequest;
use App\Models\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postTypes = PostType::paginate(5);
        return view('admin.post-type.index',compact('postTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postTypes = PostType::all();
        return view('admin.post-type.add',compact('postTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostTypeRequest $request)
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $request->image = uploadFile('post-type', $request->file('image'));
            } else {
                $request->image = null;
            }
            if (!$request->slug) {
                $request->slug = Str::slug($request->name);
            } else {
                $request->slug = Str::slug($request->slug);
            }
            $postType = new PostType();
            $postType->name = $request->name;
            $postType->description = $request->description;
            $postType->status = $request->status;
            $postType->slug = $request->slug;
            $postType->image = $request->image;
            if ($request->parent_id && $request->parent_id !== 'none') {
                // Here we define the parent for new created category
                $node = PostType::find($request->parent_id);
                $node->appendNode($postType);
            }
            if ($postType->save()) {
                toastr()->success('Thêm mới danh mục bài viết thành công!', 'success');
                return redirect()->route('post-type.index');
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
        $postTypes = PostType::all();
        $postType = PostType::find($id);
        return view('admin.post-type.edit', compact('postType', 'postTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostTypeRequest $request, string $id)
    {
        try {
            $posType = PostType::find($id);
            $params = $request->except('_token', 'image');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::delete('/public/' . $posType->image);
                $request->image = uploadFile('postTypes', $request->file('image'));
                $params['image'] = $request->image;
            } else {
                $request->image = $posType->image;
            }
            if ($params['parent_id'] == 'none') {
                $params['parent_id'] = null;
            }
            if (!$request->slug) {
                $params['slug'] = Str::slug($params['name']);
            } else {
                $params['slug'] = Str::slug($request->slug);
            }
            // Lấy thông tin cũ của parent_id
            $oldParentId = $posType->parent_id;

            // Sử dụng DB transaction để bảo vệ tính toàn vẹn của nested set
            DB::beginTransaction();
            // Cập nhật thông tin cơ bản của danh mục
            $posType->update($params);

            // Nếu parent_id đã thay đổi, cập nhật vị trí của node trong cây
            if ($params['parent_id'] !== $oldParentId) {
                if ($params['parent_id'] === null) {
                    $posType->makeRoot();
                } else {
                    $newParent = PostType::find($params['parent_id']);
                    $posType->appendToNode($newParent)->save();
                }
            }

            // Commit transaction nếu mọi thứ thành công
            DB::commit();
            toastr()->success('Cập nhật danh mục bài viết thành công!', 'success');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                // Lỗi duplicate entry
                DB::rollBack(); // Lưu ý: Rollback transaction nếu xảy ra lỗi
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp. Vui lòng nhập tên khác']);
            }
            toastr()->error('Có lỗi xảy ra !', 'error');
        }

        return redirect()->route('post-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id) {
            $deleted = PostType::where('id', $id)->delete();
            if ($deleted) {
                toastr()->success('Xóa danh mục bài viết thành công!', 'success');
            } else {
                toastr()->error('Có lỗi xảy ra', 'error');
            }
            return redirect()->route('post-type.index');
        }
    }
}
