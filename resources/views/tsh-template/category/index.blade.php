@extends('tsh-template.layout.index')
@section('meta')
<title>CATEGORIES | {{App\Models\Setting::siteName()}}</title>
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
					<h2>Categories</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="review-section spad set-bg" data-setbg="{{asset('tsh-template/img/review-bg.png')}}">
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