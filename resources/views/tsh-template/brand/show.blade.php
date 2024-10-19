@extends('tsh-template.layout.index')
@section('meta')
    
<title>{{$brand->name}} Products | {{App\Models\Setting::siteName()}}</title>
@endsection

@section('content')
<section class="hero-section">
	<div class="hero-slider owl-carousel">
	  @foreach(App\Models\Slider::where('type','Brand')->get() as $slider)
	  <div class="hs-item set-bg" data-setbg="{{asset($slider->image)}}">
		<div class="hs-text">
		  <div class="container">
			<h2>{{$slider->title}}</h2>
			<p>{{ Illuminate\Support\Str::limit(@$slider->description, 60)}}</p>
		  </div>
		</div>
	  </div>
	  @endforeach
	</div>
</section>
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