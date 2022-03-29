@foreach($communities as $community)
<div class="row community-row">
  <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 ">
    <div class="community-main">
      <a href="{{ route('community.details',[$community->id]) }}">
        <h3>{{__($community->title)}} </h3>
        <p> <?php echo ((strlen(strip_tags($community->description)) > 300) ? mb_substr(strip_tags($community->description), 0, 295) . '...' : strip_tags($community->description)) ?></p>
      </a>
    </div>
  </div>
  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 text-center communit-name ">
    <p>{{showDateTime($community->created_at, 'd M Y')}}</p>
    <?php if ($community->user) {

      if ($community->user->image != "") {
        if(strpos($community->user->image,'http') !== false)
        {
          $img=$community->user->image;
        }else{
          $img = asset('assets/images/user/profile/' . $community->user->image);
        }
     
      } else {
        $img = asset('assets/images/default-user.png');
      } ?>
      <img class="img-fluid" src="<?php echo $img; ?>" alt="">
      <h3>{{ $community->user->username }}</h3>
    <?php } else { ?>
      <img class="img-fluid" src="<?php echo asset('assets/images/default-user.png'); ?>" alt="">
      <h3>UNICUS</h3>
    <?php } ?>


  </div>
</div>
@endforeach