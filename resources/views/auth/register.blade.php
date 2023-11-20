@extends('layouts.client')
@section('content')
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-innerbannercontent">
                    <h1 style="margin-bottom: 20px;">Đăng ký</h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li class="tg-active">Đăng ký</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 350px; margin-bottom: 100px;">

    <form class="border" style="width: 30%; margin: auto;" action="{{route('register')}}" method="post">

        @csrf
        <div class="row text-center">
            <h4 class="">Welcome To</h4>
            <h3 class="">Book Library</h3>
        </div>
        <div class="form-group">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="">User name</label>
            <input class="form-control" type="text" name="name" placeholder="Nhập tên">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" type="text" name="email" placeholder="Nhập email">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" type="password" name="password" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="">
        </div>
        <button type="submit" class="btn btn-success form-control">Đăng ký</button>
        <div class="" style="margin-top: 20px; ">
            <a style=" font-size: 16px;" href="{{route('login')}}">Đăng nhập</a>
            <a style="float: right; font-size: 16px;" href="{{route('register')}}">Quên mật khẩu</a>
        </div>
    </form>
</div>

@endsection