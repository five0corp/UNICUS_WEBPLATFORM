@extends('admin.layouts.app')
@section('panel')

<style>
    td {
        text-align: left !important;
    }
</style>


<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    @if($data)

                        <table class="table table--light style--two">
                            <tr>
                                <td class="w-25">
                                    Bid Id
                                </td>
                                <td>
                                    {{ $data['id'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Product Name
                                </td>
                                <td>
                                    @if($data['product_name'])
                                        {{ $data['product_name'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Bid Amount                                    
                                </td>
                                <td>
                                    @if($data['bid_amount'] && $data['symbol'])
                                        {{ rtrim(rtrim(sprintf('%.8F', $data['bid_amount']), '0'), ".") . '(' . $data['symbol']  . ')'}}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Transaction Hash
                                </td>
                                <td>
                                    @if($data['transaction_hash'])
                                        {{ $data['transaction_hash'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Signature
                                </td>
                                <td>
                                    @if($data['signature'])
                                        {{ $data['signature'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date Time
                                </td>
                                <td>
                                    @if($data['start_date'])
                                        {{ $data['start_date'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection