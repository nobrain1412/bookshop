@extends('layouts.client')
@section('content')
		<!--************************************
				Inner Banner Start
		*************************************-->
		<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-innerbannercontent">
							<h1>404 Error</h1>
							<ol class="tg-breadcrumb">
								<li><a href="javascript:void(0);">home</a></li>
								<li class="tg-active">404 Error</li>
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
					404 Error Start
			*************************************-->
			<div class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="tg-404error">
							<div class="col-xs-12 col-sm-12 col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
								<div class="tg-404errorcontent">
									<h2>Ooops! Could Not Find It</h2>
									<span>404</span>
								</div>
								<form class="tg-formtheme tg-formsearch">
									<fieldset>
										<input type="text" name="search" class="typeahead form-control" placeholder="Search Here">
										<button type="submit"><i class="icon-magnifier"></i></button>
									</fieldset>
									<div class="tg-gobackhome">
										<span>Or Goto</span>
										<a href="javascript:void(0);">Homepage</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--************************************
					404 Error End
			*************************************-->
		</main>
		<!--************************************
				Main End
		*************************************-->
		

 
@endsection