@extends($activeTemplate.'layouts.frontend')
@section('content')
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
    <div class="container-fluid ">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 account-header1">
                <h4 class="title">Community</h4>
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
      <div class="container-fluid">
          <div class="row p-2">
          <div class="col-xxl-9 col-xl-9 col-lg-9 col-12  ">

              <div class="row chinese-main py-3" style="border-radius:0px">
                <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-9">
                <div class="">
                  <h2>{{ $blog->title }} </h2>
                  <p><?php echo $blog->description; ?></p>
                </div> 
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-3 text-center communit-name ">
                <?php if($blog->user->image!=""){
                            if(strpos($blog->user->image,'http') !== false)
                            {
                                $imgUser=$blog->user->image;
                            }else{
                                $imgUser=asset('assets/images/user/profile/'.$blog->user->image);
                            }
                        }else{
                            $imgUser=asset('assets/images/default-user.png');
                        } ?>
                  <h3><img class="img-fluid" src="<?php echo $imgUser; ?>" alt=""> {{ $blog->user->username }}</h3>
                  <p>{{ $blog->created_at }}</p>

                  
                </div>
            </div>
            <?php $x=1; ?>
            <?php foreach($recentComments as $comm){ ?>
                <div class="row chinese-main" style="border-radius:0px">
                    <div class="col-xxl-10 col-lg-9 col-md-9 col-9 border-b">
                    <div class="communit-name">
                        <?php if($comm->user->image!=""){
                            if(strpos($comm->user->image,'http') !== false)
                            {
                                $img=$comm->user->image;
                            }else{
                                $img=asset('assets/images/user/profile/'.$comm->user->image);
                            }
                        }else{
                            $img=asset('assets/images/default-user.png');
                        } ?>
                    <h2><img class="img-fluid" src="<?php echo $img; ?>" alt=""> {{ $comm->user->username }} </h2>
                    </div> 
                    </div>
                    <div class="col-xxl-2 col-lg-3 col-md-3 col-3 text-center border-b communit-name ">
                    <h3>#{{ $x }}</h3>
                    <p>{{ $comm->created_at }}</p>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12" style="min-height:80px">
                    <h4>{{ $comm->comment }}</h4>
                    <!-- <i class="fa fa-pencil-square-o edit-icon" aria-hidden="true"></i>  -->
                    </div>
                </div>
            <?php $x++; } ?>
            <div class="row">
                
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 text-center mb-4 p-0">
                    <form action="{{ route('comment.store') }}">      
                        <textarea class="form-control" name="comment" placeholder="Enter Your Review.."></textarea>
                        <input type="hidden" value="{{ $id }}" name="blog_id">
                        <input type="submit" class="text-right float-end mt-2 btn btn-dark" value="Comment">
                    </form>
                    </div>
               
            </div>
           
        

          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-3 mt-3 col-lg-3 col-12 ps-4">
        <?php $products=latestProducts(); 
        foreach($products as $product){
        ?>
        <div class="light-bg row">
          <div class="  p-0" style="width:100px">
            @if($product->image_type=='N')
            <img width="100" src="{{ getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}" /> 
            @else
            <model-viewer class="product-viewer" src="{{ asset('assets/images/product').'/'.$product->image_hash }}" style="background:#f1f1f1;margin:auto" auto-rotate camera-controls alt="cube" background-color="#455A64"></model-viewer>
            @endif
          </div>
          <div class=" ps-3" style="width:auto;">
            <a href="{{route('product.detail', $product->id)}}" style="color:#212529"><h5 class="mt-2"><?php echo ((strlen(strip_tags($product->title)) > 15) ? mb_substr(strip_tags($product->title), 0, 10) . '...' : strip_tags($product->title)) ?></h5></a>
            <h6 class="pt-1">{{__(nice_number($product->start_price))}} USD</h6>
          </div>
        </div>
        <br>
        <br>
        <?php } ?> 
      </div>         
          </div>
      </div>  
    </section>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
@endsection
@push('fbComment')
@php echo loadFbComment() @endphp
@endpush