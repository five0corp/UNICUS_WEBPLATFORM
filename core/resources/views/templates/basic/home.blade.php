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
<section class="container-fluid dark-bg category-div px-0">

        <div class="row ">
            <div class="">
                <img src="{{ asset('assets/images/logoIcon/fv.png') }}" width="20px" />
                <h1 class="heading"><span>CATEGORIES</span></h1>
            </div>

            <div class="large-12 columns">
                <div id="live" class="owl-carousel owl-theme">
                    <?php foreach ($categories as $cat) { ?>
                        <div class="item cat-title">
                            <a href="{{route('product') }}?cat={{$cat->id}}">
                                <h2>{{ $cat->name }}</h2>
                                <img class="img-fluid" src="{{ asset('assets/images/category/'.$cat->image) }}">
                           
                            </a>
                        </div>
                    <?php } ?>
                 
                </div>
            </div>
        </div>
</section>
<!--Slider1-->

<Section>
    <div class="container-fluid dark-bg px-3">
        <div class="row">
            <div class="col-12 contract-area">
                <div class="under-contract">
                    <hr class="contract-hr" />

                    <h3 class="mt-4"><b>Unicus Contract</b></h3>

                    <div class="col-12 text-center">
                        <input class="form-control contact-input " id="contract-address" value="{{ config('app.token_smart_contract_address')}}" disabled>

                        <div class="tooltip1">
                            <button class="btn copy-btn" onclick="copyText()" onmouseout="outFunc()">
                                <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                Copy
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</Section>

<!--Slider2-->
<section>

    <div class="container-fluid dark-bg ">
        <div class="padding-50"></div>
        <div class="row ">
            <div class="col-12">
                <img src="{{ asset('assets/images/logoIcon/fv.png') }}" width="20px" />
                <h1 class="heading">TRENDING IN <span>PRODUCT</span></h1>
            </div>

            <div class="col-12 columns">
                <div id="artist" class="owl-carousel   owl-theme">
                    <?php foreach ($latestProduct as $latest) { ?>
                        <div class="item product-text">
                            <a href="{{route('product.detail', $latest->id)}}">
                                <div class="caro-img p-3 pb-5">
                                    <img class="img-fluid" src="{{ asset('assets/images/product/'.$latest->image) }}">
                                </div>
                                <!-- <h4>{{$latest->title}}</h4> -->
                                <div class="card-detail px-3">
                                    <div class="user-detail">
                                    <?php if(isset($latest->collection->image)){
                                        $img=getImage(imagePath()['collection']['path'].'/'.$latest->collection->image);
                                    }else{
                                        $img=asset('assets/images/default-user1.png');
                                    } ?>
                                        <img class="user-img" src="{{ $img }}" width="40px" />
                                        @if($latest->collection)
                                        <p class="p-title">{{ $latest->collection->name}}</p>
                                        @endif
                                    </div>
                                    <div class="prod-detail">
                                        <h3>{{ str_limit($latest->title,20) }}</h3>
                                        <p>{{ str_limit($latest->sub_title,37) }}</p>
                                       
                                        <div class="text-right"><img src="{{ asset('assets/images/logoIcon/fv.png') }}" class="icon-img" /><span> {{$latest->start_price.' '.$latest->symbol }}</span></div>
                                    </div>
                                </div>
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

            <div class="col-12">
                <hr class="home-hr" />
            </div>
        </div>
    </div>
</section>
<!--Slider2-->


<!--Slider3-->
<section>
    <div class="container-fluid dark-bg ">
        <div class="padding-50"></div>
        <div class="row ">
            <div class="col-12">
                <img src="{{ asset('assets/images/logoIcon/fv.png') }}" width="20px" />
                <h1 class="heading"> RECOMMEND <span>COLLECTIONS</span></h1>
            </div>

            <div class="col-12 columns">
                <div id="collection" class="owl-carousel   owl-theme">
                    <?php foreach ($fetauredProduct as $feature) { ?>
                        <div class="item product-text">
                            <a href="{{route('product.detail', $feature->id)}}">
                                <div class="caro-img p-3 pb-5">
                                    <img class="img-fluid" src="{{ asset('assets/images/product/'.$feature->image) }}">
                                </div>
                                <div class="card-detail px-3">
                                    <div class="user-detail">
                                    <?php if(isset($feature->collection->image)){
                                        $img=getImage(imagePath()['collection']['path'].'/'.$feature->collection->image);
                                    }else{
                                        $img=asset('assets/images/default-user1.png');
                                    } ?>
                                        <img class="user-img" src="{{ $img }}" width="40px" />
                                        @if($feature->collection)
                                        <p class="p-title">{{ $feature->collection->name}}</p>
                                        @endif
                                    </div>
                                    <div class="prod-detail">
                                        <h3>{{ str_limit($feature->title,20) }}</h3>
                                        <p>{{ str_limit($feature->sub_title,37) }}</p>
                                      
                                        <div class="text-right"><img src="{{ asset('assets/images/logoIcon/fv.png') }}" class="icon-img" /><span>{{$feature->start_price.' '.$feature->symbol }}</span></div>
                                    </div>
                                </div>
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

<section>
    <div class="container-fluid">
        <div class="row orange-bg">
            <div class="col-12 ">
                <h2 class="pt-5"><strong>Contact Us</strong></h2>
                <h3 class="pb-4">contact@art-unic.com</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid dark-bg ">
        <div class="row ">
        <div class="padding-50"></div>
            <div class="col-12">
                <img src="{{ asset('assets/images/logoIcon/fv.png') }}" width="20px" />
                <h1 class="heading"><span>Notice | Announcement</span></h1>
            </div>
            <div class="col-12">
                <div class="row home-notice">
                    @foreach($blogs as $blog)
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-12 mt-3">
                        <div class="notice-main">
                            <a href="{{ route('blog.details',[$blog->id,slug($blog->title)]) }}">
                                <div class="artwoks-photo">
                                    <img class="img-fluid" src="{{getImage('assets/images/blog/'. @$blog->image, '900x600')}}" alt="@lang('blog')">
                                </div>
                                <h4> {{__($blog->title)}} </h4>
                                <h6>{{showDateTime($blog->created_at, 'd M Y')}}</h6>
                                <!-- <p> <?php //echo $blog->data_values->description; 
                                            ?></p> -->
                                <p><?php echo ((strlen(strip_tags($blog->description)) > 195) ? mb_substr(strip_tags($blog->description), 0, 195) . '...' : strip_tags($blog->description)) ?></p>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container-fluid dark-bg ">
        <div class="row ">
            <div class="col-12">
                <img src="{{ asset('assets/images/logoIcon/fv.png') }}" width="20px" />
                <h1 class="heading"><span>PARTNERS</span></h1>
            </div>
            <div class="col-12">
                <div class="row">
                    <div id="partnerSlider" class="owl-carousel   owl-theme" style="width:75%;margin:auto">
                        <?php foreach ($partners as $partner) { ?>
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
    </div>
</section>



@endsection