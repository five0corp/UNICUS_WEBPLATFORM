@extends($activeTemplate . 'layouts.frontend')
@section('content')
<style>
  .list-main {
    padding: 20px 80px;
    margin-top: 15px;
  }

  /*.list-prod img{*/
  /*    height:182px;*/
  /*}*/
  /*@media screen and (max-width: 1550px) {*/
  /*    .list-prod img{*/
  /*        height:175px;*/
  /*    }*/
  /*}*/
  /*@media screen and (max-width: 1500px) {*/
  /*    .list-prod img{*/
  /*        height:165px;*/
  /*    }*/
  /*}*/
  /*@media screen and (max-width: 1450px) {*/
  /*    .list-prod img{*/
  /*        height:150px;*/
  /*    }*/
  /*}*/
  /*@media screen and (max-width: 1400px) {*/
  /*     .list-prod img{*/
  /*        height:auto;*/
  /*    }*/
  /*}*/

  @media screen and (max-width: 769px) {
    .list-main {
      padding: 0px;
      margin-top: 90px;
    }

  }
</style>
<section class="list-main">
  <div class="container-fluid">
    <div class="row  ">
      <div class="col-xxl-2 list-left-main p-0">
        <div class="left-side">
          <h3><i class="fa fa-star" aria-hidden="true"></i> CATEGORY</h3>
          <ul>
            <li><a href="{{route('product') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> ALL</a></li>
            <?php foreach ($categories as $cat) { ?>
              <li><a href="{{route('product') }}?cat={{$cat->id}}" class="<?php echo ($cat_id == $cat->id) ? 'active' : ''; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $cat->name  }}</a></li>
            <?php } ?>
          </ul>


        </div>


        <div class="list-left-tabs">

          <div class="accordion" id="accordionExample">

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button <?php echo ($collection_id > 0) ? '' : 'collapsed'; ?>  left-tabs" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Collection
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse <?php echo ($collection_id > 0) ? 'show' : ''; ?> collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body  left-side">
                  <!-- <div class="text-right">
                      <button class="btn btn-dark apply-btn">Apply</button>
                    </div> -->
                  <ul class="">
                    <?php foreach ($collections as $coll) { ?>
                      <li>
                      <li><a href="{{route('product') }}?collection={{$coll->id}}" class="<?php echo ($collection_id == $coll->id) ? 'active' : ''; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $coll->name  }}</a></li>


                      <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault"> {{ $coll->name }} </label> -->
                      </li>
                    <?php } ?>

                  </ul>
                </div>
              </div>
            </div>

          </div>


        </div>
      </div>
      <div class="col-xxl-10 w-bg  p-4">
        <div class="row product-list">
          @if($products->count()>0)
          @include('templates.basic.product-list',[$products,$totalProducts,$loaded])

          
          @else
          <div class="col-12 mt-5">
            No Record ...
          </div>
          @endif
        </div>
        <div class="loadmore-div text-center mt-3">
            <?php if ($totalProducts > $loaded) { ?>
              <botton class="btn btn-light loadmore">Load More</botton>
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
  $(document).on('keyup', '.search-product', function() {
    url = "{{ route('product') }}";
    search = $(this).val();
    $.ajax({
      url: url,
      type: 'GET',
      datatype: 'json',
      data: {
        ajax: 'yes',
        search: search
      },
      success: function(data) {
        if (data.status == 200) {
          if (data.view != "") {
            $('.product-list').html(data.view);
            if (data.totalProducts == data.loaded) {
              $('.loadmore').hide();
            } else {
              $('.loadmore').show();
            }
          } else {
            $('.product-list').html("<h4 class='text-center mt-4'>No record found.</h4>");
          }

        }
      },
      error: function(data) {

      }
    });
  });
  var thats;
  $(document).on('click', '.loadmore', function() {
    url = "{{ route('product') }}";
    page = page + 1;
    $.ajax({
      url: url,
      type: 'GET',
    //   datatype: 'json',
    //   cache: false,
    //   contentType: "application/json",
      data: {
        ajax: 'yes',
        page: page
      },
      success: function(data) {
        if (data.status == 200) {

          if (data.view != "") {
            $('.product-list').append(data.view);
            if (data.totalProducts == data.loaded) {
              $('.loadmore').hide();
              // getCounter()

            //   var cur;
            //   var kakku;
            //   var count = 0;

            //   $('.staffCountdown').each(function() {
            //     var finalDate = $(this).data('count_down');
            //     // alert(finalDate);
            //     that = this;
            //     $(that).countdown({
            //       date: finalDate,
            //       offset: +6,
            //       day: 'd',
            //       days: 'd',
            //       hours: 'h',
            //       hour: 'h'
            //     });
            //   });
            }
          } else {
            $('.loadmore').hide();

          }

        }
      },
      error: function(data) {

      }
    });
  });
</script>
@endpush