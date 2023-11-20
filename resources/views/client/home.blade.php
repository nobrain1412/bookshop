@extends('layouts.client')
@section('content')

    <!--************************************
					Best Selling Start
			*************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>Lựa chọn của mọi người</span>Sách bán chạy nhất</h2>
                        <a class="tg-btn" href="javascript:void(0);">Xem tất cả</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="tg-bestsellingbooksslider"
                         class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
                        @foreach($bestSellingBooks as $book)
                            <div class="item">
                                <div class="tg-postbook">
                                    <figure class="tg-featureimg">
                                        <div class="tg-bookimg">
                                            <div class="tg-frontcover"><img src="{{ Storage::url($book->image_url) }}"
                                                                            alt="image description"></div>
                                            <div class="tg-backcover"><img src="{{ Storage::url($book->image_url) }}"
                                                                           alt="image description"></div>
                                        </div>
                                        <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                                            <i class="icon-heart"></i>
                                            <span>Thêm vào yêu thích</span>
                                        </a>
                                    </figure>
                                    <div class="tg-postbookcontent">
                                        <ul class="tg-bookscategories">
                                            @foreach($book->categories as $category)
                                                <li><a href="javascript:void(0);">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
{{--                                        <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>--}}
                                        <div class="tg-booktitle">
                                            <h3><a href="{{ route('home.book-detail',['id' => $book->id]) }}">{{ $book->title }}</a>
                                            </h3>
                                        </div>
                                        <span class="tg-bookwriter">By: <a
                                                href="javascript:void(0);">{{ $book->author->name }}</a></span>
                                        <span class="tg-stars"><span></span></span>
                                        <span class="tg-bookprice">
											<ins>{{ number_format($book->price, 0, '.', ',') }} VNĐ</ins>
{{--											<del>$27.20</del>--}}
										</span>
                                        <a class="tg-btn tg-btnstyletwo" href="{{route('cart.add',['id' => $book->id])}}">
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
    </section>
    <!--************************************
                Best Selling End
        *************************************-->

    <!--************************************
                Featured Item Start
        *************************************-->
    <section class="tg-bglight tg-haslayout">
        <div class="container">
            <div class="row">
                @if($bookFeatured != null)
                <div class="tg-featureditm">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs">
{{--                                                <figure><img src="images/img-02.png" alt="image description"></figure>--}}
                        <figure><img style="width: 300px" src="{{ Storage::url($bookFeatured->image_url) }}"
                                     alt="image description"></figure>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="tg-featureditmcontent">
                            <div class="tg-themetagbox"><span class="tg-themetag">Đặc sắc</span></div>
                            <div class="tg-booktitle">
                                <h3><a href="{{ route('home.book-detail',['id' => $bookFeatured->id]) }}">{{ $bookFeatured->title }}</a></h3>
                            </div>
                            <span class="tg-bookwriter">By: <a
                                    href="javascript:void(0);">{{ $bookFeatured->author->name }}</a></span>
                            <span class="tg-stars"><span></span></span>
                            <div class="tg-priceandbtn">
									<span class="tg-bookprice">
										<ins>{{ number_format($book->price, 0, '.', ',') }} VNĐ</ins>
									</span>
                                <a class="tg-btn tg-btnstyletwo tg-active" href="javascript:void(0);">
                                    <i class="fa fa-shopping-basket"></i>
                                    <em>Thêm vào giỏ hàng</em>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!--************************************
                Featured Item End
        *************************************-->
    <!--************************************
                New Release Start
        *************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="tg-newrelease">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="tg-sectionhead">
                            <h2><span>Nếm thử gia vị mới</span>Sách phát hành mới</h2>
                        </div>
                        <div class="tg-description">
                            <p>Khi đọc từng trang của câu chuyện, người đọc sẽ bị cuốn hút bởi lối kể chuyện tự nhiên và
                                hấp dẫn của tác giả. Hình ảnh về tuổi thơ đẹp và ngây thơ xuất hiện trước mắt, làm cho
                                người đọc cảm thấy thân thuộc và xúc động. Tác giả đã thành công trong việc tái hiện
                                tình cảm anh em, khiến mỗi người đọc cảm thấy sâu sắc về tình yêu gia đình và những kỷ
                                niệm thơ ấu đáng quý giá.</p>
                        </div>
                        <div class="tg-btns">
                            <a class="tg-btn tg-active" href="javascript:void(0);">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="tg-newreleasebooks">
                                @foreach($newestBooks as $bookNew)

                                    <div class="col-xs-4 col-sm-4 col-md-6 col-lg-4">
                                        <div class="tg-postbook">
                                            <figure class="tg-featureimg">
                                                <div class="tg-bookimg">
                                                    <div class="tg-frontcover"><img
                                                            src="{{ Storage::url($bookNew->image_url) }}"
                                                            alt="image description"></div>
                                                    <div class="tg-backcover"><img
                                                            src="{{ Storage::url($bookNew->image_url) }}"
                                                            alt="image description"></div>
                                                </div>
                                                <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                                                    <i class="icon-heart"></i>
                                                    <span>Thêm vào yêu thích</span>
                                                </a>
                                            </figure>
                                            <div class="tg-postbookcontent">
                                                <ul class="tg-bookscategories">
                                                    @foreach($bookNew->categories as $category)
                                                        <li><a href="javascript:void(0);">{{ $category->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                                <div class="tg-booktitle">
                                                    <h3><a href="{{ route('home.book-detail',['id' => $category->id]) }}">{{ $bookNew->title }}</a></h3>
                                                </div>
                                                <span class="tg-bookwriter">By: <a
                                                        href="javascript:void(0);">{{ $bookNew->author->name }}</a></span>
                                                <span class="tg-stars"><span></span></span>
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
    </section>
    <!--************************************
                New Release End
        *************************************-->
    <!--************************************
                Collection Count Start
        *************************************-->
    <section class="tg-parallax tg-bgcollectioncount tg-haslayout" data-z-index="-100" data-appear-top-offset="600"
             data-parallax="scroll" data-image-src="images/parallax/bgparallax-04.jpg">
        <div class="tg-sectionspace tg-collectioncount tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-collectioncounters" class="tg-collectioncounters">
                        <div class="tg-collectioncounter tg-drama">
                            <div class="tg-collectioncountericon">
                                <i class="icon-bubble"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Kịch</h2>
                                <h3 data-from="0" data-to="6179213" data-speed="8000" data-refresh-interval="50">
                                    6,179,213</h3>
                            </div>
                        </div>
                        <div class="tg-collectioncounter tg-horror">
                            <div class="tg-collectioncountericon">
                                <i class="icon-heart-pulse"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Kinh dị</h2>
                                <h3 data-from="0" data-to="3121242" data-speed="8000" data-refresh-interval="50">
                                    3,121,242</h3>
                            </div>
                        </div>
                        <div class="tg-collectioncounter tg-romance">
                            <div class="tg-collectioncountericon">
                                <i class="icon-heart"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Lãng mạn</h2>
                                <h3 data-from="0" data-to="2101012" data-speed="8000" data-refresh-interval="50">
                                    2,101,012</h3>
                            </div>
                        </div>
                        <div class="tg-collectioncounter tg-fashion">
                            <div class="tg-collectioncountericon">
                                <i class="icon-star"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Thời trang</h2>
                                <h3 data-from="0" data-to="1158245" data-speed="8000" data-refresh-interval="50">
                                    1,158,245</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--************************************
                Collection Count End
        *************************************-->
    <!--************************************
                Picked By Author Start
        *************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>Những cuốn sách</span>Được chọn bởi tác giả</h2>
                        <a class="tg-btn" href="javascript:void(0);">Xem tất cả</a>
                    </div>
                </div>
                <div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
                    @foreach($authorsWithBooks as $author)
                        @foreach($author->books as $book)
                            <div class="item">
                                <div class="tg-postbook">
                                    <figure class="tg-featureimg">
                                        <div class="tg-bookimg">
                                            <div class="tg-frontcover"><img src="{{ Storage::url($book->image_url) }}"
                                                                            alt="image description"></div>
                                        </div>
                                        <div class="tg-hovercontent">
                                            <div class="tg-description">
                                                <p>{{$book->description_short }}</p>
                                            </div>
                                            <strong class="tg-bookpage">Book Pages: {{ $book->page_count }}</strong>
                                            <strong
                                                class="tg-bookcategory">Category: @foreach($book->categories as $category)
                                                    <a href="javascript:void(0);">{{ $category->name }}</a> |
                                                @endforeach</strong>
                                            <strong
                                                class="tg-bookprice">Price: {{ number_format($book->price, 0, '.', ',') }}
                                                VNĐ</strong>
                                            <div class="tg-ratingbox"><span class="tg-stars"><span></span></span></div>
                                        </div>
                                    </figure>
                                    <div class="tg-postbookcontent">
                                        <div class="tg-booktitle">
                                            <h3><a href="{{ route('home.book-detail',['id' => $book->id]) }}">{{ $book->title }}</a></h3>
                                        </div>
                                        <span class="tg-bookwriter">By: <a
                                                href="javascript:void(0);">{{ $book->author->name }}</a></span>
                                        <a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
                                            <i class="fa fa-shopping-basket"></i>
                                            <em>Thêm vào giỏ</em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--************************************
                Picked By Author End
        *************************************-->
    <!--************************************
                Testimonials Start
        *************************************-->
    <section class="tg-parallax tg-bgtestimonials tg-haslayout" data-z-index="-100" data-appear-top-offset="600"
             data-parallax="scroll" data-image-src="{{ asset('images/parallax/bgparallax-05.jpg') }}">
        <div class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
                        <div id="tg-testimonialsslider" class="tg-testimonialsslider tg-testimonials owl-carousel">
                            @foreach($authors as $author)
                                <div class="item tg-testimonial">
                                    <figure><img src="{{ Storage::url($author->image) }}"
                                                 alt="image description"></figure>
                                    <blockquote><q>{{ $author->biography }}</q></blockquote>
                                    <div class="tg-testimonialauthor">
                                        <h3>{{ $author->name }}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--************************************
                Testimonials End
        *************************************-->

    <!--************************************
                Call to Action Start
        *************************************-->
    <!--************************************
                Call to Action End
        *************************************-->
    <!--************************************
                Latest News Start
        *************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>Tin tức mới nhất &amp; Bài viết</span>Tin tức hấp dẫn !</h2>
                        <a class="tg-btn" href="javascript:void(0);">Xem tất cả</a>
                    </div>
                </div>
                <div id="tg-postslider" class="tg-postslider tg-blogpost owl-carousel">
                    @foreach($posts as $post)
                        <article class="item tg-post">
                            <figure><a href="javascript:void(0);"><img src="{{ Storage::url($post->image) }}"
                                                                       alt="image description"></a>
                            </figure>
                            <div class="tg-postcontent">
                                <ul class="tg-bookscategories">
                                    @foreach($post->postTypes as $category)
                                        <li><a href="javascript:void(0);">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                                <div class="tg-themetagbox"><span class="tg-themetag">Đặc sắc</span></div>
                                <div class="tg-posttitle">
                                    <h3><a href="javascript:void(0);">{{ $post->title }}</a></h3>
                                </div>
                                <span class="tg-bookwriter">By: <a
                                        href="javascript:void(0);">{{ $post->user->name }}</a></span>
                                {{--                            <ul class="tg-postmetadata">--}}
                                {{--                                <li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a>--}}
                                {{--                                </li>--}}
                                {{--                                <li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>--}}
                                {{--                            </ul>--}}
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--************************************
                Latest News End
        *************************************-->
    </main>
@endsection
