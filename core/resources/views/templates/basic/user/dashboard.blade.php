@extends($activeTemplate.'layouts.frontend')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/line-awesome.min.css') }}" />
<style>
    #show_balance{
        font-size: 22px;
        margin-left: 12px;
    }
</style>
<section class="mrg-top35">
    <div class="container-fluid">
        <div class="row  ">
            <div class="col-xxl-2 list-left-main   mt-4 p-0">
                @include('templates.basic.partials.dashboard-sidebar')
            </div>
            <div class="col-xxl-10 w-bg  my-wallet ">
            <div class="row justify-content-center g-4">
                        <div class="col-lg-4 col-sm-6">
                            <div class="dashboard__item">
                                <div class="content">
                                    <span class="subtitle">@lang('Eth Wallet Address')</span>
                                    <h4 class="title" id="eth_address" style="overflow-wrap: break-word;">-</h4>
                                    <!-- <h4 class="title">{{$general->cur_sym}} {{getAmount($user->balance)}}</h4> -->
                                </div>
                                <div class="thumb">
                                    <i class="las la-wallet"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dashboard__item">
                                <div class="content">
                                    <span class="subtitle">@lang('Ethereum')</span>
                                    <h4 class="title"><span id="total_eth">0.0</span>eth</h4>
                                    <!-- <h4 class="title">{{$general->cur_sym}} {{getAmount($amount['deposit'])}}</h4> -->
                                </div>
                                <div class="thumb">
                                    <i class="las la-money-bill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dashboard__item">
                                <div class="content">
                                    <span class="subtitle">@lang('UNIC')</span>
                                    <h4 class="title">0.0 UNIC</h4>
                                    <!-- <h4 class="title">{{$general->cur_sym}} {{getAmount($amount['withdraw'])}}</h4> -->
                                </div>
                                <div class="thumb">
                                    <i class="las la-credit-card"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dashboard__item">
                                <div class="content">
                                    <span class="subtitle">@lang('Total Transaction')</span>
                                    <h4 class="title">{{$transactionCount}}</h4>
                                </div>
                                <div class="thumb">
                                    <i class="las la-file-invoice-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dashboard__item">
                                <div class="content">
                                    <span class="subtitle">@lang('Total Products')</span>
                                    <h4 class="title">{{$product['all']}}</h4>
                                </div>
                                <div class="thumb">
                                    <i class="lab la-product-hunt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dashboard__item">
                                <div class="content">
                                    <span class="subtitle">@lang('Total Sold Product')</span>
                                    <h4 class="title">{{$product['sold']}}</h4>
                                </div>
                                <div class="thumb">
                                    <i class="las la-shopping-cart"></i>
                                </div>
                            </div>
                        </div>

                        <!-- <div>
                            <button id="eth_total_balance" class="btn btn-dark">Check Balance</button>
                            <span id="show_balance"></span>
                        </div> -->
                    </div>
                    <div class="pt-60 row">
                        <div class="col-6">
                            <h5 class="wish-title">@lang('Transaction Log')</h5>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <label class="col-4">Search By Status: </label>
                                <div class="col-8">
                                    <form action="{{ route('profile','dashboard') }}" method="GET" class="top-action form-inline float-sm-right bg--white ">
                                        <div class="input-group has_append">
                                            <select class="form-control" name="status" onchange="this.form.submit()">
                                                <option <?php echo ($status == 'all') ? 'selected' : ''; ?> value="all">All</option>
                                                <option <?php echo ($status == 'A') ? 'selected' : ''; ?> value="A">Approved</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped cmn--table">
                                <thead>
                                    <tr>
                                        <th>@lang('Date')</th>
                                        <th>@lang('Product')</th>
                                        <th>@lang('Amount')</th>
                                        <!-- <th>@lang('Post Balance')</th> -->
                                        <th>@lang('Detail')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                    <tr>
                                        <td data-label="@lang('Date')">
                                            <div>
                                                {{showDateTime($transaction->created_at)}}<br>
                                                {{diffForHumans($transaction->created_at)}}
                                            </div>
                                        </td>
                                        <td data-label="@lang('Product')">
                                            {{$transaction->product->title}}
                                        </td>
                                        <!-- <td data-label="@lang('Amount')">
                                            <strong
                                                @if($transaction->trx_type == '+')
                                                    class="text--success"
                                                @else
                                                    class="text--danger"
                                                @endif>
                                                {{($transaction->trx_type == '+') ? '+':'-'}} {{getAmount($transaction->amount)}} {{__($general->cur_text)}}
                                            </strong>
                                        </td> -->

                                        <td data-label="@lang('Amount')">
                                            <div>
                                                {{getAmount($transaction->bid_amount)}} {{$general->cur_text}}
                                            </div>
                                        </td>

                                        <td data-label="Detail">
                                            <div>
                                                <a class="btn btn-dark" href="{{ route('product.detail',$transaction->product->id) }}">Detail</a>
                                                {{__($transaction->details)}}
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{$emptyMessage}}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-footer py-4">
                                <!-- {{ $transactions->links() }} -->
                                {!! $transactions->links() !!}
                                <!-- {{ paginateLinks($transactions) }} -->
                            </div>
                        </div>
                    </div>
                <br />
                <br />
            </div>

        </div>
    </div>
