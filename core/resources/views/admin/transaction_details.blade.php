@extends('admin.layouts.app')
@section('panel')


<style>
    td {
        text-align: left !important;
    }
</style>     
     
@if ( $data)
    <div class="bodywrapper_inner">
        <div class="row align-items-center mb-30 justify-content-between">
            <div class="col-lg-12">
                <div class="card b-radius--10">
                    <div class="card-body p-0">
                        <table class='table table-bordered'>
                            <tr>
                                <td class='w-25'>Transaction Hash:</td>
                                <td>
                                    @if(isset($data['transaction_hash']))
                                        {{ $data['transaction_hash'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    @if(isset($data['status']))
                                        @if ($data['status'] == 1)
                                            <span class="text-success">Success</span>
                                        @else
                                            <span class="text-danger">Failed</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Block:</td>
                                <td>
                                    @if(isset($data['block_no']))
                                        {{ $data['block_no'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Timestamp:</td>
                                <td>
                                    @if (isset($data['timestamp']))
                                        {{ \Carbon\Carbon::parse($data['timestamp'])->format('M. d, Y h:i:s A'); }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>From:</td>
                                <td>
                                    @if(isset($data['from_address']))
                                        {{ $data['from_address'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>To:</td>
                                <td>
                                    @if(isset($data['to_address']))
                                        {{ $data['to_address'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Value:</td>
                                <td>
                                    @if(isset($data['amount']))
                                        ETH {{ $data['amount'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Transaction Fee:</td>
                                <td>
                                    -
                                </td>
                            </tr>
                            <tr>
                                <td>Gas Price:</td>
                                <td>
                                    -
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@else
    <p>No record!</p>
@endif
     

@include('admin.partials.cron')
@endsection
