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
                        <h1>Tác giả</h1>
                        <ol class="tg-breadcrumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="tg-active">Tác giả</li>
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
                        Authors Start
                *************************************-->
        <div class="tg-authorsgrid">
            <div class="container">
                <div class="row">
                    <div class="tg-authors">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-sectionhead">
                                <h2><span>Tâm trí mạnh mẽ đằng sau chúng ta</span>Tác giả được yêu thích nhất</h2>
                            </div>
                        </div>
                        @foreach($authors as $author)
                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="tg-author">
                                    <figure><a href="javascript:void(0);"><img class="img-circle"
                                                                               src="{{ Storage::url($author->image) }}"
                                                                               alt="image description"></a></figure>
                                    <div class="tg-authorcontent">
                                        <h2><a href="javascript:void(0);">{{ $author->name }}</a></h2>
                                        <span>{{ $author->books()->count() }} sách đã xuất bản</span>
                                        <ul class="tg-socialicons">
                                            <li class="tg-facebook"><a href="{{ $author->facebook }}"><i
                                                        class="fa fa-facebook"></i></a></li>
                                            <li class="tg-twitter"><a href="{{ $author->twitter }}"><i
                                                        class="fa fa-twitter"></i></a></li>
                                            <li class="tg-linkedin"><a href="{{ $author->instagram }}"><i
                                                        class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--************************************
                        Authors End
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
                        Picked By Author Start
                *************************************-->
        <section class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="tg-sectionhead">
                            <h2><span>Một số cuốn sách hay</span>Được chọn bởi tác giả</h2>
                            <a class="tg-btn" href="javascript:void(0);">View All</a>
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
                                            <strong class="tg-bookcategory">Category:   @foreach($book->categories as $category)
                                                    <a href="javascript:void(0);">{{ $category->name }}</a> |
                                                @endforeach</strong>
                                            <strong class="tg-bookprice">Price: {{ number_format($book->price, 0, '.', ',') }} VNĐ</strong>
                                            <div class="tg-ratingbox"><span class="tg-stars"><span></span></span></div>
                                        </div>
                                    </figure>
                                    <div class="tg-postbookcontent">
                                        <div class="tg-booktitle">
                                            <h3><a href="javascript:void(0);">{{ $book->title }}</a></h3>
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
    </main>
    <!--************************************
                    Main End
            *************************************-->
@endsection
