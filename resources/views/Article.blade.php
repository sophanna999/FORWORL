@extends('template.template')
@section('css_top')
@endsection
@section('css_bottom')
@endsection
@section('body')
    <div class="main_wrapper">
		<div class="post_section clearfix">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 post_left">
						<div class="post_left_section post_left_border">
							<div class="post">
								<div class="post_thumb">
									<img src="{{asset('assets/img/news/news-post-01.jpg')}}" alt="" />
								</div><!--end post thumb-->
								<div class="meta">
									<span class="author">By: <a href="{{url('Writer/1')}}">Alexandra Jenmi</a></span>
									<span class="category"> <a href="{{url('Category/1')}}">Indesign</a></span>
									<span class="date">Posted: <a href="{{url('PostDate/2015-24-01')}}">January 24, 2015</a></span>
								</div><!--end meta-->
								<img src="{{asset('assets/img/banner/banner.jpg')}}" width="100%" alt="" />
								<h1>Incredible standard post Image</h1>
								<div class="post_desc">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed</p>
									<h1>Welcome To COLÉGIO PRELÚDIO</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed</p>
									<h1>Welcome To COLÉGIO PRELÚDIO</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in </p>
									<div class="row">
										<div class="col-xs-12 col-sm-6">
											<div class="left_half">
												<h1>Welcome To COLÉGIO RELÚDIO</h1>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, </p>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 pull-right">
											<div class="right_half">
												<h1>Welcome To COLÉGIO RELÚDIO</h1>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, </p>
											</div>
										</div>
									</div><!--end row-->
									<h1>Welcome To COLÉGIO PRELÚDIO</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in </p>
								
								</div><!--end post desc-->
								<div class="post_bottom">
									<ul>
										<li class="like">
											<a href="#">
												<img src="{{asset('assets/img/news/like_icon.png')}}" alt="" />
												<span>12</span>
											</a>
										</li>
										<li class="share">
											<a href="#">
												<img src="{{asset('assets/img/news/share_icon.png')}}" alt="" />
												<span>12</span>
											</a>
										</li>
										<li class="favorite">
											<a href="#">
												<img src="{{asset('assets/img/news/favorite_icon.png')}}" alt="" />
												<span>12</span>
											</a>
										</li>
									</ul>
								</div><!--end post bottom-->
							</div><!--end post-->
						</div><!--end post left section-->
					</div><!--end post_left-->

					<div class="col-xs-12 col-sm-4 post_right">
						<div class="post_right_inner">

							<div class="related_post_sec">
								<div class="list_block">
									<h3>Latest News</h3>
									<ul>
									<li>
										<span class="rel_thumb">
											<img src="{{asset('assets/img/news/rel_thumb.png')}}" alt="" />
										</span><!--end rel_thumb-->
										<div class="rel_right">
											<a href="{{url('Article/1')}}"><h4>Offered in small class sizes with great emphasis...</h4></a>
											<span class="date">Posted: <a href="{{url('PostDate/2015-24-01')}}">January 24, 2015</a></span>
										</div><!--end rel right-->
									</li>
									<li>
										<span class="rel_thumb">
											<img src="{{asset('assets/img/news/rel_thumb.png')}}" alt="" />
										</span><!--end rel_thumb-->
										<div class="rel_right">
											<a href="{{url('Article/1')}}"><h4>Offered in small class sizes with great emphasis...</h4></a>
											<span class="date">Posted: <a href="{{url('PostDate/2015-24-01')}}">January 24, 2015</a></span>
										</div><!--end rel right-->
									</li>
									<li>
										<span class="rel_thumb">
											<img src="{{asset('assets/img/news/rel_thumb.png')}}" alt="" />
										</span><!--end rel_thumb-->
										<div class="rel_right">
											<a href="{{url('Article/1')}}"><h4>Offered in small class sizes with great emphasis...</h4></a>
											<span class="date">Posted: <a href="{{url('PostDate/2015-24-01')}}">January 24, 2015</a></span>
										</div><!--end rel right-->
									</li>
									<li>
										<span class="rel_thumb">
											<img src="{{asset('assets/img/news/rel_thumb.png')}}" alt="" />
										</span><!--end rel_thumb-->
										<div class="rel_right">
											<a href="{{url('Article/1')}}"><h4>Offered in small class sizes with great emphasis...</h4></a>
											<span class="date">Posted: <a href="{{url('PostDate/2015-24-01')}}">January 24, 2015</a></span>
										</div><!--end rel right-->
									</li>
									<li>
										<span class="rel_thumb">
											<img src="{{asset('assets/img/news/rel_thumb.png')}}" alt="" />
										</span><!--end rel_thumb-->
										<div class="rel_right">
											<a href="{{url('Article/1')}}"><h4>Offered in small class sizes with great emphasis...</h4></a>
											<span class="date">Posted: <a href="{{url('PostDate/2015-24-01')}}">January 24, 2015</a></span>
										</div><!--end rel right-->
									</li>
								</ul>
									<a href="#" class="more_post">More</a>
								</div>

							</div><!--end related_post_sec-->

						</div><!--end post right inner-->
					</div><!--end post_right-->

				</div>
			</div>
		</div><!--end post section-->	
    </div>
@endsection
@section('js_top')
@endsection
@section('js_bottom')
@endsection