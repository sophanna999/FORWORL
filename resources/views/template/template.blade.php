<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ForWorld</title>

  <link rel="icon" type="image/png" href="img/favicon.png')}}">
  <link href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/css/plugins/select_option1.css')}}">
  <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/plugins/flexslider.css')}}" type="text/css" media="screen" />
  <link rel="stylesheet" href="{{asset('assets/css/plugins/fullcalendar.min.css')}}">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,400italic,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/colors/default.css')}}" id="option_color">
  <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="{{asset('assets/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
  <script src="{{asset('assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
  <![endif]-->
</head>
<body>

  <div class="main_wrapper">

    <div class="header clearfix">
      <nav class="navbar navbar-main navbar-default">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="header_inner">
                <!-- Brand and toggle get grouped for better mobile display -->


                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand logo clearfix" href="{{url('/')}}">
                    <img src="{{asset('assets/img/logo-fw-01.png')}}" style="width:auto; height: 43px;" alt="" class="img-responsive" />
                  </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="navbar-collapse collapse" id="main-nav">

                  <ul class="nav navbar-nav navbar-center">


                    <!-- fa-lg fa-2x fa-3x fa-5x fa-7x fa-10x -->

                    <li><a href="{{url('/ForTree')}}"><i class="fa fa-tree fa-3x text-success"></i> 10,000 $</a></li>
                    <li>
                      <section class="input-group search-input">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-search" type="button"><i class="fa fa-search fa-lg"></i></button>
                        </span>
                      </section><!-- /input-group -->
                    </li>
                  </ul>


                  <ul class="nav navbar-nav navbar-right">

                  <li><a href="{{url('/')}}"><i class="fa fa-pencil fa-2x"></i></a></li>
                  <li><a href="{{url('/')}}"><i class="fa fa-adn fa-2x"></i></a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bars fa-2x"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{url('/Register')}}">Register</a></li>
                      <li><a href="{{url('/Login')}}">Login</a></li>
                      <li><a href="{{url('/AboutUs')}}">About Us</a></li>
                      <li><a href="{{url('/Contact')}}">Contact</a></li>
                      <li><a href="{{url('/Term')}}">Term</a></li>
                      <li><a href="{{url('/NewPost')}}">New Post</a></li>
                      <li><a href="{{url('/MyPost')}}">My Post</a></li>
                      <li><a href="{{url('/Profile')}}">Profile</a></li>
                      <li><a href="{{url('/TopUp')}}">TopUp</a></li>
                      <li><a href="{{url('/Banner')}}">Banner</a></li>
                      <li><a href="{{url('/Withdraw')}}">Withdraw</a></li>
                      <li><a href="{{url('/ForTree')}}">For Tree</a></li>
                    </ul>
                  </li>
                  </ul>
                </div><!-- navbar-collapse -->





              </div>
            </div>
          </div>
        </div><!-- /.container -->
      </nav><!-- navbar -->
    </div>
    @yield('body')

    <div class="footer clearfix">
      <div class="container">
        <div class="row clearfix">
          <div class="col-sm-6 col-xs-12 copyRight">
            <p>© 2016 Copyright Royal College Bootstrap Template by <a href="http://www.iamabdus.com">Abdus</a></p>
          </div><!-- col-sm-6 col-xs-12 -->
          <div class="col-sm-6 col-xs-12 privacy_policy">
            <a href="contact-us.html">Contact us</a>
            <a href="privacy-policy.html">Privacy Policy</a>
          </div><!-- col-sm-6 col-xs-12 -->
        </div><!-- row clearfix -->
      </div><!-- container -->
    </div><!-- footer -->

  </div>

  <!-- JQUERY SCRIPTS -->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.flexslider.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.selectbox-0.1.3.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.magnific-popup.js')}}"></script>
  <script src="{{asset('assets/js/plugins/waypoints.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.counterup.js')}}"></script>
  <script src="{{asset('assets/js/plugins/wow.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/navbar.js')}}"></script>
  <script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>
  @yield('js_bottom')
  </body>
</html>
