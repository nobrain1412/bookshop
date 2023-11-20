<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(3);
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.category.add',compact('categories'));
    }


    public function store(Request $request)
    {
        try {
            if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
                $request->image_url = uploadFile('categories', $request->file('image_url'));
            } else {
                $request->image_url = null;
            }
            if (!$request->slug) {
                $request->slug = Str::slug($request->name);
            } else {
                $request->slug = Str::slug($request->slug);
            }
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->slug = $request->slug;
            $category->image_url = $request->image_url;
            if ($request->parent_id && $request->parent_id !== 'none') {
                // Here we define the parent for new created category
                $node = Category::find($request->parent_id);
                $node->appendNode($category);
            }
            if ($category->save()) {
                toastr()->success('Thêm mới danh mục thành công!', 'success');
                return redirect()->route('category.index');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // Lỗi duplicate entry
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp.Vui lòng sửa đường dẫn']);
            }
        }
    }
    public function edit($id) {
        $categories = Category::all();
        $category = Category::find($id);
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update($id,Request $request)
    {
        try {
            $category = Category::find($id);
            $params = $request->except('_token', 'image_url');
            if ($request->hasFile('image_url') && $request->file('image_url')->isValid()) {
                Storage::delete('/public/' . $category->image_url);
                $request->image_url = uploadFile('categories', $request->file('image_url'));
                $params['image_url'] = $request->image_url;
            } else {
                $request->image_url = $category->image_url;
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
            $oldParentId = $category->parent_id;

            // Sử dụng DB transaction để bảo vệ tính toàn vẹn của nested set
            DB::beginTransaction();
            // Cập nhật thông tin cơ bản của danh mục
            $category->update($params);

            // Nếu parent_id đã thay đổi, cập nhật vị trí của node trong cây
            if ($params['parent_id'] !== $oldParentId) {
                if ($params['parent_id'] === null) {
                    $category->makeRoot();
                } else {
                    $newParent = Category::find($params['parent_id']);
                    $category->appendToNode($newParent)->save();
                }
            }

            // Commit transaction nếu mọi thứ thành công
            DB::commit();
            toastr()->success('Cập nhật danh mục thành công!', 'success');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                // Lỗi duplicate entry
                DB::rollBack(); // Lưu ý: Rollback transaction nếu xảy ra lỗi
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp. Vui lòng nhập tên khác']);
            }
            toastr()->error('Có lỗi xảy ra !', 'error');
        }

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        if ($id) {
            $deleted = Category::where('id', $id)->delete();
            if ($deleted) {
                toastr()->success('Xóa danh mục thành công!', 'success');
            } else {
                toastr()->error('Có lỗi xảy ra', 'error');
            }
            return redirect()->route('category.index');
        }
    }
}
