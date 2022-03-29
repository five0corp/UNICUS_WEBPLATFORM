@foreach($blogs as $blog)
<div class="col-xxl-4 col-xl-4 col-lg-6 col-12 mt-3">
  <div class="notice-main">
    <a href="{{ route('blog.details',[$blog->id,slug($blog->title)]) }}">
      <div class="artwoks-photo">
        <img class="img-fluid" src="{{getImage('assets/images/blog/'. @$blog->image, '900x600')}}" alt="@lang('blog')">
      </div>
      <h4> {{__($blog->title)}} </h4>
      <h6>{{showDateTime($blog->created_at, 'd M Y')}}</h6>
      <!-- <p> <?php //echo $blog->data_values->description; ?></p> -->
      <p><?php echo ((strlen(strip_tags($blog->description)) > 195 ) ? mb_substr(strip_tags($blog->description), 0, 195).'...' : strip_tags($blog->description)) ?></p>
    </a>
  </div>
</div>
@endforeach