@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card">
            <div class="card-body">
                <?php if(isset($id)){ ?>
                    <form action="{{ route('admin.articles.update',$id) }}" method="POST" enctype="multipart/form-data">
                <?php }else{ ?>
                    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                <?php } ?>
                    @csrf()
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <?php
                                            if(isset($article->image)){ ?>
                                            
                                                <div class="profilePicPreview" style="background-image: url({{getImage('assets/images/article/'.$article->image)}})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                           <?php }else{ ?>
                                                <div class="profilePicPreview" style="background-image: url({{asset('assets/images/900x600.jpg')}})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                            <?php }
                                             ?>
                                            
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload0" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload0" class="bg--primary">Image</label>
                                            <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg, png</b>.
                                                | Will be resized to:
                                                <b>900x600</b>
                                                px.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-8 ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <?php if(isset($article->label)){
                                        $label= $article->label;
                                    }else{
                                        $label="";
                                    } ?>
                                    <input type="text" class="form-control" placeholder="Label" name="label" value="{{ $label }}" required="">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                <?php if(isset($article->description)){
                                        $description= $article->description;
                                    }else{
                                        $description="";
                                    } ?>
                                    <label>Description</label>
                                    <textarea rows="10" class="form-control nicEdit" placeholder="" name="description" >{{ $description }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn--primary btn-block btn-lg">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection




@push('script-lib')
<script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush

@push('script')
<script>
    (function($) {
        "use strict";
        $('.iconPicker').iconpicker().on('change', function(e) {
            $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
        });
    })(jQuery);
</script>
@endpush