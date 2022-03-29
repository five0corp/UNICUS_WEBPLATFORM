@extends($activeTemplate.'layouts.frontend')
@section('content')
<style>

.list-main{
  padding: 20px 80px;
}
@media screen and (max-width: 769px) {
  .list-main{
    padding: 0px;
    /* margin-top: 140px; */
  }
  .pad-5{
      padding:0px;
  }
}

</style>
<section class="list-main">
    <div class="container-fluid">
        <div class="row  ">
           
            <div class="col-xxl-12 w-bg  my-wallet ">
              
                        <h3>{{ $page->title }}</h3>
                   
                        {!! $page->content !!}
                   
                <br />
                <br />
            </div>

        </div>
    </div>
</section>

@endsection