@extends('layouts.client')
@section('content')
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
<div class="container">
    <table>
        <thead>
            <th></th>
        </thead>
    </table>
</div>
@endsection