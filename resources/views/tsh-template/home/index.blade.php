@extends('tsh-template.layout.index')
@section('meta')
    
<title>HOME | {{App\Models\Setting::siteName()}}</title>
@endsection

@section('content')

<!-- Hero section -->
<section class="hero-section">
  <div class="hero-slider owl-carousel">
    @foreach(App\Models\Slider::all() as $slider)
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


<!-- Latest news section -->
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


<!-- Feature section -->

<section class="review-section spad ">
  <div class="container">
    <div class="section-title">
      <div class="cata new">new</div>
      <h2>OUR PRODUCTS</h2>
    </div>
    <div class="row">
      @foreach(App\Models\Product::orderBy('created_at','desc')->get()->take(9) as $product)
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
    </div>
  </div>
</section>
<!-- Feature section end -->


<!-- Recent game section  -->
<section class="recent-game-section spad">
  <div class="container">
    <div class="section-title">
      <div class="cata new">new</div>
      <h2>OUR BRANDS</h2>
    </div>
    <div class="row">
      @foreach(App\Models\Brand::orderBy('created_at','desc')->get()->take(9) as $brand)
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
<!-- Recent game section end -->


{{-- <!-- Tournaments section -->
<section class="tournaments-section spad">
  <div class="container">
    <div class="tournament-title">Tournaments</div>
    <div class="row">
      <div class="col-md-6">
        <div class="tournament-item mb-4 mb-lg-0">
          <div class="ti-notic">Premium Tournament</div>
          <div class="ti-content">
            <div class="ti-thumb set-bg" data-setbg="{{asset('tsh-template/img/tournament/1.jpg')}}"></div>
            <div class="ti-text">
              <h4>World Of WarCraft</h4>
              <ul>
                <li><span>Tournament Beggins:</span> June 20, 2018</li>
                <li><span>Tounament Ends:</span> July 01, 2018</li>
                <li><span>Participants:</span> 10 teams</li>
                <li><span>Tournament Author:</span> Admin</li>
              </ul>
              <p><span>Prizes:</span> 1st place $2000, 2nd place: $1000, 3rd place: $500</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tournament-item">
          <div class="ti-notic">Premium Tournament</div>
          <div class="ti-content">
            <div class="ti-thumb set-bg" data-setbg="{{asset('tsh-template/img/tournament/2.jpg')}}"></div>
            <div class="ti-text">
              <h4>DOOM</h4>
              <ul>
                <li><span>Tournament Beggins:</span> June 20, 2018</li>
                <li><span>Tounament Ends:</span> July 01, 2018</li>
                <li><span>Participants:</span> 10 teams</li>
                <li><span>Tournament Author:</span> Admin</li>
              </ul>
              <p><span>Prizes:</span> 1st place $2000, 2nd place: $1000, 3rd place: $500</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}
<!-- Tournaments section bg -->
	<!-- Review section -->
	<section class="review-section spad " >
		<div class="container">
			<div class="section-title">
				<div class="cata new">new</div>
				<h2>OUR CATEGORIES</h2>
			</div>
			<div class="row">
        @foreach(App\Models\Category::orderBy('created_at','desc')->get()->take(9) as $category)
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
			</div>
		</div>
	</section>
	<!-- Review section end -->

@endsection