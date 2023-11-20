@extends('layouts.client')
@section('content')
<style>
    #profile-nav{
        background-color: #77B748;
        height: 70px;
    }
</style>
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-innerbannercontent">
                    <h1 style="margin-bottom: 20px;">Thông tin cá nhân</h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li class="tg-active">Thông tin cá nhân</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 600px; margin-bottom: 30px;">
    <div class="collapse navbar-collapse tg-navigation" id="profile-nav" >
        <ul class="" style="margin-left: 10px;">
            <li><a style="padding: 20px 15px;" href="{{route('profile')}}">Thông tin cá nhân</a></li>
            
            <li><a style="padding: 20px 15px;" href="{{route('profile.changePassword')}}">Đổi mật khẩu</a></li>
            <li><a style="padding: 20px 15px;" href="{{route('logout')}}">Đăng xuất</a></li>
        </ul>
    </div>
    <div class="col-5">
        @yield('profile')
    </div>
</div>

@endsection