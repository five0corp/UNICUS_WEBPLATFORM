@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
            <form action="{{route('admin.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="title" class="form-control-label font-weight-bold">@lang('Title')</label>
                            <?php if($product->title){
                                $title=$product->title;
                            }elseif(old('title')){
                                $title=old('title');
                            }else{
                                $title='';
                            } ?>
                            <input class="form-control form--control-2" id="title" type="text" maxlength="255" name="title" value="{{ $title }}" placeholder="@lang('Enter Title')" required="">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Sub Title') </label>
                            <?php if($product->sub_title){
                                $sub_title=$product->sub_title;
                            }elseif(old('sub_title')){
                                $sub_title=old('sub_title');
                            }else{
                                $sub_title='';
                            } ?>
                            <input class="form-control form--control-2" id="sub_title" type="text" maxlength="255" name="sub_title" value="{{ $sub_title }}" placeholder="@lang('Enter Sub Title')" required="">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Select Category') </label>
                            <select class="form-control  form--control-2" name="category_id" id="category" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($categorys as $category)
                                <option value="{{$category->id}}" <?php echo ($product->category->id==$category->id) ? "selected" : ""; ?> data-subcategory="{{json_encode($category->subCategory)}}">{{__($category->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Select Sub Category') </label>
                            <select class="form-control  form--control-2" name="sub_category" id="sub_category" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($subcategorys as $subcategory)
                                <option value="{{$subcategory->id}}" <?php echo ($product->subCategory->id==$subcategory->id) ? "selected" : ""; ?>>{{__($subcategory->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Select Brand') </label>
                            <select class="form-control  form--control-2" name="brand" id="brand" required="">
                                <option value="">@lang('Select One')</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}" <?php echo ($product->brand->id==$brand->id) ? "selected" : ""; ?> >{{__($brand->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                        <?php if($product->pieces){
                                $pieces=$product->pieces;
                            }elseif(old('pieces')){
                                $pieces=old('pieces');
                            }else{
                                $pieces=0;
                            } ?>
                            <label class="form-control-label font-weight-bold">@lang('No of Pieces') </label>
                            <input class="form-control form--control-2" id="pieces" type="number" maxlength="255" name="pieces" value="{{ $pieces }}" placeholder="@lang('Enter No of Pieces')" required="">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Start Price') </label>
                            <div class="input-group mb-3">
                            <?php if($product->start_price){
                                $start_price=$product->start_price;
                            }elseif(old('start_price')){
                                $start_price=old('start_price');
                            }else{
                                $start_price=0;
                            } ?>
                                <input type="text" class="form-control form--control-2" id="start_price" value="{{ $start_price }}" name="start_price" placeholder="@lang('Enter Start Price')" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Sale Price') </label>
                            <div class="input-group mb-3">
                            <?php if($product->sale_price){
                                $sale_price=$product->sale_price;
                            }elseif(old('sale_price')){
                                $sale_price=old('sale_price');
                            }else{
                                $sale_price=0;
                            } ?>
                                <input type="text" class="form-control form--control-2" id="sale_price" value="{{ $sale_price }}" name="sale_price" placeholder="@lang('Enter Sale Price')" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Start Date') </label>
                            <?php if($product->start_date){
                                $start_date=$product->start_date;
                            }elseif(old('start_date')){
                                $start_date=old('start_date');
                            }else{
                                $start_date='';
                            } ?>
                            <input class="form-control form--control-2" id="start_date" type="date" name="start_date" value="<?php echo date('Y-m-d',strtotime($start_date)); ?>" placeholder="@lang('Enter Start Date')" required="">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('End Date') </label>
                            <?php if($product->end_date){
                                $end_date=$product->end_date;
                            }elseif(old('end_date')){
                                $end_date=old('end_date');
                            }else{
                                $end_date='';
                            } ?>
                            <input class="form-control form--control-2" id="end_date" type="date" name="end_date" value="<?php echo date('Y-m-d',strtotime($end_date)); ?>" placeholder="@lang('Enter End Date')" required="">
                        </div>
                    
                    <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('User') </label>
                        <?php if($product->user_id){
                                $u_id=$product->user_id;
                            }else{
                                $u_id=0;
                            }
                            // dd($users); ?>
                        <select class="form-control form--control-2 select2-auto-tokenize" name="user_id" type="text" name="user_id" required="">
                            <option <?php echo ($u_id==0) ? 'selected' : '' ; ?> value="0">--select user--</option>    
                        <?php foreach($users as $use){    ?> 
                                <option <?php echo ($u_id==$use->id) ? 'selected' : '' ; ?> value="{{ $use->id }}">{{ $use->username }}</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Key words') </label>
                        <?php if($product->keyword){
                                $keywords=$product->keyword;
                            }else{
                                $keywords=array();
                            }
                            //dd($keywords); ?>
                        <select class="form-control form--control-2 select2-auto-tokenize" name="keywords[]" multiple="multiple" type="text" name="keyword" >
                            <?php foreach($keywords as $key){    ?> 
                                <option selected>{{ $key }}</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Image') </label>
                        <input class="form-control form--control-2" type="file" id="file" name="image" >
                        <?php if($product->image){
                            $image=$product->image;
                        }else{
                            $image='';
                        }  if($image!=""){ ?>
                             <img src="{{getImage(imagePath()['product']['path'].'/'.$image)}}" width="100px"/>
                        <?php } ?>
                    </div>
                    
                    <div class="form-group col-12 col-md-6">
                    <?php if($product->glb_image){
                            $glb_image=$product->glb_image;
                        }else{
                            $glb_image='';
                        }
                        ?>
                        <label class="form-control-label font-weight-bold">@lang('GLB Image')</label>
                        <input class="form-control form--control-2" type="file" id="glb_file" name="glb_image">
                        @if($glb_image!="")
                        <model-viewer src="{{ config('app.ipfs_url').$glb_image }}?filename={{ $product->glb_filename }}" style="width:100px;height:100px;padding:10px;background:#fff" auto-rotate camera-controls alt="cube" background-color="#455A64"></model-viewer>
                        @endif
                    </div>
                    

                    <div class="form-group col-12 col-md-12">
                        <label class="form-control-label font-weight-bold">@lang('Description') </label>
                        <?php if($product->description){
                                $description=$product->description;
                            }elseif(old('description')){
                                $description=old('description');
                            }else{
                                $description='';
                            } ?>
                        <textarea class="form-control form--control-2 nicEdit" name="description" id="description">{{ $description}}</textarea>
                    </div>
                    <div class="form-group col-12 col-md-12">
                        <div class="form-check">
                        <?php if($product->featured){
                                $featured=$product->featured;
                            }else{
                                $featured=0;
                            } ?>
                            <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault" <?php echo ($featured==1) ? "checked" : ""; ?>>
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
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
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
            
            var subcategory = $('select[name=category_id] :selected').data('subcategory');
            var html = '';
            subcategory.forEach(function myFunction(item, index) {
                html += `<option value="${item.id}">${item.name}</option>`
            });
            $('select[name=sub_category]').append(html);
        });

</script>
@endpush
