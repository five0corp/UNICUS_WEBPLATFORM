@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <form class="editor-form" action="{{route('admin.top-banner.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group col-6 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Image') </label>

                            <!-- <textarea class="form-control form--control-2 nicEdit" name="body" id="body"> -->

                            <input type="file" class="form-control" name="image" id="image">
                            <img src="{{ asset('assets/images/slider/'.$image) }}" width="400">
                            <!-- </textarea> -->
                        </div>
                        <div class="form-group col-6 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Link')</label>
                            <input class="form-control" type="text" name="link" value="{{ $link }}">
                        </div>
                        <div class="form-group col-3 col-md-3">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Deactive')" value="1" name="active" <?php echo ($active==1) ? 'checked' : ''; ?>>
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