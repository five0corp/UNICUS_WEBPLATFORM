@extends($activeTemplate.'layouts.frontend')
@section('content')
<style>
  .nav-tabs{
    border: none;
  }
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #495057 !important;
    background-color: #fff;
    border: 1px solid transparent;
    font-weight: bold;
    font-size: 24px;
}
.nav-tabs .nav-link{
  font-weight: bold;
    font-size: 24px;
    color: #adacac;
    transition:none;
    padding:revert;
}
#myTab li {
  /* display: inline-block; */
  /* width: 40px; */
  display: contents;
}
button{
  outline: none !important;
}
#myTab li + li:before {
    content: " | ";
    padding: 13px 0px;
    font-weight: bolder;
}
.nav-tabs .nav-link:hover,.nav-tabs .nav-link:focus,.nav-tabs .nav-link:visited{
  border-color: transparent !important;
}
.list-main{
  padding: 45px 80px;
}
/* @media screen and (max-width: 769px) {
  .list-main{
    padding: 0px;
    margin-top: 100px;
  }
} */
</style>


<section class="list-main">

  <div class="container-fluid">
    <div class="col-12">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="ps-0 nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Notice</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Announcement</button>
        </li>
      </ul>

    </div>

    <div class="tab-content" id="myTabContent" style="min-height:450px">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <!-- <div class="row">
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mt-3 account-header1">
            <h4 class="title">Notice</h4>
          </div>
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
          </div>
        </div> -->
        <div class="row blog-list">
          @include('templates.basic.blog-list',[$blogs,$totalBlogs,$loaded])
        </div>

        <div class="loadmore-div text-center mt-3">
          <?php if ($totalBlogs > $loaded) { ?>
            <botton class="btn btn-light loadmore">Load More</botton>
          <?php } ?>
        </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <!-- <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 writing-b my-4 account-header1">
          <h4 class="title">Announcement</h4>
        </div> -->
        <div class="announcement-list">
        @include('templates.basic.announcement-list',[$announcements,$totalAnn,$loadedAnn])
         
        </div>
        <div class="loadmore-ann-div text-center mt-3">
          <?php if ($totalAnn > $loadedAnn) { ?>
            <botton class="btn btn-light loadmore-ann">Load More</botton>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('script')
<script>
  page = 1;
  pageAnn=1;
  $(document).on('click', '.loadmore', function() {
    url = "{{ route('blog') }}";
    page = page + 1;
    $.ajax({
      url: url,
      type: 'GET',
      datatype: 'json',
      data: {
        ajax: 'yes',
        page: page,
        type : 'B'
      },
      success: function(data) {
        if (data.status == 200) {

          if (data.view != "") {
            $('.blog-list').append(data.view);
            if (data.totalBlogs == data.loaded) {
              $('.loadmore').hide();
            }
          } else {
            $('.loadmore').hide();
            //$('.product-list').html("<h4 class='text-center mt-4'> No record found.</h4>");
          }

        }
      },
      error: function(data) {

      }
    });
  });

  $(document).on('click', '.loadmore-ann', function() {
    url = "{{ route('blog') }}";
    pageAnn = pageAnn + 1;
    $.ajax({
      url: url,
      type: 'GET',
      datatype: 'json',
      data: {
        ajax: 'yes',
        page: pageAnn,
        type: 'A'
      },
      success: function(data) {
        if (data.status == 200) {

          if (data.view != "") {
            $('.announcement-list').append(data.view);
            if (data.totalBlogs == data.loadedAnn) {
              $('.loadmore-ann').hide();
            }
          } else {
            $('.loadmore-ann').hide();
            //$('.product-list').html("<h4 class='text-center mt-4'> No record found.</h4>");
          }

        }
      },
      error: function(data) {

      }
    });
  });

</script>
@endpush