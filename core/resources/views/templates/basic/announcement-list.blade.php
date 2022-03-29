@foreach($announcements as $ann)
<div class="row">
  <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 border-b">
    <div class="community-main">
      <a href="{{ route('announcement.details',[$ann->id]) }}">
        <h3>{{__($ann->title)}} </h3>
        <p> <?php echo ((strlen(strip_tags($ann->description)) > 300) ? mb_substr(strip_tags($ann->description), 0, 295) . '...' : strip_tags($ann->description)) ?></p>
      </a>
    </div>
  </div>
  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 text-center communit-name border-b">
    <p>{{showDateTime($ann->created_at, 'd M Y')}}</p>

  </div>
</div>
@endforeach