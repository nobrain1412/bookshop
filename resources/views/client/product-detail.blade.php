@extends('layouts.client')
@section('content')
    <!--************************************
				Inner Banner Start
		*************************************-->
    <div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100"
         data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-innerbannercontent">
                        <h1>Tất cả sản phẩm</h1>
                        <ol class="tg-breadcrumb">
                            <li><a href="javascript:void(0);">Trang chủ</a></li>
                            <li><a href="javascript:void(0);">Sản phẩm</a></li>
                            <li class="tg-active">{{ $book->title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
                    Inner Banner End
            *************************************-->
    <!--************************************
                    Main Start
            *************************************-->
    <main id="tg-main" class="tg-main tg-haslayout">
        <!--************************************
                        News Grid Start
                *************************************-->
        <div class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
                            <div id="tg-content" class="tg-content">
                                <div class="tg-featurebook alert" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="tg-featureditm">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs">
                                                <figure><img style="width: 200px"
                                                             src="{{ Storage::url($bookFeatured->image_url) }}"
                                                             alt="image description"></figure>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                                <div class="tg-featureditmcontent">
                                                    <div class="tg-themetagbox"><span class="tg-themetag">Đặc sắc</span>
                                                    </div>
                                                    <div class="tg-booktitle">
                                                        <h3><a href="javascript:void(0);">{{ $bookFeatured->title }}</a>
                                                        </h3>
                                                    </div>
                                                    <span class="tg-bookwriter">By: <a
                                                            href="javascript:void(0);">{{ $bookFeatured->author->name }}</a></span>
                                                    <span class="tg-stars"><span></span></span>
                                                    <div class="tg-priceandbtn">
													<span class="tg-bookprice">
														<ins>{{ number_format($bookFeatured->price, 0, '.', ',')  }} VNĐ</ins>
													</span>
                                                        <a class="tg-btn tg-btnstyletwo tg-active"
                                                           href="javascript:void(0);">
                                                            <i class="fa fa-shopping-basket"></i>
                                                            <em>Thêm vào giỏ</em>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tg-productdetail">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            <div class="tg-postbook">
                                                <figure class="tg-featureimg"><img
                                                        src="{{ Storage::url($book->image_url) }}"
                                                        alt="image description"></figure>
                                                <div class="tg-postbookcontent">
												<span class="tg-bookprice">
													<ins>{{ number_format($book->price, 0, '.', ',')  }} VNĐ</ins>
												</span>
                                                    <ul class="tg-delevrystock">
                                                        <li>
                                                            <i class="icon-rocket"></i><span>Giao hàng miễn phí trên toàn thế giới</span>
                                                        </li>
                                                        <li><i class="icon-checkmark-circle"></i><span>Gửi hàng từ Mỹ về sau 2 ngày làm việc</span>
                                                        </li>
                                                        <li>
                                                            <i class="icon-store"></i><span>Trạng thái: <em>Còn hàng</em></span>
                                                        </li>
                                                    </ul>
                                                    <div class="tg-quantityholder">
                                                        <em class="minus">-</em>
                                                        <input type="text" class="result" value="0" id="quantity1"
                                                               name="quantity">
                                                        <em class="plus">+</em>
                                                    </div>
                                                    <a class="tg-btn tg-active tg-btn-lg" href="javascript:void(0);">Thêm
                                                        vào giỏ</a>
                                                    <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                                                        <span>Thêm vào yêu thích</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                            <div class="tg-productcontent">
                                                <ul class="tg-bookscategories">
                                                    @foreach($book->categories as $category)
                                                        <li>
                                                            <a href="javascript:void(0);">{{ $category->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tg-booktitle">
                                                    <h3>{{ $book->title }}</h3>
                                                </div>
                                                <span class="tg-bookwriter">By: <a
                                                        href="javascript:void(0);">{{ $book->author->name }}</a></span>
                                                <span class="tg-stars"><span></span></span>
                                                <span class="tg-addreviews"><a
                                                        href="javascript:void(0);">Thêm đánh giá</a></span>
                                                <div class="tg-share">
                                                    <span>Chia sẻ:</span>
                                                    <ul class="tg-socialicons">
                                                        <li class="tg-facebook"><a href="javascript:void(0);"><i
                                                                    class="fa fa-facebook"></i></a></li>
                                                        <li class="tg-twitter"><a href="javascript:void(0);"><i
                                                                    class="fa fa-twitter"></i></a></li>
                                                        <li class="tg-linkedin"><a href="javascript:void(0);"><i
                                                                    class="fa fa-linkedin"></i></a></li>
                                                        <li class="tg-googleplus"><a href="javascript:void(0);"><i
                                                                    class="fa fa-google-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="tg-description">
                                                    <p>{{ $book->description_short }}</p>
                                                    <p>{{ $book->description }}</p>
                                                </div>
                                                <div class="tg-sectionhead">
                                                    <h2>Chi tiết sách</h2>
                                                </div>
                                                <ul class="tg-productinfo">
                                                    <li><span>Bìa:</span><span>{{ $book->page }}</span></li>
                                                    <li><span>Số trang:</span><span>{{ $book->page_count }} trang</span>
                                                    </li>
                                                    </li>
                                                    <li>
                                                        <span>Publication Date:</span><span>{{ substr($book->publication_date, 0, 10) }}</span>
                                                    </li>
                                                    <li><span>Nhà xuất bản:</span><span>{{ $book->publisher }}</span>
                                                    </li>
                                                    <li><span>Ngôn ngữ:</span><span>{{ $book->language }}</span></li>
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="tg-productdescription">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="tg-sectionhead">
                                                    <h2>Mô tả sách</h2>
                                                </div>
                                                <ul class="tg-themetabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#description"
                                                                                              data-toggle="tab">Mô
                                                            tả</a>
                                                    </li>
                                                    <li role="presentation"><a href="#review"
                                                                               data-toggle="tab">Đánh giá</a></li>
                                                </ul>
                                                <div class="tg-tab-content tab-content">
                                                    <div role="tabpanel" class="tg-tab-pane tab-pane active"
                                                         id="description">
                                                        <div class="tg-description">
                                                            <p>{{ $book->description }}</p>
                                                            <figure class="tg-alignleft">
                                                                <img src="{{ asset('images/placeholdervtwo.jpg') }}"
                                                                     alt="image description">
                                                                <iframe
                                                                    src="https://www.youtube.com/embed/aLwpuDpZm1k?rel=0&amp;controls=0&amp;showinfo=0"></iframe>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tg-tab-pane tab-pane" id="review">
                                                        <div class="tg-description">
                                                            <p>Consectetur adipisicing elit, sed do eiusmod tempor
                                                                incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                                minim veni quis nostrud exercitation ullamco laboris
                                                                nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                                                dolor in reprehenden
                                                                voluptate velit esse cillum dolore eu fugiat nulla
                                                                pariatur.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tg-aboutauthor">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="tg-sectionhead">
                                                    <h2>Về tác giả</h2>
                                                </div>
                                                <div class="tg-authorbox">
                                                    <figure class="tg-authorimg">
                                                        <img src="{{ Storage::url($book->author->image) }}"
                                                             alt="image description">
                                                    </figure>
                                                    <div class="tg-authorinfo">
                                                        <div class="tg-authorhead">
                                                            <div class="tg-leftarea">
                                                                <div class="tg-authorname">
                                                                    <h2>{{ $book->author->name }}</h2>
                                                                    <span>Sinh ngày: {{ substr($book->author->birth_date, 0, 10) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="tg-rightarea">
                                                                <ul class="tg-socialicons">
                                                                    <li class="tg-facebook"><a
                                                                            href="{{ $book->author->facebook }}"><i
                                                                                class="fa fa-facebook"></i></a></li>
                                                                    <li class="tg-twitter"><a
                                                                            href="{{ $book->author->twitter}}"><i
                                                                                class="fa fa-twitter"></i></a></li>
                                                                    <li class="tg-linkedin"><a
                                                                            href="{{ $book->author->instagram }}"><i
                                                                                class="fa fa-linkedin"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="tg-description">
                                                            <p>{{ $book->author->biography }}</p>
                                                        </div>
                                                        <a class="tg-btn tg-active" href="javascript:void(0);">Xem tất
                                                            cả sách</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tg-relatedproducts">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="tg-sectionhead">
                                                    <h2><span>Sản phẩm liên quan</span>Bạn có thể thích</h2>
                                                    <a class="tg-btn" href="javascript:void(0);">Xem tất cả</a>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div id="tg-relatedproductslider"
                                                     class="tg-relatedproductslider tg-relatedbooks owl-carousel">
                                                    @foreach($booksInCategory as $book)
                                                        <div class="item">
                                                            <div class="tg-postbook">
                                                                <figure class="tg-featureimg">
                                                                    <div class="tg-bookimg">
                                                                        <div class="tg-frontcover"><img
                                                                                src="{{ Storage::url($book->image_url) }}"
                                                                                alt="image description"></div>
                                                                        <div class="tg-backcover"><img
                                                                                src="{{ Storage::url($book->image_url) }}"
                                                                                alt="image description"></div>
                                                                    </div>
                                                                    <a class="tg-btnaddtowishlist"
                                                                       href="javascript:void(0);">
                                                                        <i class="icon-heart"></i>
                                                                        <span>Thêm vào yêu thích</span>
                                                                    </a>
                                                                </figure>
                                                                <div class="tg-postbookcontent">
                                                                    <ul class="tg-bookscategories">
                                                                        @foreach($book->categories as $category)
                                                                            <li>
                                                                                <a href="javascript:void(0);">{{ $category->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <div class="tg-booktitle">
                                                                        <h3><a href="{{ route('home.book-detail',['id' => $book->id]) }}">{{ $book->title }}</a></h3>
                                                                    </div>
                                                                    <span class="tg-bookwriter">By: <a
                                                                            href="javascript:void(0);">{{ $book->author->name }}</a></span>
                                                                    <span class="tg-stars"><span></span></span>
                                                                    <span class="tg-bookprice">
																<ins>{{ number_format($book->price, 0, '.', ',') }} VNĐ</ins>
															</span>
                                                                    <a class="tg-btn tg-btnstyletwo"
                                                                       href="javascript:void(0);">
                                                                        <i class="fa fa-shopping-basket"></i>
                                                                        <em>Thêm vào giỏ</em>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
                            <aside id="tg-sidebar" class="tg-sidebar">
                                <div class="tg-widget tg-widgetsearch">
                                    <form class="tg-formtheme tg-formsearch">
                                        <div class="form-group">
                                            <button type="submit"><i class="icon-magnifier"></i></button>
                                            <input type="search" name="search" class="form-group"
                                                   placeholder="Search by title, author, key...">
                                        </div>
                                    </form>
                                </div>
                                <div class="tg-widget tg-catagories">
                                    <div class="tg-widgettitle">
                                        <h3>Danh mục</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li><a href="javascript:void(0);"><span>{{ $category->name }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--************************************
                        News Grid End
                *************************************-->
    </main>
    <!--************************************
                    Main End
            *************************************-->
@endsection
