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
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Bid Amount</th>
                                <th>Transaction Hash</th>
                                <th>Action</th>
                            </tr>
                        </thaed>
                        <tbody>
                            @if($data)
                                @foreach($data as $item)
                                    <tr>
                                        <td>
                                            {{ $item['id'] }}
                                        </td>
                                        <td>
                                            @if($item['product_name'])
                                                {{ $item['product_name'] }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($item['bid_amount'])
                                                {{ rtrim(rtrim(sprintf('%.8F', $item['bid_amount']), '0'), ".") }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($item['transaction_hash'])
                                                {{ $item['transaction_hash'] }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.product-bidding-details', ['id' => $item['id']]) }}">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection