<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
  @yield('meta')
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="{{asset('tsh-template/img/favicon.ico')}}" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('tsh-template/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('tsh-template/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('tsh-template/css/owl.carousel.css')}}"/>
	<link rel="stylesheet" href="{{asset('tsh-template/css/style.css')}}"/>
	<link rel="stylesheet" href="{{asset('tsh-template/css/animate.css')}}"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	@toastr_css
    @yield('css')
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="container">
			<!-- logo -->
			<a class="site-logo" href="{{url('')}}">
				<img src="{{asset('tsh-template/tsh.png')}}" style="width:165px;" alt="">
			</a>
			<div class="user-panel">
				<a href="{{url('user/login')}}">Login</a>  /  <a href="{{url('user/register',App\Models\User::find(1)->refferral_link)}}">Register</a>
			</div>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- site menu -->
			<nav class="main-menu">
				<ul>
					<li class="{{Request::is('categories')?'active':''}}"><a href="{{url('categories')}}">Categories</a></li>
					<li class="{{Request::is('brands')?'active':''}}"><a href="{{url('brands')}}">Brands</a></li>
					<li class="{{Request::is('products')?'active':''}}"><a href="{{url('products')}}">Products</a></li>
					<li class="{{Request::is('contact_us')?'active':''}}"><a href="{{url('contact_us')}}">Contact</a></li>
					<li class="{{Request::is('about_us')?'active':''}}"><a href="{{url('about_us')}}">About Us</a></li>
					<li class="login-link" style="display:none;"><a href="{{url('user/login')}}">Login</a></li>
					<li class="login-link" style="display:none;"><a href="{{url('user/register',App\Models\User::find(1)->refferral_link)}}">Register</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<!-- Header section end -->
  @yield('content')




	
	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<ul class="footer-menu">
				<li class="{{Request::is('/')?'active':''}}"><a href="{{url('/')}}">Home</a></li>
				<li class="{{Request::is('categories')?'active':''}}"><a href="{{url('categories')}}">Categories</a></li>
				<li class="{{Request::is('brands')?'active':''}}"><a href="{{url('brands')}}">Brands</a></li>
				<li class="{{Request::is('products')?'active':''}}"><a href="{{url('products')}}">Products</a></li>
				<li class="{{Request::is('contact_us')?'active':''}}"><a href="{{url('contact_us')}}">Contact Us</a></li>
				<li class="{{Request::is('about_us')?'active':''}}"><a href="{{url('about_us')}}">About Us</a></li>
			</ul>
			<p class="copyright">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | {{App\Models\Setting::siteName()}}
</p>
		</div>
	</footer>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('tsh-template/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('tsh-template/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('tsh-template/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('tsh-template/js/jquery.marquee.min.js')}}"></script>
	<script src="{{asset('tsh-template/js/main.js')}}"></script>
	@toastr_js
	@toastr_render
    </body>
</html>