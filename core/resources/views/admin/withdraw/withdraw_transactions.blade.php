@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--md  table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('Transaction Hash')</th>
                                <th scope="col">@lang('Signature')</th>
                                <th scope="col">@lang('Block')</th>
                                <th scope="col">@lang('From Address')</th>
                                <th scope="col">@lang('To Address')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Timestamp')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr>
                                <td>
                                    {{ $item['transaction_hash'] }}
                                </td>
                                <td>
                                    {{ $item['signature'] }}
                                </td>
                                <td>
                                    {{ $item['block_no'] }}
                                </td>
                                <td>
                                    {{ $item['from_address'] }}
                                </td>
                                <td>
                                    {{ $item['to_address'] }}
                                </td>
                                <td>
                                    {{ rtrim(rtrim(sprintf('%.8F', $item['amount']), '0'), ".") . '(' . $item['symbol']  . ')' }}
                                </td>
                                <td>
                                    {{ $item['timestamp'] }}
                                </td>
                                <td>
                                    {{ $item['status'] == 1 ? 'Success' : 'Failed' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.withdraw.withdraw-transaction-details', ['id' => $item['id']] ) }}">Details</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
             
            </div>
        </div>
    </div>
</div>


@endsection

