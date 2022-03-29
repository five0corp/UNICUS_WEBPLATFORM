@extends($activeTemplate.'layouts.frontend')
@section('content')
    

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h3>My Transactions</h3>                
            <div class="table-responsive">
                @if($data)
                    @if(count($data) == 0)
                        No record.
                    @else
                        <table class="table table-hover">
                            <tr>
                                <td>Id</td>                                
                                <td>Product Name</td>
                                <td>Hash</td>
                                <td>Amount</td>
                                <td>Address</td>                                
                                <!--<td>Transaction Hash</td>-->
                                <!--<td>Signature</td>-->
                                <!-- <td>Event</td>
                                <td>Account Address</td>-->
                                <td>Date</td> 
                            </tr>
                            
                            @foreach ( $data as $item )
                                <tr>
                                    <td>{{ $item['id'] }}</td>                                    
                                    <td>{{ $item['product_name'] }}</td>
                                    <td>{{ $item['hash'] }}</td>
                                    <td>{{ rtrim(rtrim(sprintf('%.8F', $item['bid_amount']), '0'), ".") . '(' . $item['symbol'] . ')' }}</td>                                    
                                    <!--<td>{{ $item['transaction_hash'] }}</td>-->
                                    <!--<td>{{ $item['signature'] }}</td>-->
                                    <td>{{ $item['account_address'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['updated_at'])->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            
                        </table>
                    @endif
                @endif
            </div>        
        </div>
    </div>
</div>
    
    
<div class="mb-3">
    {{ $data->links() }}
</div>    
    
@endsection