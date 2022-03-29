@foreach($products as $product)

<div class="col-xxl-3 mt-4">
    <div class="list-prod">
        <a href="{{route('product.detail', $product->id)}}">
            <h2> <?php echo (strlen($product->title)>20) ? mb_substr($product->title,0,17).'...' : $product->title; ?></h2>

            <p><?php echo (strlen($product->sub_title)>25) ? mb_substr($product->sub_title,0,22).'...' : $product->sub_title; ?></p>
            <img class="img-fluid" src="{{ getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}">
            <!-- <h3>花見</h3> -->
            <h4>{{ $product->start_price }} ETH</h4>&nbsp;
            <button type="button" class="btn btn-danger">Auction</button>
        </a>
    </div>
</div>


@endforeach