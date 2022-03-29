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
                                <th>@lang('Title')</th>
                                <th>@lang('Subtitle')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                            <tr>
                                <td data-label="@lang('Title')">{{__($slider->title)}}</td>
                                <td data-label="@lang('Subtitle')">{{__($slider->sub_title)}}</td>
                                <td data-label="@lang('Image')">
                                    <img src="{{getImage(imagePath()['slider']['path'].'/'.$slider->image)}}" width="100px"/></td>

                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateSlider" data-id="{{$slider->id}}" data-title="{{$slider->title}}" data-sub_title="{{$slider->sub_title}}" data-rank="{{$slider->rank}}" data-button_text="{{$slider->button_text}}" data-button_link="{{$slider->button_link}}" data-image="{{getImage(imagePath()['slider']['path'].'/'.$slider->image)}}"><i class="las la-pen"></i></a>
                                    <a href="{{ route('admin.slider.delete',$slider->id) }}" class="icon-btn btn--primary ml-1" data-id="{{$slider->id}}"><i class="las la-trash"></i></a>
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
                {{ paginateLinks($sliders) }}
            </div>
        </div>
    </div>
</div>


<div id="sliderModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Slider')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="form-control-label font-weight-bold">@lang('Title')</label>
                        <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="@lang(" Enter Title")" required="">
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="form-control-label font-weight-bold">@lang('Sub Title')</label>
                        <input type="text" class="form-control form-control-lg" name="sub_title" id="sub_title" placeholder="@lang(" Enter Sub Title")" required="">
                    </div>
                    <div class="form-group">
                        <label for="button_text" class="form-control-label font-weight-bold">@lang('Button Text')</label>
                        <input type="text" class="form-control form-control-lg" name="button_text" id="button_text" placeholder="@lang(" Enter Button Text")" required="">
                    </div>
                    <div class="form-group">
                        <label for="button_link" class="form-control-label font-weight-bold">@lang('Button Link')</label>
                        <input type="text" class="form-control form-control-lg" name="button_link" id="button_link" placeholder="@lang(" Enter Button Link")" required="">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-control-label font-weight-bold">@lang('Image') (1920*610)</label>
                        <input type="file" class="form-control form-control-lg" name="image" id="image" required="">
                    </div>
                    <div class="form-group">
                        <label for="rank" class="form-control-label font-weight-bold">@lang('Rank')</label>
                        <input type="text" class="form-control form-control-lg" name="rank" id="rank" placeholder="@lang(" Enter Rank")" required="">
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
            <form action="{{route('admin.slider.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="form-control-label font-weight-bold">@lang('Title')</label>
                        <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="@lang(" Enter Title")" required="">
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="form-control-label font-weight-bold">@lang('Sub Title')</label>
                        <input type="text" class="form-control form-control-lg" id="sub_title" name="sub_title" placeholder="@lang(" Enter Sub Title")" required="">
                    </div>
                    <div class="form-group">
                        <label for="button_text" class="form-control-label font-weight-bold">@lang('Button Text')</label>
                        <input type="text" class="form-control form-control-lg" id="button_text" name="button_text" placeholder="@lang(" Enter Button Text")" required="">
                    </div>
                    <div class="form-group">
                        <label for="button_link" class="form-control-label font-weight-bold">@lang('Button Link')</label>
                        <input type="text" class="form-control form-control-lg" id="button_link" name="button_link" placeholder="@lang(" Enter Button Link")" required="">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-control-label font-weight-bold">@lang('Image') (1920*610)</label>
                        <input type="file" class="form-control form-control-lg" id="image" name="image" placeholder="@lang(" Enter Image")">
                        <div class="show_image"></div>
                    </div>
                    <div class="form-group">
                        <label for="rank" class="form-control-label font-weight-bold">@lang('Rank')</label>
                        <input type="text" class="form-control form-control-lg" id="rank" name="rank" placeholder="@lang(" Enter Rank")" required="">
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
<a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addSlider"><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Slider')</a>
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
        modal.find('input[name=title]').val($(this).data('title'));
        modal.find('input[name=sub_title]').val($(this).data('sub_title'));
        modal.find('input[name=button_text]').val($(this).data('button_text'));
        modal.find('input[name=button_link]').val($(this).data('button_link'));
        modal.find('input[name=rank]').val($(this).data('rank'));
        img=$(this).data('image');
        modal.find('.show_image').html("<img src='"+img+"' width='100px' />");
        // var data = $(this).data('status');
        // if(data == 1){
        //     modal.find('input[name=status]').bootstrapToggle('on');
        // }else{
        //     modal.find('input[name=status]').bootstrapToggle('off');
        // }
        modal.modal('show');
    });
</script>
@endpush