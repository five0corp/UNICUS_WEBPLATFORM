@extends($activeTemplate.'layouts.frontend')
@section('content')
<!-- <section>
    <div class="container-fluid">
        <div class="row notice">
            <div class="i-header ">
                <h4>NOTICE</h4>
            </div>
        </div>
    </div>
</section> -->
<style>

.list-main{
  padding: 20px 80px;
}
@media screen and (max-width: 769px) {
  .list-main{
    padding: 0px;
    margin-top: 140px;
  }
  .pad-5{
      padding:0px;
  }
}

</style>

<section class="list-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 account-header1">
                <h4 class="title">Artical</h4>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                <!-- <div class="input-group rounded mt-2 main-search">
                    <input type="search" class="form-control rounded" placeholder="Please enter search term." aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fa fa-search"></i>
                    </span>
                </div> -->
            </div>
        </div>
</section>


<section class="pad-5 pt-0">
    <div class="container-fluid mt-3 mb-5">
        <div class="row notice_more">

            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 ">
                <h3>{{ $artical->label }}</h3>
                <h4>{{ $artical->created_at }}</h4>
                @if($artical->image!="")
                <img class="img-fluid" src="{{getImage('assets/images/article/'. @$artical->image, '900x600')}}" alt="@lang('artical')">
                @endif
                <p>@php echo $artical->description @endphp
                </p>

            </div>
        </div>
    </div>
</section>
@endsection
@push('fbComment')
@php echo loadFbComment() @endphp
@endpush