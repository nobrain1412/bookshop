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
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Cart;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return view("client.profile.profile", compact("user",));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod("post")) {
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
        return view("client.profile.profile", compact("user"));
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'password' => 'required|min:4|confirmed',
                'password_confirmation' => 'required',
            ], [
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
        return view('client.profile.changePassword', compact('user'));
    }

    public function cart()
    {
        $cart = Cart::content();
        return view('client.cart', compact('cart'));
    }

    public function addCart(Request $request, $id)
    {
        $book = Book::find($id);
        Cart::add([
            'id' => $book->id,
            'name' => $book->title,
            'qty' => 1,
            'price' => $book->price,
            'options' => [
                'image' => $book->image_url,
                // Add other options as needed
            ],
        ]);

        toastr()->success('Sản phẩm đã được thêm vào giỏ hàng!', 'success');
        return redirect(route('home'));
    }

    public function clearCart($id)
    {
        

        return redirect(route('cart'));
    }

    public function deleteCart()
    {
        Cart::destroy();
        return redirect(route('home'));
    }
    public function purchase(Request $request)
    {
        $cart = session::get('cart', []);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        return view('client.purchase', compact('cart'));
    }

    public function vnpay()
    {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "G4Z1U2GJ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "IWXHZBNPWNQTLRWNWOANTITLYJXLVCKS"; //Chuỗi bí mật

        $vnp_TxnRef = "10000"; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "thanh toán hoá đơn";
        $vnp_OrderType = "bookshop";
        
        $vnp_Amount =  floatval(Cart::total()) * 100000;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
}
