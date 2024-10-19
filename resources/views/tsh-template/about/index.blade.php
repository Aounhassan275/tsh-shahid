@extends('tsh-template.layout.index')
@section('meta')
    
<title>About Us | {{App\Models\Setting::siteName()}}</title>
@endsection

@section('content')
<section class="hero-section">
	<div class="hero-slider owl-carousel">
	  @foreach(App\Models\Slider::where('type','About Us')->get() as $slider)
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


@endsection