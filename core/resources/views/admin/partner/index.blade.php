@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Link')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($partners as $partner)
                            <tr>
                                <td data-label="@lang('Title')">{{__($partner->link)}}</td>
                                <td data-label="@lang('Image')">
                                    <img src="{{getImage('assets/images/partner/'.$partner->image)}}" width="100px"/></td>

                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateSlider" data-id="{{$partner->id}}" data-link="{{$partner->link}}" data-active="{{$partner->active}}" data-image="{{getImage('assets/images/partner/'.$partner->image)}}"><i class="las la-pen"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                {{ paginateLinks($partners) }}
            </div>
        </div>
    </div>
</div>


<div id="sliderModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Partner')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.partners.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                      
                    <div class="form-group">
                        <label for="image" class="form-control-label font-weight-bold">@lang('Image') (1920*610)</label>
                        <input type="file" class="form-control form-control-lg" name="image" id="image" required="">
                    </div>
                    <div class="form-group">
                        <label for="link" class="form-control-label font-weight-bold">@lang('Link')</label>
                        <input type="text" class="form-control form-control-lg" name="link" id="link" placeholder="@lang(" Enter Link")" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Status') </label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                            data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Deactive')" value="1" name="active">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Create')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="updateSliderModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update Slider')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.partners.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                                       
                    <div class="form-group">
                        <label for="image" class="form-control-label font-weight-bold">@lang('Image') (1920*610)</label>
                        <input type="file" class="form-control form-control-lg" id="image" name="image" placeholder="@lang(" Enter Image")">
                        <div class="show_image"></div>
                    </div>
                    <div class="form-group">
                        <label for="link" class="form-control-label font-weight-bold">@lang('Link')</label>
                        <input type="text" class="form-control form-control-lg" id="link" name="link" placeholder="@lang(" Enter Link")" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Status') </label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                            data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Deactive')" value="1" name="active">
                    </div>
                    
                    <!-- <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status">
                        </div> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addSlider"><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Partner')</a>
@endpush

@push('script')
<script>
    "use strict";
    $('.addSlider').on('click', function() {
        $('#sliderModel').modal('show');
    });

    $('.updateSlider').on('click', function() {
        var modal = $('#updateSliderModel');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=link]').val($(this).data('link'));
        img=$(this).data('image');
        modal.find('.show_image').html("<img src='"+img+"' width='100px' />");
        var data = $(this).data('active');
        if(data == 1){
            modal.find('input[name=active]').bootstrapToggle('on');
        }else{
            modal.find('input[name=active]').bootstrapToggle('off');
        }
        modal.modal('show');
    });
</script>
@endpush