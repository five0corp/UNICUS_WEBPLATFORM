@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
            <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="title" class="form-control-label font-weight-bold">@lang('Title')</label>
                            <input class="form-control form--control-2" id="title" type="text" maxlength="255" name="title" value="{{old('title')}}" placeholder="@lang('Enter Title')" required="">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Sub Title') </label>
                            <input class="form-control form--control-2" id="sub_title" type="text" maxlength="255" name="sub_title" value="{{old('sub_title')}}" placeholder="@lang('Enter Sub Title')" required="">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Select Category') </label>
                            <select class="form-control  form--control-2" name="category_id" id="category" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" data-subcategory="{{json_encode($category->subCategory)}}">{{__($category->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Select Sub Category') </label>
                            <select class="form-control  form--control-2" name="sub_category" id="sub_category" required="">
                                <option value="">@lang('Select One')</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Select Brand') </label>
                            <select class="form-control  form--control-2" name="brand" id="brand" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{__($brand->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('No of Pieces') </label>
                            <input class="form-control form--control-2" id="pieces" type="number" maxlength="255" name="pieces" value="{{old('pieces')}}" placeholder="@lang('Enter No of Pieces')" required="">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Start Price') </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form--control-2" id="start_price" value="{{old('start_price')}}" name="start_price" placeholder="@lang('Enter Start Price')" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Sale Price') </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form--control-2" id="sale_price" value="{{old('sale_price')}}" name="sale_price" placeholder="@lang('Enter Sale Price')" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Start Date') </label>
                            <input class="form-control form--control-2" id="start_date" type="date" name="start_date" value="{{old('start_date')}}" placeholder="@lang('Enter Start Date')" required="">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('End Date') </label>
                            <input class="form-control form--control-2" id="end_date" type="date" name="end_date" value="{{old('end_date')}}" placeholder="@lang('Enter End Date')" required="">
                        </div>
                    
                        <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('User') </label>
                       
                        <select class="form-control form--control-2 select2-auto-tokenize" name="user_id" type="text" name="user_id" required="">
                            <option value="0">--select user--</option>    
                        <?php foreach($users as $use){    ?> 
                                <option value="{{ $use->id }}">{{ $use->username }}</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Key words') </label>
                        <select class="form-control form--control-2 select2-auto-tokenize" name="keywords[]" multiple="multiple" type="text" name="keyword" ></select>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Image') </label>
                        <input class="form-control form--control-2" type="file" id="file" name="image" required="">
                    </div>

                    <!-- <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Image Type') </label> <br />
                        <input type="radio" id="html" name="image_type" value="N" checked>
                        <label for="html">.jpg, .jpeg, .png</label> &nbsp;&nbsp;&nbsp; 
                        <input type="radio" id="css" name="image_type" value="G">
                        <label for="css">.glb</label>
                    </div> -->

                    <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('GLB Image') </label>
                        <input class="form-control form--control-2" type="file" id="glb_file" name="glb_image">
                    </div>
                    
                    
                    <div class="form-group col-12 col-md-12">
                        <label class="form-control-label font-weight-bold">@lang('Description') </label>
                        <textarea class="form-control form--control-2 nicEdit" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group col-12 col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                @lang('Feature Listing By featuring a listing you agree that an extra') {{getAmount($general->featured_price)}} {{$general->cur_text}} @lang('for items fee will be added to the final seller fee once the item is sold.')
                            </label>
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
</div>


@endsection


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
            // var modal = $('#productModel');
            var subcategory = $('select[name=category_id] :selected').data('subcategory');
            var html = '';
            subcategory.forEach(function myFunction(item, index) {
                html += `<option value="${item.id}">${item.name}</option>`
            });
            $('select[name=sub_category]').append(html);
        });

</script>
@endpush
