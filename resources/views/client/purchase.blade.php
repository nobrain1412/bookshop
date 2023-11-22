@extends('layouts.client')
@section('content')
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-innerbannercontent">
                    <h1>Thanh toán</h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="javascript:void(0);">Trang chủ</a></li>
                        <li><a href="javascript:void(0);">Thanh toán</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<main id="tg-main" class="tg-main tg-haslayout">
    <div class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">

                <form action="{{route('purchase')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3>Địa chỉ giao hàng</h3>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-3"><label for="">Họ tên người nhận</label></div>
                        <div class="col-xs-5"><input width="200px" type="text" name="name" id=""></div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-3"><label for="">Email</label></div>
                        <div class="col-xs-5"><input width="100%" type="text" name="email" id=""></div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-3"><label for="">Số điện thoại</label></div>
                        <div class="col-xs-5"><input width="100%" type="text" name="phone" id=""></div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-3"><label for="">Địa chỉ</label></div>
                        <div class="col-xs-5"><input width="100%" type="text" name="address" id=""></div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-3"><label for="">Phương thức thanh toán</label></div>
                        <div class="col-xs-5"><select  name="purchase" id="">
                            <option value="1">Thanh toán khi nhận hàng</option>
                            <option value="2">Thanh toán qua paypal</option>
                        </select></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection