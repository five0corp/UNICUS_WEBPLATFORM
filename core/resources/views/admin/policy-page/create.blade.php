@extends('admin.layouts.app')
@section('panel')
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .upper-layer {
        height: 500px;
        /* border: 1px solid #000; */
        /* border-radius: 30px; */
        /* background: #ccc; */
        margin-bottom: 20px;
    }

    .inner-layer {
        /* border: 1px solid #000; */
        height: 82%;
        /* margin: 45px; */
        /* background: #fff; */
    }

    .ql-toolbar.ql-snow {
        border: none;
    }

    .ql-container.ql-snow {
        border: none;
    }

    .ql-toolbar.ql-snow {
        border: none;
        padding: 4.5% 13%;
    }

    .ql-editor {
        padding: 140px;
        overflow-y: scroll;
        padding-top: inherit;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                @if(isset($id))
                <form class="editor-form" action="{{route('admin.policy-page.update')}}" method="POST" enctype="multipart/form-data">
                    @else
                    <form class="editor-form" action="{{route('admin.policy-page.store')}}" method="POST" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <?php 
                                if (isset($page)) {
                                    $slug = $page->slug;
                                } else {
                                    $slug = '';
                                } ?>
                                <label for="name" class="form-control-label font-weight-bold">@lang('Slug')</label>
                                <!-- <input type="text" class="form-control form-control-lg" name="slug" value=" $slug " id="slug" placeholder="@lang(" Enter Slug")" required=""> -->
                                <select class="form-control form-control-lg" name="slug" id="slug">
                                    <option value="privacy-policy" <?php echo ($slug=='privacy-policy') ? 'selected' : ''; ?> >privacy-policy</option>
                                    <option value="how-to-sign-up" <?php echo ($slug=='how-to-sign-up') ? 'selected' : ''; ?>>how-to-sign-up</option>
                                    <option value="how-to-make-an-nft" <?php echo ($slug=='how-to-make-an-nft') ? 'selected' : ''; ?>>how-to-make-an-nft</option>
                                    <option value="service-policy" <?php echo ($slug=='service-policy') ? 'selected' : ''; ?>>service-policy</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-control-label font-weight-bold">@lang('Title')</label>
                                <?php if (isset($page)) {
                                    $title = $page->title;
                                } else {
                                    $title = '';
                                } ?>
                                <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="@lang(" Enter Title")" value="{{$title}}" required="">
                            </div>
                            <div class="form-group col-12 col-md-12">
                                <label class="form-control-label font-weight-bold">@lang('content') </label>

                                <div class="upper-layer" style="border: 1px solid #ccc;">
                                    <div class="inner-layer">
                                        <div id='counter'>
                                            @if(isset($page))
                                            {!! $page->content !!}
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                
                                
                            </div>

                        </div>
                        <div class="modal-footer">
                        <input type="hidden" name="content" id="content">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                            @if(isset($id))
                                <input type="hidden" name="id" id="id" value="{{ $id }}">
                                <button type="submit" class="btn btn--primary from-submit"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>
                            @else 
                                <button type="submit" class="btn btn--primary from-submit"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create')</button>
                            @endif
                            
                           
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>


@endsection


@push('script')
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
<script>
    var FontStyle = Quill.import('attributors/style/font');
    Quill.register(FontStyle, true);

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        // ['blockquote', 'code-block'],

        // [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        // [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        // [{ 'direction': 'rtl' }],                         // text direction

        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'font': []
        }],
        [{
            'align': []
        }],
        // ['link', 'image', 'video'],
        ['clean'] // remove formatting button
    ];
    var quill = new Quill('#editor', {
        // modules: {
        //     toolbar: '#counter'
        // },
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow',
        container: '#counter',
    });

    $(document).on('click', '.from-submit', function() {
        var html = $('#counter .ql-editor').html();
        $('#content').val(html);

        $('form.editor-form').submit();
    });
</script>
@endpush