



@extends('admin.layouts.app')
@section('panel')
     
     
@if (count($products) > 0)
    <div class="body-wrapper">
        <div class="bodywrapper_inner">
            <div class="row align-items-center mb-30 justify-content-between">
                <div class="col-lg-12">
                    <div class="card b-radius--10">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table--light style--two">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>User Name</th>
                                            <th>Sold Price</th>
                                            <th>Sold At</th>
                                        </tr>
                                    </thead>
                                    
                                    @foreach ( $products->unique('product_name') as $item )
                                        <tr>
                                            <td>{{ $item['product_name'] }}</td>
                                            <td>{{ $item['username'] }}</td>
                                            <td>{{ rtrim(rtrim(sprintf('%.8F', $item['bid_amount']), '0'), ".") . '(' . $item['symbol'] . ')' }}</td>
                                            <td>{{ $item['sold_at'] }}</td>
                                        </tr>    
                                    @endforeach
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class='d-flex justify-content-center'>
        {{ $products->links() }}    
    </div>
@else
    <p>No record!</p>
@endif
     

   
@include('admin.partials.cron')
@endsection

