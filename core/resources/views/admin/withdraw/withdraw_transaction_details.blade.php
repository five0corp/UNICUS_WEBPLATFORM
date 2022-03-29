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
                <div class="table-responsive--md  table-responsive">
                    @if($data)
                        <table class="table table--light style--two">
                            <tr>
                                <td class='w-25'>Transaction Hash</td>
                                <td>
                                    @if($data['transaction_hash'])
                                        {{ $data['transaction_hash'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Signature</td>
                                <td>
                                    @if($data['signature'])
                                        {{ $data['signature'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>
                                    @if($data['amount'] && $data['symbol'])
                                        {{ $data['amount'] . '(' . $data['symbol']  . ')'}}
                                    @else
                                        -
                                    @endif
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>From Address</td>
                                <td>
                                    @if($data['from_address'])
                                        {{ $data['from_address'] }}
                                    @else
                                        -
                                    @endif
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>To Address</td>
                                <td>
                                    @if($data['to_address'])
                                        {{ $data['to_address'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($data['status'])
                                        {{ $data['status'] ? 'Success' : 'Failed' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Block No.</td>
                                <td>
                                    @if($data['block_no'])
                                        {{ $data['block_no'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Timestamp</td>
                                <td>
                                    @if($data['timestamp'])
                                        {{ date('Y-m-d', $data['timestamp']) }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
            <div class="card-footer py-4">
             
            </div>
        </div>
    </div>
</div>


@endsection
