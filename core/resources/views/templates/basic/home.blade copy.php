@extends($activeTemplate.'layouts.frontend')
@section('content')
@push('style')

@endpush
<style>
#partnerSlider .owl-item img {
    display: block;
    width: auto;
    height: 85px;
    padding: 20px 0px;
    margin: auto;
}
/* #artist .owl-item img,#collection .owl-item img{
    height:320px;
} */
</style>

<section class="slider-main">
    <div class="container-fluid p-0">
        <div class="">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $y = 0  ?>
                    @foreach($sliders as $slider)
                    <div class="carousel-item <?php echo ($y == 0) ? 'active' : ''; ?>">
                    <a href="{{ $slider->button_link }}">
                        <img class="img-fluid" src="{{ getImage(imagePath()['slider']['path'].'/'.$slider->image) }}" class="d-block w-100" alt="...">
                    </a>
                    </div>
                    <?php $y++; ?>

                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

@if($topBanner->active==1)
<section>
    <div class="container-fluid">
        <div class="row  ">
            <div class="p-0">
                <a href="{{ $topBanner->link }}">
                <img class="img-fluid" src="{{ asset('assets/images/slider/'.$topBanner->image) }}" alt="">
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<div class="clearfix"></div>
<!--Slider2-->
<section id="demos" class=" bg-grey">
    <div class="container-fluid main-box ">
        <div class="row ">
            <h1 class="heading"><span>CATEGORIES</span></h1>
            <div class="large-12 columns">
                <div id="live" class="owl-carousel owl-theme">
                    <?php foreach($categories as $cat){ ?>
                    <div class="item video-text">
                        <a href="{{route('product') }}?cat={{$cat->id}}">
                            <h2> <strong>{{ $cat->name }}</strong></h2>
                            <!-- <p>Art Block</p> -->
                            <img class="img-fluid" src="{{ asset('assets/images/category/'.$cat->image) }}">
                            <!-- <h3>花見</h3>
                            <h4>-ETH</h4>
                            <button type="button" class="btn btn-danger">Auction</button> -->
                        </a>
                    </div>
                    <?php } ?>
                    <!-- <div class="item video-text">
                        <a href="#">
                            <h2> Hanami - Very large painting</h2>
                            <p>Art Block</p>
                            <img class="img-fluid" src="{{ asset('assets/imgs/artworks02.jpg') }}">
                            <h3>花見</h3>
                            <h4>-ETH</h4>
                            <button type="button" class="btn btn-danger">Auction</button>
                        </a>

                    </div> -->
                   
                </div>
            </div>
        </div>
    </div>
</section>
<!--Slider1-->


<!--Slider2-->
<section id="demos">
    <div class="container-fluid artist-main-box ">
        <div class="row ">
            <h1 class="heading"> Trending in <span>PRODUCT</span></h1>
            <div class="large-12 columns">
                <div id="artist" class="owl-carousel   owl-theme">
                    <?php foreach($latestProduct as $latest){ ?>
                    <div class="item artist-text">
                        <a href="{{route('product.detail', $latest->id)}}">
                            <div class="caro-img">
                                <img class="img-fluid" src="{{ asset('assets/images/product/'.$latest->image) }}">
                            </div>
                            <h4>{{$latest->title}}</h4>
                        </a>
                    </div>
                    <?php } ?>
                    <!-- <div class="item artist-text">
                        <a href="#">
                            <img class="img-fluid" src="{{ asset('assets/imgs/artist2.jpg') }}">
                            <h4>ARTIST NAME</h4>
                        </a>
                    </div> -->
                    

                </div>
            </div>
        </div>
    </div>
</section>
<!--Slider2-->


<!--Slider3-->
<section id="demos" class="bg-grey">
    <div class="container-fluid  ">
        <div class="row ">
            <h1 class="heading"> RECOMMEND <span>COLLECTIONS</span></h1>
            <div class="large-12 columns">
                <div id="collection" class="owl-carousel   owl-theme">
                    <?php foreach($fetauredProduct as $feature){ ?>
                    <div class="item artist-text">
                        <a href="{{route('product.detail', $feature->id)}}">
                            <img class="img-fluid" src="{{ asset('assets/images/product/'.$feature->image) }}">
                            <h4>{{ $feature->title }}</h4>
                        </a>
                    </div>
                    <?php } ?>
                    <!-- <div class="item artist-text">
                        <a href="#">
                            <img class="img-fluid" src="{{ asset('assets/imgs/artworks04.jpg') }}">
                            <h4>Art Work</h4>
                        </a>
                    </div> -->
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--Slider3-->

<section class="nfts">
    <div class="container-fluid artist-main-box">
        <div class="">
            <h1 class="heading"><span>PARTNERS</span></h1>
        </div>
        <div class="row">
            <div class="large-12 columns" >
                <div id="partnerSlider" class="owl-carousel   owl-theme" style="background:#000;">
                    <?php foreach($partners as $partner){ ?>
                    <div class="item artist-text">
                        <a target="_blank" href="{{ $partner->link }}">
                            <img class="img-fluid" src="{{ asset('assets/images/partner/'.$partner->image) }}">
                         
                        </a>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>


@endsection
