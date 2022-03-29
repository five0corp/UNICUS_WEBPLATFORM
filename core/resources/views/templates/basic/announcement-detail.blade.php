@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pad-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 account-header1">
                <h4 class="title">Announcement</h4>
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


<section class="pad-5 height-650">
    <div class="container-fluid">
        <div class="row notice_more">

            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-8 ">
                <h3>{{ $announcement->title }}</h3>
                <h4>{{ $announcement->created_at }}</h4>
                @if($announcement->image!="")
                <img class="img-fluid" src="{{getImage('assets/images/blog/'. @$announcement->image, '900x600')}}" alt="@lang('blog')">
                @endif
                <p>@php echo $announcement->description @endphp
                </p>

            </div>
        </div>
    </div>
</section>
@endsection
@push('fbComment')
@php echo loadFbComment() @endphp
@endpush