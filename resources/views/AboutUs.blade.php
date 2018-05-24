@extends('template.template')
@section('css_top')
@endsection
@section('css_bottom')
@endsection
@section('body')
		<div class="content_top clearfix">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="content_left features">
							<h1>About Us</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>
							
							<p>nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id</p>
							<ul>
								<li><i class="fa fa-check-circle-o"></i>It’s a complete solution for your college website</li>
								<li><i class="fa fa-check-circle-o"></i>PSD file included to help you customize the design better</li>
								<li><i class="fa fa-check-circle-o"></i>SASS file included for unlimited hasel free style customization</li>
								<li><i class="fa fa-check-circle-o"></i>Theme option switcher for live cusomization preview</li>
								<li><i class="fa fa-check-circle-o"></i>24/7 Support</li>
							</ul>
						</div><!--end content left-->
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="content_right">
							<div class="banner" id="about_banner">
								<ul class="slides">
									<li>
										<img src="{{asset('assets/img/about/about-slide-01.jpg')}}" alt="" />
										<div class="about_caption">
											<h2> Dedicated support stuffs for students</h2>
										</div><!--end banner_caption-->
									</li>
									
									<li style="display:none;">
										<img src="{{asset('assets/img/about/about-slide-02.jpg')}}" alt="" />
										<div class="about_caption">
											<h2>Nice classrooms with wifi</h2>
										</div><!--end banner_caption-->
									</li>
									
									<li style="display:none;">
										<img src="{{asset('assets/img/about/about-slide-03.jpg')}}" alt="" />
										<div class="about_caption">
											<h2>Rich library - open 24/7</h2>
										</div><!--end banner_caption-->
									</li>
								</ul>
							</div><!--end banner-->
						</div><!--end content left-->
					</div>
				</div><!--end row-->
			</div><!--end container-->
		</div><!--end content top-->

@endsection
@section('js_top')
@endsection
@section('js_bottom')
@endsection