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
                                <th>@lang('Title - Sub Title')</th>
                                <!-- <th>@lang('User')</th> -->
                                <th>@lang('Category - Brand')</th>
                                <th>@lang('Time Duration')</th>
                                <th>@lang('Start Price')</th>
                                <th>@lang('Sale Price')</th>
                                <th>@lang('Featured Item')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td data-label="@lang('Title')">
                                    <span>{{__(str_limit($product->title, 30))}}</span><br>
                                    <span> {{__(str_limit($product->sub_title, 20))}}</span>
                                </td>


                                <td data-label="@lang('Category - Brand')">
                                    <span class="font-weight-bold">{{__($product->category->name)}}</span><br>
                                    {{__($product->brand->name)}}
                                </td>

                                <td data-label="@lang('Time Duration')">
                                    {{showDateTime($product->start_date, 'd M Y')}}<br>
                                    - {{showDateTime($product->end_date, 'd M Y')}}
                                   
                                </td>

                                <td data-label="@lang('Start Price')">
                                    <span class="font-weight-bold">{{getAmount($product->start_price)}} {{__($general->cur_text)}}</span>
                                </td>
                                <td data-label="@lang('Sale Price')">
                                    <span class="font-weight-bold">{{getAmount($product->sale_price)}} {{__($general->cur_text)}}</span>
                                </td>

                                <td data-label="@lang('Featured Item')">
                                    @if($product->featured == 1)
                                    <span class="badge badge--success badge-pill font-weight-bold">@lang('Included')</span>
                                    <a href="javascript:void(0)" class="icon-btn btn--info ml-2 notInclude" data-toggle="tooltip" title="" data-original-title="@lang('Not Include')" data-id="{{ $product->id }}">
                                        <i class="las la-arrow-alt-circle-left"></i>
                                    </a>
                                    @else
                                    <span class="badge badge--warning badge-pill font-weight-bold text-white">@lang('Not included')</span>
                                    <a href="javascript:void(0)" class="icon-btn btn--success ml-2 include text-white" data-toggle="tooltip" title="" data-original-title="@lang('Include')" data-id="{{ $product->id }}">
                                        <i class="las la-arrow-alt-circle-right"></i>
                                    </a>
                                    @endif
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($product->status == 0)
                                    <span class="badge badge--primary">@lang('Pending')</span><br>
                                    {{diffForHumans($product->created_at)}}
                                    @elseif($product->status == 1)
                                    <span class="badge badge--success">@lang('Approved')</span>
                                    @elseif($product->status == 2)
                                    <span class="badge badge--danger">@lang('Cancel')</span>
                                    @elseif($product->status == 3)
                                    <span class="badge badge--warning">@lang('Expired')</span>
                                    @endif
                                </td>

                                <!-- <td data-label="@lang('Status')">
                                    @if($product->status == 0)
                                    <span class="badge badge--primary">@lang('Pending')</span><br>
                                    {{diffForHumans($product->created_at)}}
                                    @elseif($product->status == 1 && $product->time_duration > Carbon\Carbon::now())
                                    <span class="badge badge--success">@lang('Approved')</span>
                                    @elseif($product->status == 2)
                                    <span class="badge badge--danger">@lang('Cancel')</span>
                                    @elseif(Carbon\Carbon::now() > $product->time_duration)
                                    <span class="badge badge--warning">@lang('Expired')</span>
                                    @endif
                                </td> -->

                                <td data-label="@lang('Action')">
                                <a href="{{ route('admin.product.edit',$product->id) }}" class="icon-btn btn--primary ml-1" data-id="{{$product->id}}"><i class="las la-pen"></i></a>
                                    @if($product->status == 0)
                                    <a href="javascript:void(0)" data-id="{{$product->id}}" class="icon-btn btn--success ml-1 approved"><i class="las la-check"></i></a>
                                    <a href="javascript:void(0)" data-id="{{$product->id}}" class="icon-btn btn--danger ml-1 cancel"><i class="las la-times"></i></a>
                                    @elseif($product->status == 1 && $product->time_duration > Carbon\Carbon::now())
                                    <a href="javascript:void(0)" data-id="{{$product->id}}" class="icon-btn btn--danger ml-1 cancel"><i class="las la-times"></i></a>
                                    @endif
                                    <a href="{{route('admin.product.detail', $product->id)}}" class="icon-btn btn--primary ml-1"><i class="las la-desktop"></i></a>
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
                {{ paginateLinks($products) }}
            </div>
        </div>
    </div>
</div>



