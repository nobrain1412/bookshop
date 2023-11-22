@extends('layouts.client')
@section('content')
<style>
    #table{
        margin-top: 300px;
    }
</style>
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100"
         data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-innerbannercontent">
                        <h1>Giỏ hàng</h1>
                        <ol class="tg-breadcrumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="tg-active">Giỏ hàng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="d-flex" id="table">
    <a style="margin: 50% 50%; " href="{{route('purchase')}}"><button class="btn btn-success">Thanh toán</button></a>   
    <table >
        <thead>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($cart as $c)
                <tr>
                    <td><img src="{{ Storage::url($c['image']) }}" alt=""></td>
                    <td>{{$c['title']}}</td>
                    <td>{{$c['price']}}</td>
                    <td>{{$c['quantity']}}</td>
                    <td>{{$c['price'] * $c['quantity']}}</td>
                    <td><a style="margin-top: 10px;" href="{{route('cart.clear',['id'=>$c['id']])}}"><button class="btn btn-danger">Xoá sản phẩm</button></a></td>
                </tr>
               
            @endforeach
        </tbody>
        
    </table>
    
    <a href="{{route('cart.delete')}}"><button class="btn btn-danger">clear cart</button></a>
</div>
@endsection