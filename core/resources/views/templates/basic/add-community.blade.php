@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pad-5">
<style>
  .image-upload .thumb .profilePicPreview {
    width: 100%;
    height: 310px;
    display: block;
    border: 3px solid #f1f1f1;
    box-shadow: 0 0 5px 0 rgb(0 0 0 / 25%);
    border-radius: 10px;
    background-size: cover !important;
    background-position: top;
    background-repeat: no-repeat;
    position: relative;
    overflow: hidden;
}
.image-upload .thumb .profilePicPreview .remove-image {
    position: absolute;
    top: -9px;
    right: -9px;
    text-align: center;
    width: 55px;
    height: 55px;
    font-size: 24px;
    border-radius: 50%;
    background-color: #df1c1c;
    color: #fff;
    display: none;
}
.image-upload .thumb .profilePicUpload {
    font-size: 0;
    opacity: 0;
}
.image-upload .thumb .avatar-edit label {
    text-align: center;
    line-height: 45px;
    font-size: 18px;
    cursor: pointer;
    padding: 2px 25px;
    width: 100%;
    border-radius: 5px;
    box-shadow: 0 5px 10px 0 rgb(0 0 0 / 16%);
    transition: all 0.3s;
}
.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}
.form-group {
    margin-bottom: 1rem;
}
</style>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 account-header1">
        <h4 class="title">Create</h4>
      </div>
      <div class="col-md-12 mb-30 mt-3">
        <div class="card mb-2">
          <div class="card-body">
              <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
               
                @csrf()
                <div class="row">
                 
                  <div class=" col-md-12 px-4">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" value="C" name="type">
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Title</label>
                        <?php if (isset($blog->title)) {
                          $title = $blog->title;
                        } else {
                          $title = "";
                        } ?>
                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{ $title }}" required="">
                      </div>
                    </div>


                    <div class="col-md-12">
                      <div class="form-group">
                        <?php if (isset($blog->description)) {
                          $description = $blog->description;
                        } else {
                          $description = "";
                        } ?>
                        <label>Description</label>
                        <textarea rows="10" class="form-control nicEdit" placeholder="" name="description">{{ $description }}</textarea>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="form-group text-right px-4">
                  <button type="submit" class="btn btn-dark text-white ">Create</button>
                </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('script')
<script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<script>

function proPicURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = $(input).parents('.thumb').find('.profilePicPreview');
            $(preview).css('background-image', 'url(' + e.target.result + ')');
            $(preview).addClass('has-image');
            $(preview).hide();
            $(preview).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".profilePicUpload").on('change', function () {
    proPicURL(this);
});


    (function($) {
        "use strict";
        $('.iconPicker').iconpicker().on('change', function(e) {
            $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
        });
    })(jQuery);
</script>
@endpush