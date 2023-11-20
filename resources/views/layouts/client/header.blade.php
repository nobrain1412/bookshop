<header id="tg-header" class="tg-header tg-haslayout">
	<div class="tg-topbar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul class="tg-addnav">
						<li>
							<a href="javascript:void(0);">
								<i class="icon-envelope"></i>
								<em>Liên hệ</em>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<i class="icon-question-circle"></i>
								<em>Giúp đỡ</em>
							</a>
						</li>
					</ul>
					<div class="dropdown tg-themedropdown tg-currencydropdown">
						<a href="javascript:void(0);" id="tg-currenty" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-earth"></i>
							<span>Tiền tệ</span>
						</a>
						<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-currenty">
							<li>
								<a href="javascript:void(0);">
									<i>£</i>
									<span>Đồng bảng anh</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);">
									<i>$</i>
									<span>Đô la mỹ</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);">
									<i>€</i>
									<span>Euro</span>
								</a>
							</li>
						</ul>
					</div>
					@guest
					<div class="tg-userlogin">
						<a href="{{route('login')}}"><button class="btn btn-success">Đăng nhập</button></a>
					</div>
					@else
					<div class=" dropdown  tg-themedropdown tg-currencydropdown" style="float: right;">
						<a class="" href="" id="tg-currenty" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img style="border-radius: 50%; width: 50px;" src="images/users/img-01.jpg" alt="image description">
							<span>Hi, {{ Auth::user()->name}}</span>
						</a>
						<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-currenty">
							<li>
								<a href="{{route('profile')}}"><span>Thông tin cá nhân</span></a>
							</li>
							<li>
								<a href="{{route('logout')}}"><span>Đăng xuất</span></a>
							</li>
						</ul>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="tg-middlecontainer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<strong class="tg-logo"><a href="{{route('home')}}"><img src="{{ asset('images/logo.png') }}" alt="company name here"></a></strong>
					<div class="tg-wishlistandcart">
						<div class="dropdown tg-themedropdown tg-wishlistdropdown">
							<a href="javascript:void(0);" id="tg-wishlisst" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="tg-themebadge">3</span>
								<i class="icon-heart"></i>
								<span>Yêu thích</span>
							</a>
							<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-wishlisst">
								<div class="tg-description">
									<p>Chưa có sản phẩm nào được thêm vào danh sách</p>
								</div>
							</div>
						</div>
						<div class="dropdown tg-themedropdown tg-minicartdropdown">
							<a href="javascript:void(0);" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="tg-themebadge">3</span>
								<i class="icon-cart"></i>
								<span>$123.00</span>
							</a>
							<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
								<div class="tg-minicartbody">
									<div class="tg-minicarproduct">
										<figure>
											<img src="images/products/img-01.jpg" alt="image description">

                                        </figure>
                                        <div class="tg-minicarproductdata">
                                            <h5><a href="javascript:void(0);">Our State Fair Is A Great Function</a>
                                            </h5>
                                            <h6><a href="javascript:void(0);">$ 12.15</a></h6>
                                        </div>
                                    </div>
                                    <div class="tg-minicarproduct">
                                        <figure>
                                            <img src="images/products/img-02.jpg" alt="image description">

                                        </figure>
                                        <div class="tg-minicarproductdata">
                                            <h5><a href="javascript:void(0);">Bring Me To Light</a></h5>
                                            <h6><a href="javascript:void(0);">$ 12.15</a></h6>
                                        </div>
                                    </div>
                                    <div class="tg-minicarproduct">
                                        <figure>
                                            <img src="images/products/img-03.jpg" alt="image description">

                                        </figure>
                                        <div class="tg-minicarproductdata">
                                            <h5><a href="javascript:void(0);">Have Faith In Your Soul</a></h5>
                                            <h6><a href="javascript:void(0);">$ 12.15</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="tg-minicartfoot">
                                    <a class="tg-btnemptycart" href="javascript:void(0);">
                                        <i class="fa fa-trash-o"></i>
                                        <span>Xóa sản phẩm của bạn</span>
                                    </a>
                                    <span class="tg-subtotal">Tổng tiền: <strong>35.78</strong></span>
                                    <div class="tg-btns">
                                        <a class="tg-btn tg-active" href="{{route('cart')}}">Xem giỏ hàng</a>
                                        <a class="tg-btn" href="javascript:void(0);">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tg-searchbox">
                        <form class="tg-formtheme tg-formsearch">
                            <fieldset>
                                <input type="text" name="search" class="typeahead form-control"
                                       placeholder="Tìm sách theo tiêu đề,tác giả ...">
                                <button type="submit"><i class="icon-magnifier"></i></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tg-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="tg-nav" class="tg-nav">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#tg-navigation" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                            <ul>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Danh mục</a>
                                    <!-- Trong view của bạn -->
                                    <ul class="sub-menu" id="categorySubMenu">
                                    @foreach ($categories as $category)
                                            <li class="menu-item-has-children" role="presentation">
                                                <a href="javascript:void(0);" class="category-link"
                                                   data-slug="{{ $category->slug }}">{{ $category->name }}</a>
                                                @if ($category->children->isNotEmpty())
                                                    <ul class="sub-menu">
                                                        @foreach ($category->children as $child)
                                                            <li>
                                                                <a href="#{{ $child->slug }}"
                                                                   aria-controls="{{ $child->slug }}" role="tab"
                                                                   data-toggle="tab">{{ $child->name }}</a>
                                                                {{-- Các tab con khác nếu có --}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="current-menu-item">
                                    <a href="">Trang chủ</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('home.author') }}">Tác giả</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('home.author') }}">Danh sách tác giả</a></li>
                                        <li><a href="authordetail.html">Thông tin chi tiết </a></li>
                                    </ul>
                                </li>
                                <li><a href="products.html">Sản phẩm bán chạy</a></li>
                                <li><a href="products.html">Giảm giá</a></li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Tin tức</a>
                                    <ul class="sub-menu">
                                        <li><a href="newslist.html">Danh sách tin tức</a></li>
                                        <li><a href="newsgrid.html">Lưới tin tức</a></li>
                                        <li><a href="newsdetail.html">Chi tiết tin tức</a></li>
                                    </ul>
                                </li>
                                <li><a href="contactus.html">Liên hệ</a></li>
                                <li class="menu-item-has-children current-menu-item">
                                    <a href="javascript:void(0);"><i class="icon-menu"></i></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href="aboutus.html">Sách</a>
                                            <ul class="sub-menu">
                                                <li><a href="products.html">Danh sách</a></li>
                                                <li><a href="productdetail.html">Chi tiết</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="aboutus.html">Về chúng tối</a></li>
                                        <li><a href="comingsoon.html">Sắp ra mắt</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
