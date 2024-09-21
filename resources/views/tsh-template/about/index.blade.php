@extends('tsh-template.layout.index')
@section('meta')
    
<title>About Us | {{App\Models\Setting::siteName()}}</title>
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
					<h2>About Us</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection