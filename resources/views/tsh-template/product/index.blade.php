@extends('tsh-template.layout.index')
@section('meta')
    
<title>Products | {{App\Models\Setting::siteName()}}</title>
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
					<h2>Products</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="review-section spad ">
	<div class="container">
	  <div class="row">
		@foreach($products as $product)
		<div class="col-lg-3 col-md-6">
		  <div class="review-item">
			<div class="review-cover set-bg" data-setbg="{{asset($product->images->first()->image)}}">
			  <div class="score yellow">{{$product->discountPercentage()}}</div>
			</div>
			<div class="review-text">
			  <h5><a href="{{route('product.show',str_replace(' ', '_',$product->name))}}">{{$product->name}}</a></h5>
			  <h5>PKR {{$product->price}}</h5> 
			  <p><del>PKR {{$product->fake_price}}</del></p>
			</div>
		  </div>
		</div>
		@endforeach
		{{$products->links()}}
	  </div>
	</div>
  </section>
@endsection