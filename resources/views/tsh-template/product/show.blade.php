@extends('tsh-template.layout.index')
@section('meta')
    
<title>{{$product->name}} | {{App\Models\Setting::siteName()}}</title>
<meta name="description" content="{!! $product->description !!}">

<meta property="og:locale" content="en_GB" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{!! $product->name !!} | {{@$product->category->name}} | {{@$product->brand->name}} | {{@$product->city->name}}" />
<meta property="og:description" content="{!! $product->description !!}" />
<meta property="og:url" content="{{Request::url()}}" />
<meta property="og:site_name" content="expertsalezone.com" />
<meta property="article:publisher" content="{{url(App\Models\Setting::facebook())}}" />
<meta property="og:image" content="{{asset($product->images->first()->image)}}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{!! $product->name !!} | {{@$product->category->name}} | {{@$product->brand->name}} | {{@$product->city->name}}" />
<meta name="twitter:description" content="{!! $product->description !!}" />
<meta name="twitter:image" content="{{asset($product->images->first()->image)}}" />
@endsection

@section('content')
<div class="latest-news-section">
	<div class="ln-title">Latest News</div>
	<div class="news-ticker">
		<div class="news-ticker-contant">
			@foreach (App\Models\FrontTicker::all() as $key => $ticker)
			<div class="nt-item"><span class="new">{{$ticker->title}}</span>{{$ticker->message}} </div>
			@endforeach
		</div>
	</div>
</div>
<!-- Latest news section end -->


<!-- Page info section -->
<section class="page-info-section set-bg" data-setbg="{{asset('tsh-template/img/page-top-bg/1.jpg')}}">
	<div class="pi-content">
		<div class="container">
			<div class="row">
				<div class="col-xl-5 col-lg-6 text-white">
					<h2>{{$product->name}}</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page-section single-blog-page spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="blog-thumb set-bg" data-setbg="{{asset($product->images->first()->image)}}">
					<div class="cata new">new</div>
				</div>
				<div class="blog-content">
					<h3>{{$product->name}} - {{$product->category->name}} ({{$product->brand->name}})</h3>
					{{-- <p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit amet, consectetur elit. Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit amet, consectetur elit.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pellentesque id nibh ac congue. Nullam dignissim egestas velit eget tempor. Morbi nec dolor neque. Maecenas quis tincidunt turpis. Cras ultricies pulvinar odio, sit amet lobortis lorem consectetur at. Vivamus risus erat, eleifend a nunc non, lacinia ultrices ante. Suspendisse a lacus at metus convallis maximus. Vivamus fringilla ipsum dolor. Cras pellentesque turpis id lacus condimentum condimentum. Sed tincidunt velit et urna eleifend imperdiet. Quisque euismod nibh at urna pellentesque, sit amet bibendum nibh fringilla. Sed dignissim varius blandit.</p> --}}
					{{-- <p>Donec venenatis at eros sit amet aliquam. Donec vel orci efficitur, dictum nisl vitae, scelerisque nibh. Curabitur eget ipsum pulvinar nunc gravida interdum. Aenean lectus felis, rutrum non quam eu, accumsan semper ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut accumsan, mauris nec venenatis gravida, lacus est gravida augue, eu egestas lorem nisi nec nibh. Mauris luctus porttitor elit, ac efficitur nulla consectetur a. Pellentesque scelerisque pulvinar magna sit amet auctor. Fusce tincidunt convallis elit ante, nec ullamcorper ante rhoncus mollis. </p> --}}
				</div>
			</div>
			<!-- sidebar -->
			<div class="col-lg-4 col-md-7 sidebar pt-5 pt-lg-0">
				<!-- widget -->
				<div class="widget-item">
					<h3>PKR @if($product->fake_price > 0)<del>{{$product->fake_price}} /</del> @endif{{$product->price}}</h3>
					<a href="{{route('user.product.order',$product->id)}}" class="btn btn-primary btn-shadow d-block w-100">
						<i class="ci-cart fs-lg me-2"></i>Add to Cart
					</a>
					<p><strong>Product Description :</strong></p>

					<p>{{$product->description}}</p>
					<p><strong>Share :</strong></p>
					
					<div class="social-links">
						<a href="https://wa.me/?text=={{Request::url()}}&via=expertsalezone.com"><i class="fa fa-whatsapp"></i></a>
						<a href="https://www.facebook.com/sharer.php?u={{Request::url()}}"><i class="fa fa-facebook"></i></a>
						<a href="https://twitter.com/intent/tweet?text={{$product->name}}&url={{Request::url()}}"><i class="fa fa-twitter"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			@foreach($product->images as $productImage)
			<div class="col-lg-3 md-2">
				<img src="{{asset($productImage->image)}}" alt="">
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection