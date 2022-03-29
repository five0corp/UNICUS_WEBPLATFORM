@extends('admin.layouts.app')
@section('panel')
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .upper-layer {
        height: 650px;
        /* border: 1px solid #000; */
        /* border-radius: 30px; */
        /* background: #ccc; */
        margin-bottom: 20px;
    }

    .inner-layer {
        /* border: 1px solid #000; */
        height: 82%;
        margin: 45px;
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
                <form class="editor-form" action="{{route('admin.home.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group col-12 col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('body') </label>

                            <!-- <textarea class="form-control form--control-2 nicEdit" name="body" id="body"> -->
                            <div class="upper-layer"  name="body">
                                <div class="inner-layer">
                                    <div id='counter'>
                                       {!! $body !!}
                                    </div>
                                    <!-- <div id="editor" ></div> -->
                                </div>
                                        </div>
                                        <input type="hidden" name="body" id="body">
                            <!-- </textarea> -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary from-submit"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create')</button>
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
        ['link', 'image', 'video'],
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

    $(document).on('click','.from-submit',function(){
        var html=$('#counter').html();
        $('#body').val(html);

        $('form.editor-form').submit();
    });
</script>
@endpush