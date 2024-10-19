@extends('tsh-template.layout.index')
@section('meta')
<title>CATEGORIES | {{App\Models\Setting::siteName()}}</title>
@endsection
@section('content')
<section class="hero-section">
	<div class="hero-slider owl-carousel">
	  @foreach(App\Models\Slider::where('type','Category')->get() as $slider)
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


<section class="review-section spad set-bg" >
	<div class="container">
		<div class="section-title">
			{{-- <div class="cata new">new</div> --}}
			<h2>OUR CATEGORIES</h2>
		</div>
		<div class="row">
			@foreach($categories as $category)
					<div class="col-lg-3 col-md-6">
						<div class="review-item">
							<div class="review-cover set-bg" data-setbg="{{asset($category->image)}}">
								{{-- <div class="score yellow">{{$category->brands->count()}}</div> --}}
							</div>
							<div class="review-text">
				<a href="{{route('category.show',str_replace(' ', '_',$category->name))}}">
					<h5>{{$category->name}}</h5>
				</a>
								<p>{{$category->products->count()}} Products</p>
							</div>
						</div>
					</div>
			@endforeach
			{!! $categories->links() !!}

		</div>
	</div>
</section>

@endsection