@extends($activeTemplate.'layouts.frontend')
@section('content')
<style>
    .countdown__title {
        font-size: 20px !important;
    }
    days_text, .hours_text, .minu_text, .seco_text {
        position: relative;
        font-size: 20px;
        top: 15px;
        font-weight: 500;
    }


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

<section class="pad-5 list-main">

  <div class="container-fluid">

    <div class="row">
      <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-8 col-6  writing-b account-header1">
        <h4 class="title">Community</h4>
      </div>
      <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-6  writing-b text-right">
        <a href="{{ route('community.add') }}" class="btn btn-outline-dark me-4">Writing</a>
      </div>
    </div>
    <div class="row" style="min-height:450px">
      <div class="col-xxl-9 col-xl-9 col-lg-9 col-12  mt-3 communities-list">
        @include('templates.basic.community-list',[$communities,$totalCommunities,$loaded])
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-3 mt-3 col-lg-3 col-12 ps-4">
        <?php $products=latestProducts(); 
        foreach($products as $product){
        ?>
        <div class="light-bg row">
          <div class="  p-0" style="width:100px">
              <img width="100" src="{{ getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}" /> 
            <!--@if($product->image_type=='N')-->
            <!--<img width="100" src="{{ getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}" /> -->
            <!--@else-->
            <!--<model-viewer class="viewer" id="won" camera-controls interaction-prompt="none" src="{{ asset('assets/images/product').'/'.$product->glb_filename }}" auto-rotate exposure="1.0" shadow-intensity="1" -->
            <!--            environment-image="{{ asset('assets/images/light9.jpg') }}" ar ar-modes="webxr scene-viewer quick-look" alt="A 3D model of a sphere" background-color="#455A64" camera-orbit="1.565deg 82.83deg auto" style="padding:10px;background:#fff;margin:auto" >-->
            <!--            </model-viewer>-->
            @endif
          </div>
          <div class=" ps-3" style="width:auto;">
          <a href="{{route('product.detail', $product->id)}}" style="color:#212529"><h5 class="mt-2"><?php echo ((strlen(strip_tags($product->title)) > 30) ? mb_substr(strip_tags($product->title), 0, 25) . '...' : strip_tags($product->title)) ?></h5></a>
            <h6 class="pt-1">{{$product->start_price}} {{$product->symbol}}</h6>
          </div>
          
        </div>
        
        <br>
        <br>
        <?php } ?> 
      </div>

    </div>
  </div>

  <div class="loadmore-div text-center mt-3">
    <?php if ($totalCommunities > $loaded) { ?>
      <botton class="btn btn-light loadmore">Load More</botton>
    <?php } ?>
  </div>

  </div>
</section>

@endsection
@push('script')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
<script>
  page = 1;
  $(document).on('click', '.loadmore', function() {
    url = "{{ route('community') }}";
    page = page + 1;
    $.ajax({
      url: url,
      type: 'GET',
      datatype: 'json',
      data: {
        ajax: 'yes',
        page: page
      },
      success: function(data) {
        if (data.status == 200) {

          if (data.view != "") {
            $('.communities-list').append(data.view);
            if (data.totalCommunities == data.loaded) {
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
</script>
@endpush