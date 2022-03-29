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
                                <th scope="col">@lang('Product')</th>
                                <th scope="col">@lang('Hash')</th>
                                <th scope="col">@lang('Transaction Hash')</th>
                                <th scope="col">@lang('Signature')</th>
                                <th scope="col">@lang('Event')</th>
                                <th scope="col">@lang('Account Address')</th>
                                <th scope="col">@lang('Created At')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <td data-label="@lang('Product')">
                                <span class="font-weight-bold">{{__($transaction->product->title)}}</span>
                                </td>

                                <td data-label="@lang('Hash')">
                                <span class="font-weight-bold">{{__($transaction->hash)}}</span>
                                </td>

                                <td data-label="@lang('Transaction Hash')">
                                <span class="font-weight-bold">{{__($transaction->transaction_hash)}}</span>
                                </td>

                                <td data-label="@lang('Signature')">
                                <span class="font-weight-bold">{{__($transaction->signature)}}</span>
                                </td>

                                <td data-label="@lang('Event')">
                                <span class="font-weight-bold">
                                @if($transaction->event == 'AS')
                                    Auction Start
                                @elseif($transaction->event == 'AE')
                                    Auction End
                                @elseif($transaction->event == 'PB')
                                    Place Bid
                                @else
                                
                                @endif
                                    </span>
                                </td>
                                <td data-label="@lang('Account Address')">
                                <span class="font-weight-bold">{{__($transaction->account_address)}}</span>
                                </td>

                                <td data-label="@lang('Created At')">
                                <span class="font-weight-bold">{{diffForHumans($transaction->created_at)}}</span>
                                </td>
                                
                                <td data-label="@lang('Product Bidding Id')">
                                    <span class="font-weight-bold">
                                        @if(isset($transaction->productBidding->bid_amount))
                                            {{ $transaction->productBidding->bid_amount . '(' . $transaction->product->symbol . ')' }}
                                        @else
                                            -
                                        @endif
                                    </span>

                                </td>                                

                                <td data-label="@lang('Product Bidding Id')">
                                    <a href="{{ route('admin.transaction-details', $transaction->id) }}">Details</a>
                                    &nbsp;|&nbsp;
                                    <a href="{{ route('admin.transactionPayments.index', ['hash' => $transaction->transaction_hash]) }}">Payments</a>
                                </td>                                
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
             {{paginateLinks($transactions)}}
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="adModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
       <form action="{{route('admin.transactions.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Advertisement')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">@lang('Name')</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="@lang("Enter Name")" value="{{old('name')}}" id="name" maxlength="60" required="">
                </div>

                <div class="form-group">
                    <label for="size" class="font-weight-bold">@lang('Select Ad Size')</label>
                    <select class="form-control form-control-lg" name="size" id="size">
                        <option value="">@lang('Select Size')</option>
                        <option value="540x984">@lang('540x984')</option>
                        <option value="779x80">@lang('779x80')</option>
                        <option value="300x250">@lang('300x250')</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type" class="font-weight-bold">@lang('Select Type')</label>
                    <select class="form-control type form-control-lg" id="type" name="type" required>
                        <option selected="" disabled="">----@lang('Select One')----</option>
                        <option value="1">@lang('Banner')</option>
                        <option value="2">@lang('Script')</option>
                    </select>
                </div>
                
                <div id="bannerAdd">
                    <div class="form-group ru">
                        <label for="redirect_url" class="font-weight-bold">@lang('Redirect Url')</label>
                        <input type="text" class="form-control form-control-lg" name="redirect_url" placeholder="@lang('http/https://example.com')" value="{{old('redirect_url')}}" id="redirect_url">
                    </div>

                    <div class="form-group">
                        <label for="symbol" class="form-control-label font-weight-bold">@lang('Ad Image')</label>
                        <div class="custom-file">
                            <input type="file" name="adimage" class="custom-file-input" id="customFileLangHTML">
                            <label class="custom-file-label" for="customFileLangHTML" data-browse="@lang('Choose Image')">@lang('Image')</label>
                        </div>
                    </div>
                </div>

                <div id="scriptAdd">
                    <div class="form-group">
                        <label for="script" class="font-weight-bold">@lang('Ad Script')</label>
                        <textarea type="text" class="form-control" name="script" id="script">{{old('script')}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label font-weight-bold">@lang('Status') </label>
                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Save')</button>
            </div>
        </div>
       </form>
    </div>
</div>


<div class="modal fade" id="deleteAds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Delete Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.transactions.delete') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to delete this transaction?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- @push('breadcrumb-plugins') --}}
    <!-- <button type="button" data-toggle="modal" data-target="#adModal" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Transaction')</button> -->
{{-- @endpush --}}

@push('breadcrumb-plugins')
    <form action="{{ route('admin.transaction.search', $scope ?? str_replace('admin.transaction.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Product or Hash or Transaction Hash or Signature or Account Address')" value="{{ $search ?? '' }}" style="width: 534px;">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

@push('script')
    <script>
        'use strict';
        $("#bannerAdd").hide();
        $("#scriptAdd").hide();
        $('.type').on("change",function () {
            if($(this).val() == 1){
                $("#bannerAdd").show();
                $("#scriptAdd").hide();
            } else if($(this).val() == 2) {
                $("#bannerAdd").hide();
                $("#scriptAdd").show();
            }
        });
        $(document).on("change",".custom-file-input",function(){
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('.delete').on('click', function () {
            var modal = $('#deleteAds');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush