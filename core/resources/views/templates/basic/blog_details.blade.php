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
                <h4 class="title">Notice</h4>
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

            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 ">
                <h3>{{ $blog->title }}</h3>
                <h4>{{ $blog->created_at }}</h4>
                <img class="img-fluid" src="{{getImage('assets/images/blog/'. @$blog->image, '900x600')}}" alt="@lang('blog')">

                <p>@php echo $blog->description @endphp
                </p>

            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-3 ">
                <div class="light-bg notice_more-right">
                    <ul>
                        @foreach($recentBlogs as $recentBlog)
                        <li><a href="{{ route('blog.details',[$recentBlog->id,slug($recentBlog->title)]) }}"><img src="{{getImage('assets/images/blog/'. @$recentBlog->image, '900x600')}}" alt=""> {{__($recentBlog->title)}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('fbComment')
@php echo loadFbComment() @endphp
@endpush