</section>
@push('script')
<script src="{{ asset('assets/admin/js/notify.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script>
    var eth_total_balance = 0;
    var accounts;
    var networkId = 0;
    var smartContractAddress = "{{config('app.smart_contract_address')}}";
    var tokenSmartContractAddress = "{{config('app.token_smart_contract_address')}}";
    var ownerAddress = "{{config('app.owner_address')}}";
    var ropesticNetworkId = "{{config('app.network_id')}}";
    var gasLimit = "{{config('app.gasLimit')}}";
    loadMetamask();
    $(document).on("click", "#eth_total_balance", function() {
        if (eth_total_balance == 0) {
            loadMetamask();
        } else {
            $.notify("Please wait...process is running", "error");
        }
    });

    async function loadMetamask() {
        if (window.ethereum) {
            window.web3 = new Web3(ethereum);
            try {
                // Request account access if needed
                accounts = await requestForAccessAccount();
                var acc= await window.web3.eth.getBalance(accounts[0].toString().toLowerCase());
                var acc = window.web3.utils.fromWei(acc.toString(), 'ether');
                // $('#show_balance').html(" "+(parseFloat(acc)).toFixed(4)+' ETH');
                $('#total_eth').html(" "+(parseFloat(acc)).toFixed(4));

                $('#eth_address').html(accounts[0].toString().toLowerCase());

                total_eth
                console.log('aaaaaa ' + acc);
                if (ownerAddress.toLowerCase() != accounts[0].toString().toLowerCase()) {
                    networkId = await requestForAccessNetwork();
                    if (networkId + "" == ropesticNetworkId) {
                        window.contract = await loadContract();
                        console.log(window.contract);
                        if (window.contract) {

                        } else {
                            $.notify("Smart Contract instance is not valid", "error");
                        }
                    } else {
                        $.notify("Please choose Ropestic Network from metamask", "error");
                    }
                } else {
                    $.notify("Please choose owner account from metamask.", "error");
                }

            } catch (error) {
                // User denied account access...
                console.log(error);
            }
        } else if (window.web3) { // Legacy dapp browsers...
            console.log('Legacy dapp browsers...');
            window.web3 = new Web3(web3.currentProvider);
        } else { // Non-dapp browsers...
            $.notify("Browser has not Metamask extension, please add Metamask extension in your brawser.", "error");
        }
    }

    async function requestForAccessAccount() {
        if (typeof window.ethereum !== 'undefined') {
            return await window.ethereum.request({method: 'eth_requestAccounts'});
        } else {
            $.notify("Not able to locate an Ethereum connection, please install a Metamask wallet", "error");
        }
    }

    async function requestForAccessNetwork() {
        if (typeof window.ethereum !== 'undefined') {
            return await window.ethereum.request({method: 'net_version'});
        } else {
            $.notify("Not able to locate an Ethereum connection, please install a Metamask wallet", "error");
        }
    }

    async function loadContract() {
        var abi = await $.getJSON("{{ asset('assets/contract/eth_abi.json') }}");
        console.log(smartContractAddress);
        console.log(abi);
        return await new  window.web3.eth.Contract(abi,smartContractAddress);
    }
</script>
@endpush
@endsection