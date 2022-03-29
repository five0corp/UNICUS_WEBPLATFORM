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
                <form class="editor-form" action="{{route('admin.social-links.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group col-12 col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('Naver Blog') </label>
                            <?php if(isset($links->blog_link)){
                                $blog_link=$links->blog_link;
                            }else{
                                $blog_link="";
                            } ?>

                            <input class="form-control form--control-2" name="blog_link" id="blog_link" value="{{ $blog_link }}"/>
                      
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('Telegram') </label>
                            <?php if(isset($links->telegram_link)){
                                $telegram_link=$links->telegram_link;
                            }else{
                                $telegram_link="";
                            } ?>

                            <input class="form-control form--control-2" name="telegram_link" id="telegram_link" value="{{ $telegram_link }}"/>
                      
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('Twitter') </label>
                            <?php if(isset($links->twitter_link)){
                                $twitter_link=$links->twitter_link;
                            }else{
                                $twitter_link="";
                            } ?>

                            <input class="form-control form--control-2" name="twitter_link" id="twitter_link" value="{{ $twitter_link }}"/>
                      
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('Medium') </label>
                            <?php if(isset($links->medium_link)){
                                $medium_link=$links->medium_link;
                            }else{
                                $medium_link="";
                            } ?>

                            <input class="form-control form--control-2" name="medium_link" id="medium_link" value="{{ $medium_link }}"/>
                      
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
