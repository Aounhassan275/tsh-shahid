@extends('tsh-template.layout.index')
@section('meta')
    
<title>{{$category->name}} Brands | {{App\Models\Setting::siteName()}}</title>
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
					<h2>{{$category->name}} Brands</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="recent-game-section spad set-bg" data-setbg="{{asset('tsh-template/img/recent-game-bg.png')}}">
	<div class="container">
	  <div class="section-title">
		{{-- <div class="cata new">new</div> --}}
		<h2>OUR BRANDS</h2>
	  </div>
	  <div class="row">
		@foreach($category->brands as $brand)
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
	  </div>
	</div>
</section>
@endsection