<div id="productModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Product')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="form-control-label font-weight-bold">@lang('Title')</label>
                        <input class="form-control form--control-2" id="title" type="text" maxlength="255" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required="">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Sub Title') </label>
                        <input class="form-control form--control-2" id="sub_title" type="text" maxlength="255" name="sub_title" value="{{old('sub_title')}}" placeholder="@lang('Enter Sub Title')" required="">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Select Category') </label>
                        <select class="form-control  form--control-2" name="category_id" id="category" required="">
                            <option value="">@lang('Select One')</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" data-subcategory="{{json_encode($category->subCategory)}}">{{__($category->name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Select Sub Category') </label>
                        <select class="form-control  form--control-2" name="sub_category" id="sub_category" required="">
                            <option value="">@lang('Select One')</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Select Brand') </label>
                        <select class="form-control  form--control-2" name="brand" id="brand" required="">
                            <option value="">@lang('Select One')</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{__($brand->name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label class="form-control-label font-weight-bold">@lang('Start Price') </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form--control-2" id="start_price" value="{{old('start_price')}}" name="start_price" placeholder="@lang('Enter Start Price')" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-control-label font-weight-bold">@lang('Sale Price') </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form--control-2" id="sale_price" value="{{old('sale_price')}}" name="sale_price" placeholder="@lang('Enter Sale Price')" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label class="form-control-label font-weight-bold">@lang('Start Date') </label>
                            <input class="form-control form--control-2" id="start_date" type="date" name="start_date" value="{{old('start_date')}}" placeholder="@lang('Enter Start Date')" required="">
                        </div>
                        <div class="col-6">
                            <label class="form-control-label font-weight-bold">@lang('End Date') </label>
                            <input class="form-control form--control-2" id="end_date" type="date" name="end_date" value="{{old('end_date')}}" placeholder="@lang('Enter End Date')" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Image') </label>
                        <input class="form-control form--control-2" type="file" id="file" name="image" required="">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                @lang('Feature Listing By featuring a listing you agree that an extra') {{getAmount($general->featured_price)}} {{$general->cur_text}} @lang('for items fee will be added to the final seller fee once the item is sold.')
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Key words') </label>
                        <select class="form-control form--control-2 select2-auto-tokenize" name="keywords[]" multiple="multiple" type="text" name="keyword" required=""></select>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="form-control-label font-weight-bold">@lang('Description') </label>
                            <textarea class="form-control form--control-2 nicEdit" name="description" id="description"></textarea>
                        </div>
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

<div class="modal fade" id="approvedby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('admin.product.approveby')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to approved this product?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Cancel Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('admin.product.cancelby')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to cancel this product?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="includeFeatured" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Featured Item Include')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.product.featured.include') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure include this product featured list?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="NotincludeFeatured" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Featured Item Remove')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.product.featured.remove') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure remove this product featured list?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<form action="{{route('admin.product.search', $scope ?? str_replace('admin.product.', '', request()->route()->getName())) }}" method="GET" class="top-action form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="@lang('Title')" value="{{ $search ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>

<form action="{{route('admin.product.category',$scope ?? str_replace('admin.product.', '', request()->route()->getName()))}}" method="GET" class="top-action form-inline float-sm-right bg--white ">
    <div class="input-group has_append">
        <select class="form-control" name="category_id">
            <option value="0">----@lang('Select Category')----</option>
            @foreach($categorys as $category)
            <option value="{{$category->id}}" @if(@$categoryId==$category->id) selected @endif>{{__($category->name)}}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>

<a href="{{ route('admin.product.create') }}" class="mr-2 mt-2 btn btn-sm btn--primary box--shadow1 text--small"><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Product')</a>
@endpush

@push('script')
<script>
    "use strict";

    bkLib.onDomLoaded(function() {
	        $( ".nicEdit" ).each(function( index ) {
	            $(this).attr("id","nicEditor"+index);
	            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
	        });
	    });

	   
        $('.select2-auto-tokenize').select2({
            tags: true,
            tokenSeparators: [',']
        })
	  

	    $('select[name=category_id]').on('change',function() {
            $('select[name=sub_category]').html('<option value="">@lang('Select One')</option>');
            var modal = $('#productModel');
            var subcategory = modal.find('select[name=category_id] :selected').data('subcategory');
            var html = '';
            subcategory.forEach(function myFunction(item, index) {
                html += `<option value="${item.id}">${item.name}</option>`
            });
            $('select[name=sub_category]').append(html);
        });

    $('.addProduct').on('click', function() {
        $('#productModel').modal('show');
        $('.nicEdit-panelContain').parent().width('100%');
        $('.nicEdit-main').parent().width('98%');
        $('.nicEdit-main').parent().css('min-height','100px');
    });
    $('.approved').on('click', function() {
        var modal = $('#approvedby');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.cancel').on('click', function() {
        var modal = $('#cancelBy');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.include').on('click', function() {
        var modal = $('#includeFeatured');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.notInclude').on('click', function() {
        var modal = $('#NotincludeFeatured');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

</script>
@endpush
