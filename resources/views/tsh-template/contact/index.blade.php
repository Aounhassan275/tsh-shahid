@extends('tsh-template.layout.index')
@section('meta')
    
<title>Contact Us | {{App\Models\Setting::siteName()}}</title>
@endsection

@section('content')
<section class="hero-section">
	<div class="hero-slider owl-carousel">
	  @foreach(App\Models\Slider::where('type','Contact Us')->get() as $slider)
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
<section class="page-section spad contact-page">
  <div class="container">
    {{-- <div class="map" id="map-canvas"></div> --}}
    <div class="row">
      <div class="col-lg-4 mb-5 mb-lg-0">
        <h4 class="comment-title">Contact us</h4>
        <p>Odio ultrices ut. Etiam ac erat ut enim maximus accumsan vel ac nisl. Duis feug iat bibendum orci, non elementum urna. Cras sit amet sapien aliquam.</p>
        <div class="row">
          <div class="col-md-9">
            <ul class="contact-info-list">
              <li><div class="cf-left">Address</div><div class="cf-right">{{App\Models\Setting::address()}}</div></li>
              <li><div class="cf-left">Phone</div><div class="cf-right">{{App\Models\Setting::phone()}}</div></li>
              <li><div class="cf-left">E-mail</div><div class="cf-right">{{App\Models\Setting::email()}}</div></li>
            </ul>
          </div>
        </div>
        <div class="social-links">
          <a href="#"><i class="fa fa-pinterest"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-dribbble"></i></a>
          <a href="#"><i class="fa fa-behance"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="contact-form-warp">
          <h4 class="comment-title">Leave a Reply</h4>
          <form class="comment-form" method="POST"  action="{{route('admin.message.store')}}">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="name" required placeholder="Name">
              </div>
              <div class="col-md-6">
                <input type="email" name="email" required placeholder="Email">
              </div>
              <div class="col-lg-12">
                <input type="text" name="subject" required placeholder="Subject">
                <textarea name="message" placeholder="Message"></textarea>
                <button type="submit" class="site-btn btn-sm">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection