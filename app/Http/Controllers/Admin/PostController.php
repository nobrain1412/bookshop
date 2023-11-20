<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Post_Type_Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();
        $postTypes = PostType::all();
        if ($request->has('postTypes')) {
            $post_type = $request->input('postTypes');

            // Lấy ra bài viết có mối quan hệ với loại bài viết đã chọn
            if ($post_type != 0) {
                $postIds = Post_Type_Post::where('post_type', $post_type)->pluck('post_id')->all();
                $query->whereIn('id', $postIds);
            }
            // Lọc bài viết dựa trên danh sách các post_id đã lấy được
        }

        $posts = $query->paginate(3);
        return view('admin.post.index',compact('posts','postTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postTypes = PostType::all();
        return view('admin.post.add',compact('postTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //lưu dữ liệu vào database
        try {
            $user = User::where('id',1)->first();
            $post = new Post();
            //lấy tất cả dữ liệu trong data
            $post->fill($request->all());

            $post->user_id=$user->id;

            if ($request->hasFile('image')) {
                // Upload and store the image
                $uploadedImage = uploadFile('posts', $request->file('image'));
                if ($uploadedImage) {
                    // Update the 'image' attribute with the correct file path
                    $post->image = $uploadedImage;
                }
            }
            if ($post->slug == null) {
                $post->slug = Str::slug('$post->title');
            } else {
                Str::slug($post->slug);
            }
            $post->save();

            //gán dữ liệu vào bảng post_type_posts
            foreach ($request->post_type as $post_type) {
                $post_type_posts = new Post_Type_Post();
                $post_type_posts->post_id = $post->id;
                $post_type_posts->post_type = $post_type;
                $post_type_posts->save();
            }
            if ($post->save()) {
                toastr()->success('Thêm bài viết thành công!', 'success');
                return redirect()->route('post.index');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // Lỗi duplicate entry
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp.Vui lòng sửa đường dẫn']);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            // Xử lý khi bản ghi không tồn tại
            return redirect()->route('post.index')->with('error', 'Bản ghi không tồn tại.');
        }
        $postTypes = PostType::all();
        $post_type_posts = Post_Type_Post::where('post_id', $id)->get(); //lấy dữ liệu trong bảng post_type_posts theo post_id
        return view('admin.post.edit', compact('post', 'postTypes', 'post_type_posts'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        //cập nhật dữ liệu trong bảng post
        try {
            $model = Post::find($id);
            $model->fill($request->all());

            // đoạn này là odel -
            $image_old = $request->image; //nhưng có model này lf lấy từ db //uk xog gán $image_old tao sợ nó có hai cái mdoel nó k hiểu
            // dd($image_old);
            if ($request->hasFile('image') && $request->file('image')) {
                // delete_file($image_old);
                $deletetImg = Storage::delete($image_old);
                // $deleteImg=delete_file($image_old);
                // if($deleteImg){
                $model->image = uploadFile('posts', $request->file('image'));
                // }
            }
            $model->save();
            $postTypes = $request->input('post_type', []);    //lấy mảng dữ liệu ngoài giao diện
            $model->postTypePosts()->delete();               //xóa dự liệu cũ trong bảng post_type_posts
            foreach ($request->post_type as $post_type) {
                $post_type_posts = new Post_Type_Post();
                $post_type_posts->post_id = $model->id;
                $post_type_posts->post_type = $post_type;
                $post_type_posts->save();
            }
            if ($model->save()) {
                toastr()->success('Sửa mới bài viết thành công!', 'success');
                return redirect()->route('post.index');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // Lỗi duplicate entry
                return redirect()->back()->withErrors(['slug' => 'Slug đã bị trùng lặp.Vui lòng sửa đường dẫn']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Post::find($id);
        $data->delete();
        toastr()->success(' Xóa bài viết  thành công!', 'success');
        return redirect()->route('post.index');
    }
}
