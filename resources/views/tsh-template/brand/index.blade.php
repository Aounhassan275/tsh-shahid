@extends('tsh-template.layout.index')
@section('meta')
    
<title>BRANDS | {{App\Models\Setting::siteName()}}</title>
@endsection

@section('content')
<!-- Hero section -->
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
  <!-- Hero section end -->
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

<section class="recent-game-section spad set-bg">
	<div class="container">
	  <div class="section-title">
		{{-- <div class="cata new">new</div> --}}
		<h2>OUR BRANDS</h2>
	  </div>
	  <div class="row">
		@foreach($brands as $brand)
		<div class="col-lg-4 col-md-6">
		  <div class="recent-game-item">
			<div class="rgi-thumb set-bg" data-setbg="{{asset($brand->image)}}">
			  <div class="cata new">{{$brand->category->name}}</div>
			</div>
			<div class="rgi-content">
			  <a href="{{route('brand.show',str_replace(' ', '_',$brand->name))}}">
				<h5>{{$brand->name}}</h5>
			  </a>
			</div>
		  </div>	
		</div>
		@endforeach
		{!! $brands->links() !!}

	  </div>
	</div>
</section>
@endsection