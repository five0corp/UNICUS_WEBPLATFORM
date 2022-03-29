@foreach($products as $product)

<div class="col-xxl-3 col-lg-6 mt-4 ">
<a href="{{route('product.detail', $product->id)}}">
    <div class="listing-product">
        <div class="caro-img p-3 pb-5">
            <img class="img-fluid" src="{{ asset('assets/images/product/'.$product->image) }}">
        </div>
        <div class="card-detail px-3">
            <div class="user-detail">
                <?php if(isset($product->collection->image)){
                    $img=getImage(imagePath()['collection']['path'].'/'.$product->collection->image);
                }else{
                    $img=asset('assets/images/default-user1.png');
                } ?>
                <img class="user-img" src="{{ $img }}" width="40px" />
                @if($product->collection)
                <p class="p-title">{{ $product->collection->name}}</p>
                @endif
            </div>
            <div class="prod-detail">
                <h3>{{ str_limit($product->title,20) }}</h3>
                <p>{{ str_limit($product->sub_title,32) }}</p>
                <div class="text-right"><img src="{{ asset('assets/images/logoIcon/fv.png') }}" class="icon-img" /><span>{{$product->start_price.' '.$product->symbol }}</span></div>
            </div>
        </div>
    </div>
</a>
</div>


@endforeach