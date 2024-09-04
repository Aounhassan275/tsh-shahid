@extends('tsh-template.layout.index')
@section('meta')
    
<title>{{$brand->name}} Products | {{App\Models\Setting::siteName()}}</title>
@endsection

@section('content')
<div class="latest-news-section">
	<div class="ln-title">Latest News</div>
	<div class="news-ticker">
		<div class="news-ticker-contant">
			<div class="nt-item"><span class="new">new</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
			<div class="nt-item"><span class="strategy">strategy</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
			<div class="nt-item"><span class="racing">racing</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
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
					<h2>{{$brand->name}} Products</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="feature-section spad">
	<div class="container">
	  <div class="row">
		@foreach($products as $product)
		<div class="col-lg-3 col-md-6 p-0">
		  <div class="feature-item set-bg" data-setbg="{{asset($product->images->first()->image)}}">
			<span class="cata new">{{$product->category->name}}</span>
			<div class="fi-content text-white">
			  <h5><a href="{{route('product.show',str_replace(' ', '_',$product->name))}}">{{$product->name}}</a></h5>
			  <p>PKR {{$product->price}} </p>
			  <a href="{{route('brand.show',str_replace(' ', '_',$product->brand->name))}}" class="fi-comment">{{$product->brand->name}}</a>
			</div>
		  </div>
		</div>
		@endforeach
		{{$products->links()}}

	  </div>
	</div>
  </section>
@endsection