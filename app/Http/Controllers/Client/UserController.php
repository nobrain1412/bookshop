<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile(){
        $user = auth()->user();

        return view("client.profile.profile",compact("user",));
    }
    public function updateProfile(Request $request){
        $user = auth()->user();
        if($request->isMethod("post")){
            $params = $request->except('_token');
            //dd($params);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageFileName = uploadFile('users', $request->file('image'));

                if (!empty($user->image)) {
                    Storage::delete('/public/' . $user->image);
                }
                $params['image'] = $imageFileName;
                //dd($params['image']);
            } else {
                $request->image = $user->image;
            }
            //dd($params);
            DB::beginTransaction();
            $user->update($params);
            DB::commit();
            toastr()->success('Cập nhật thông tin thành công!', 'success');


        }
        return view("client.profile.profile",compact("user"));
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('POST')) {
            $validate=$request->validate([
                'password' => 'required|min:4|confirmed',
                'password_confirmation' => 'required',
            ],[
                'password.required' => 'Password không được để trống',
                'password.min' => 'Password phải lớn hơn 4 ký tự',
                'password.confirmed' => 'Password không khớp',
                'password_confirmation.required' => 'Không được để trống mật khẩu nhập lại'
            ]);
                if (Hash::check($request->input('oldPassword'), $user->password)) {
                    $user->password = bcrypt($request->input('password'));
                    $user->save();
                    toastr()->success('Đổi mật khẩu thành công!', 'success');
                } else {
                    toastr()->error('Mật khẩu cũ không khớp', 'error');
                }
            return view('client.profile.changePassword');
        }
        return view('client.profile.changePassword',compact('user'));
    }

    public function cart(){
        $cart = session::get('cart',[]);
        return view('client.cart',compact('cart'));
    }

    public function addCart(Request $request,$id){
        $book = Book::find($id) ;
        $cart = session::get('cart',[]);
        if(isset($cart[$book->id])){
            $cart[$book->id]['quantity']++;
        }else{
            $cart[$book->id] = [
                'title' => $book->title,
                'price' => $book->price,
                'quantity'=>$book->quantity
            ];
            //dd($cart[$book->id]);
        }
        session::put('cart',$cart);

        toastr()->success('Sản phẩm đã được thêm vào giỏ hàng!', 'success');
        return redirect(route('home'));

    }
}
