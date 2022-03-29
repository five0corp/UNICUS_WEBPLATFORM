@if(count($articles))
<section class="container-fluid dark-bg pb-0" style="margin-top: -50px;">
  <div class="row mt-4">
    <div class="col-12 columns">
      <div id="articalSlider" class="owl-carousel   owl-theme">
        <?php foreach ($articles as $article) { ?>
          <a href="{{ route('article.details',$article->id) }}">
            <div class="item artist-text">

              {{ $article->label }}

            </div>
          </a>
        <?php } ?>

      </div>
    </div>

  </div>
</section>
@endif
<section class="container-fluid dark-bg bottom-info">
  <div class="row">
    <div class="col-12">
      <hr class="home-hr" />
    </div>
    <div class="col-12">
      <div class="social-icon">
        <div class="social-img">
          <a href="{{ $socialMediaLinks->blog_link }}">
            <img src="{{ asset('assets/images/blog.png') }}" width="20px" />
          </a>
        </div>
        <div class="social-img">
          <a href="{{ $socialMediaLinks->telegram_link }}">
            <img src="{{ asset('assets/images/telegram.png') }}" width="20px" />
          </a>
        </div>
        <div class="social-img">
          <a href="{{ $socialMediaLinks->twitter_link }}">
            <img src="{{ asset('assets/images/twitter.png') }}" width="20px" />
          </a>
        </div>
        <div class="social-img">
          <a href="{{ $socialMediaLinks->medium_link }}">
            <img src="{{ asset('assets/images/medium.png') }}" width="20px" />
          </a>
        </div>
      </div>
    </div>
    <div class="col-12 text-center my-4">
      <div class="policy-text"><a href="{{ route('page','privacy-policy') }}">{{ (isset($privacyPolicy->title)) ? $privacyPolicy->title : 'Privacy Policy' }}</a> </div>
      <div class="policy-text"><a href="{{ route('page','service-policy') }}">{{ (isset($servicePolicy->title)) ? $servicePolicy->title : 'Service Policy' }}</a> </div>
    </div>
    <div class="col-12 text-center bottom-address mt-2">
      <div class="policy-text">UNICUS NFT Co. Ltd</div>
      <div class="policy-text">329-87-02370</div> <br />
      <div class="policy-text">Copyright© UNICUS All rights reserved.</div>
    </div>
  </div>
</section>

<style>
  .tooltip1 {
    position: relative;
    display: inline-block;
  }

  .tooltip1 .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .tooltip1 .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  .tooltip1:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }

  #contract-address:disabled {
    background-color: #ffffff;
    opacity: 1;
  }
</style>