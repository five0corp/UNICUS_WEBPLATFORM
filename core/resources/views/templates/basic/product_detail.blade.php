@extends($activeTemplate.'layouts.frontend')
@section('content')
<style>
    .bid_amount {
        padding: 19px;
    }

    .detail-main {
        margin-top: 130px;
    }

    .overlay_custom {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        display:none;
        z-index: 99;
    }
    
    .overlay_custom img {
        top: 45%;
        position: absolute;
        left: 45%;
    }

    .viewer {
        width: 550px;
        height: 550px
    }

    @media (max-width: 1150px) {
        .viewer {
            width: 500px;
            height: 500px
        }
    }

    @media (max-width: 1024px) {
        .viewer {
            width: 400px;
            height: 400px
        }
    }

    @media (max-width: 900px) {
        .viewer {
            width: 300px;
            height: 300px
        }
    }
    #social-links{
        border: 1px solid #ccc;
        display: flex;
        position: absolute;
        padding: 10px 5px 5px 5px;
        background: #fff;
        border-radius: 4px;
        display: none;
    }
    
    /* #social-links ul li {
        font-size: 20px;
        float: left;
        margin-right: 14px;
        list-style: none;
        padding-bottom: 5px;
    } */
    #social-links ul li a {
        padding: 10px;
    color: #0d6efd;
    }
    .popover-body {
        padding-top: 0px;
    }
    #share{
        cursor: pointer;
    }
</style>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
<div class="overlay_custom">
    <img src="{{ asset('assets/images/loading.gif') }}" alt="Loading..." width="40" height="40"/>
</div>
<section class="detail-main ">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-lg-5 col-md-5 col-sm-12 col-12 detail-prod ">
                @if($product->image_type=='I')
                <!--<img class="img-fluid" src="{{ getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}" alt="">-->
                <img class="img-fluid" src="{{ asset('assets/images/product').'/'.$product->glb_filename }}" alt="">
                @elseif($product->image_type=='V')
                <video style="width:100%;height:auto" controls>
                  <!--<source src="{{ asset('assets/images/product').'/'.$product->glb_filename }}" >-->
                  <source src="{{ asset('assets/images/product').'/'.$product->glb_filename }}" >
                  <!--<source src="movie.ogg" type="video/ogg">-->
                  <!--Your browser does not support the video tag.-->
                </video>
                @else
                <!--<model-viewer class="viewer" src="{{ asset('assets/images/product').'/'.$product->glb_filename }}"-->
                <!--    style="padding:10px;background:#fff;margin:auto" auto-rotate camera-controls alt="cube"-->
                <!--    background-color="#455A64"></model-viewer>-->
                <model-viewer class="viewer" id="won" camera-controls interaction-prompt="none" src="{{ asset('assets/images/product').'/'.$product->glb_filename }}" auto-rotate exposure="1.0" shadow-intensity="1" environment-image="{{ asset('assets/images/light9.jpg') }}" ar ar-modes="webxr scene-viewer quick-look" alt="A 3D model of a sphere" background-color="#455A64" camera-orbit="1.565deg 82.83deg auto" style="padding:10px;background:#fff;margin:auto">
                </model-viewer>
                @endif
            </div>
            <div class="col-xxl-7 col-lg-7 col-md-7 col-sm-12 col-12 right-detail">
                <!-- <a href="#" class="auction-b">Auction</a> -->
                <h2>{{ $product->title }} - {{ $product->sub_title }}</h2>
                <ul>
                    <!-- <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 2k</a></li>
                    <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 3k View</a></li> -->
                    <li>
                        <!-- <a href="#"> -->
                            <?php $url = route('product.detail', $product->id); ?>
                            <!-- <span class="d-inline-block" tabindex="0" data-bs-placement="right" data-bs-toggle="popover" data-bs-content="<div id='social-links'><ul><li><a href='https://www.facebook.com/sharer/sharer.php?u={{$url}}' class='social-button' ><span class='fa fa-facebook-square'></span></a></li><li><a href='https://twitter.com/intent/tweet?text=Unicus&url={{$url}}' class='social-button ' ><span class='fa fa-twitter'></span></a></li><li><a href='https://www.linkedin.com/sharing/share-offsite?mini=true&url={{$url}}&title=Unicus&summary=' class='social-button ' ><span class='fa fa-linkedin'></span></a></li><li><a target='_blank' href='https://telegram.me/share/url?url={{$url}}&text=Unicus' class='social-button ' ><span class='fa fa-telegram'></span></a></li><li><a target='_blank' href='https://wa.me/?text={{$url}}' class='social-button ' ><span class='fa fa-whatsapp'></span></a></li><li><a target='_blank' href='https://www.reddit.com/submit?title=Unicus&url={{$url}}' class='social-button ' ><span class='fa fa-reddit'></span></a></li></ul></div>" data-bs-html="true"> -->
                            <span class="d-inline-block" id="share">
                                <!-- <i class="fa fa-share-alt" aria-hidden="true"></i>  -->
                                <img src="{{ asset('assets/images/frontend/share.png') }}" class="detail-share">
                                Share &nbsp; &nbsp; 
                            </span>
                            <div id='social-links'>
                                <ul>
                                    <li><a href='https://www.facebook.com/sharer/sharer.php?u={{$url}}' class='social-button'><span class='fa fa-facebook-square'></span></a></li>
                                    <li><a href='https://twitter.com/intent/tweet?text=Unicus&url={{$url}}' class='social-button '><span class='fa fa-twitter'></span></a></li>
                                    <li><a href='https://www.linkedin.com/sharing/share-offsite?mini=true&url={{$url}}&title=Unicus&summary=' class='social-button '><span class='fa fa-linkedin'></span></a></li>
                                    <li><a target='_blank' href='https://telegram.me/share/url?url={{$url}}&text=Unicus' class='social-button '><span class='fa fa-telegram'></span></a></li>
                                    <li><a target='_blank' href='https://wa.me/?text={{$url}}' class='social-button '><span class='fa fa-whatsapp'></span></a></li>
                                    <li><a target='_blank' href='https://www.reddit.com/submit?title=Unicus&url={{$url}}' class='social-button '><span class='fa fa-reddit'></span></a></li>
                                </ul>
                            </div>
                        <!-- </a> -->
                    </li>
                    <li><a href="javascript:void(0)" id="reload-div">
                            <!-- <i class="fa fa-refresh" aria-hidden="true"></i>  -->
                            <img src="{{ asset('assets/images/frontend/reload.png') }}" class="detail-reload">
                            Refresh
                        </a></li>
                </ul>

                <div class="clearfix"></div>
                <div class="row mt-4 art-details">
                    <div class="col-xxl-2 col-lg-4 col-md-4 col-sm-4 col-6">
                        <h4>Category     </h4>
                    </div>
                    <div class="col-xxl-10 col-lg-8 col-md-8 col-sm-8 col-6">
                        <h5>{{ $product->category->name }}</h5>
                    </div>

                    <!-- <div class="col-xxl-2 col-lg-4 col-md-4 col-sm-4 col-6">
                        <h4>Last Owned by</h4>
                    </div>
                    <div class="col-xxl-10 col-lg-8 col-md-8 col-sm-8 col-6">
                        <h5>WITHRAIZ</h5>
                    </div> -->

                    <div class="col-xxl-2 col-lg-4 col-md-4 col-sm-4 col-6">
                        <h4>Collection</h4>
                    </div>
                    <div class="col-xxl-10 col-lg-8 col-md-8 col-sm-8 col-6">
                        @if($product->collection)
                        <h5>{{ $product->collection->name }}</h5>
                        @endif
                    </div>
                    <div class="col-xxl-12">
                        <!-- <div class="row"> -->
                        <?php $date=time();
                            $start_date=strtotime($product->start_date); ?>
                            @if($start_date <= $date) 
                            <div class="row bid-div">
                                <?php if ($myBid) {
                                            $status = $myBid->status;
                                            $bid_amount = $myBid->bid_amount;
                                        } else {
                                            $status = 'P';
                                        } ?>
                                @if( $product->is_start_auction == 1 && $product->is_end_auction == 0 )
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6 mt-2 pe-0">
                                    <input type="hidden" class="start_bid" value="{{ $product->start_price }}">
                                    <input type="hidden" class="current_bid" value="{{ $product->start_price }}">
                                    <input type="number" class="form-control bid_amount" id="inp_amount" placeholder="Enter bid amount">
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6 mt-2 ps-0 w100">
                                    <!-- <button type="button" class="btn btn-dark" id="place_bid" onClick="startProcess()">Place -->
                                        <!-- Bid</button> -->
                                        <a href="javascript:void(0)" id="place_bid" onClick="startProcess()">
                                            <img src="{{ asset('assets/images/frontend/basket.png') }}" width="25px" style="position: relative;bottom: 5px;">
                                            BID
                                        </a>
                                </div>
                            @endif
                            @endif

                        <!-- </div> -->
                        <!-- <a href="#">
                            <img src="{{ asset('assets/images/frontend/basket.png') }}" width="25px" style="position: relative;bottom: 5px;">
                            BID
                        </a> -->
                    </div>
                    <div class="col-xxl-12  mt-2">
                        <div class="card">
                            <h3 class="card-header" style="font-weight: bold;font-size: 18px;">
                                <!-- <i class="fa fa-line-chart" aria-hidden="true"></i> -->
                                <img src="{{ asset('assets/images/frontend/line-chart.png') }}" width="18px" style="position: relative;bottom:5px;" />
                                Bidding History
                            </h3>

                            @if ( count($biddings) > 0 )
                            <div id="" class="card-body" style="max-height: 190px;overflow-y: scroll;">
                                <table class="table table-striped bidding-table">

                                    <tr>
                                        <th>Username</th>
                                        <!--<th>Account Address</th>-->
                                        <th class="text-right">Bid Amount</th>
                                    </tr>
                                    @foreach ( $biddings as $bid )
                                    <tr>
                                        <td>
                                            {{ $bid['username'] }}
                                        </td>
                                        <!--<td>-->
                                        <!--    {{ $bid['account_address'] }}-->
                                        <!--</td>-->
                                        <td class="text-right">
                                            {{ rtrim(rtrim(sprintf('%.8F', $bid['bid_amount']), '0'), ".") }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>

                            </div>

                            @else
                            <div id="" class="card-body">
                                No record.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button detail-tab" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <!-- <i class="fa fa-tag" aria-hidden="true"></i>  -->
                                <img src="{{ asset('assets/images/frontend/price-tag.png') }}" style="width:18px;position:relative;bottom:5px;"> &nbsp;
                                About
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body detail-tab-text">
                                <?php echo $product->description; ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed detail-tab" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                <!-- <i class="fa fa-object-group" aria-hidden="true"></i>  -->
                                <img src="{{ asset('assets/images/frontend/group.png') }}" style="width:18px;position:relative;bottom:px;"> &nbsp;
                                Chain Info
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body detail-tab-text">

                                <div class="row">
                                    <div class="col-xxl-6 col-md-6 col-12">
                                        <h3>Contract Address</h3>
                                    </div>
                                    <div class="col-xxl-6 col-md-6 col-12 text-right overflow-scroll">
                                        <h3>{{config('app.smart_contract_address')}}</h3>
                                    </div>

                                    <!-- <div class="col-xxl-6">
                                        <h3>Token ID</h3>
                                    </div>
                                    <div class="col-xxl-6 text-right">
                                        <h3>{{ $product->nft_id }}</h3>
                                    </div> -->

                                    <div class="col-xxl-6 col-6">
                                        <h3>Blockchain</h3>
                                    </div>
                                    <div class="col-xxl-6 col-6 text-right">
                                        <h3>Ethereum</h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

</section>


<br><br>





@endsection
<style>
    #tooltip {
        background-color: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
</style>

@push('script')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
<script src="{{ asset('assets/templates/basic/frontend/js/countdown.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/notify.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
<script>
    "use strict";

    Echo.join(`bid`)
        .here((users) => {
            console.log('joinnnnn ' + JSON.stringify(users));
        })
        .joining((user) => {
            console.log(user.name);
        })
        .leaving((user) => {
            console.log(user.name);
        })
        .error((error) => {
            console.error(error);
        });


    Echo.private(`bidenter.{{$id}}`)
        .listen('EnterBid', (e) => {
            // data = JSON.parse(JSON.stringify(e.user));
            var data = JSON.parse(JSON.stringify(e.user));
            var product = JSON.parse(JSON.stringify(e.product));
            var amount = product.bid_amount;
            var bid_amount = parseFloat(amount).toFixed(2);
            $('.current_bid').html(bid_amount);
            $('.no_record').hide();
            var row = '<tr><td>' + data.username + '</td><td>' + bid_amount + '</td></tr>';
            $(".bidding-table tr:first").before(row);
        });
</script>
<script>
    (function($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{route('home')}}/change/" + $(this).val();
        });

        $('.countdown').each(function() {
            var countDown = $(this).data('count_down');
            $(this).countdown({
                date: countDown,
                offset: +6,
                day: 'd',
                days: 'd',
                hours: 'h',
                hour: 'h'
            });
        });
    })(jQuery);
</script>


<script>
    var symbol = "{{$product->symbol}}";;
    var accounts = "";
    var networkId = 0;
    var smartContractAddress = "{{config('app.smart_contract_address')}}";
    var tokenSmartContractAddress = "{{config('app.token_smart_contract_address')}}";
    var ownerAddress = "{{config('app.owner_address')}}";
    var assetHash = "{{$product->meta_hash}}";
    var userInput = 0;
    var basePrice = 0;
    var userId = "{{$user_id}}";
    var ropesticNetworkId = "{{config('app.network_id')}}";
    var multiplierDecimal = "{{config('app.multiplierDecimal')}}";
    var pbCount = 0;
    var pbPaymentCount = 0;
    var gasLimit = "{{config('app.gasLimit')}}";

    function startProcess() {
        if (userId == 0) {
            window.location = "{{ route('user.login') }}";
        } else {
            userInput = parseFloat($('#inp_amount').val());
            basePrice = parseFloat($('.current_bid').val());
            if (userInput > 0 && userInput >= basePrice) {
                var check = confirm("Do you want to submit this bid?")
                if (check) {
                    loadMetamask(userInput);
                }
            } else if (userInput < basePrice) {
                $.notify('Bid Amount should not be less than ' + basePrice, "error");
            } else if (assetHash == null || assetHash == "") {
                $.notify('Hash does not exist.', "error");
            } else {
                $.notify('Bid Amount should not be 0', "error");
            }
        }
    }

    async function loadMetamask(userInput) {
        if (window.ethereum) {
            window.web3 = new Web3(ethereum);
            try {
                // Request account access if needed
                accounts = await requestForAccessAccount();
                if (ownerAddress.toLowerCase() == accounts[0].toString().toLowerCase()) {
                    $.notify("Please choose another account from metamask. this is owner account", "error");
                } else {
                    networkId = await requestForAccessNetwork();
                    if (networkId + "" == ropesticNetworkId) {
                        window.contract = await loadContract();
                        if (window.contract) {
                            notifyPlaceBid(userInput);
                            if (symbol == "ETH") {
                                await placeBid(userInput);
                            } else if (symbol == "UNIC") {
                                paymentSuccessNotifyERC20();
                                await placeBidERC20(userInput);
                            } else {
                                $.notify("Sorry, you can't bid on this product.", "error");
                            }
                        } else {
                            $.notify("Smart Contract instance is not valid", "error");
                        }
                    } else {
                        $.notify("Please choose Ropestic Network from metamask", "error");
                    }
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
            return await window.ethereum.request({
                method: 'eth_requestAccounts'
            });
        } else {
            $.notify("Not able to locate an Ethereum connection, please install a Metamask wallet", "error");
        }
    }

    async function requestForAccessNetwork() {
        if (typeof window.ethereum !== 'undefined') {
            return await window.ethereum.request({
                method: 'net_version'
            });
        } else {
            $.notify("Not able to locate an Ethereum connection, please install a Metamask wallet", "error");
        }
    }

    async function loadContract() {
        var abi = await $.getJSON("{{ asset('assets/contract/eth_abi.json') }}");
        return await new window.web3.eth.Contract(abi, smartContractAddress);
    }

    async function loadContractERC20() {
        var abi = await $.getJSON("{{ asset('assets/contract/erc20_abi.json') }}");
        return await new window.web3.eth.Contract(abi, tokenSmartContractAddress);
    }

    async function placeBid(userInput) {
        $(".overlay_custom").show();
        try {
            // convert 'ether' to 'wei'
            var weiAmount = window.web3.utils.toWei(userInput.toString(), 'ether');
            return await window.contract.methods.placeBid(assetHash).send({
                from: accounts[0].toString().toLowerCase(),
                value: weiAmount,
                gasLimit: gasLimit,
                to: smartContractAddress.toLowerCase()
            });
        } catch (error) {
            $(".overlay_custom").hide();
            $.notify("Unable to place bid", "error");
            console.log("Error Code:");
            console.log(error);
        }
    }

    async function placeBidERC20(userInput) {
        $(".overlay_custom").show();
        try {
            //   var decimalMul = parseInt(userInput) * parseInt(multiplierDecimal);
            //   let tokens=web3.utils.toBN("0x"+(decimalMul).toString(16));
            var weiAmount = window.web3.utils.toWei(userInput.toString());
            var erc_contract = await loadContractERC20();
            var approveResp = await approveERC20(weiAmount, erc_contract);
            console.log("approveResp");
            console.log(approveResp);
            if (approveResp.status == true) {
                $.notify("Process approved!", "success");
                return await window.contract.methods.placeBidERC20(assetHash, weiAmount).send({
                    from: accounts[0].toString().toLowerCase(),
                    gasLimit: gasLimit,
                    to: smartContractAddress.toLowerCase()
                });
            } else {
                $(".overlay_custom").hide();
                $.notify("Process approval failed!", "error");
            }

        } catch (error) {
            $(".overlay_custom").hide();
            $.notify("Unable to place bid", "error");
            console.log("Error Code:");
            console.log(error);
        }
    }

    async function approveERC20(userInput, erc_contract) {
        try {
            return await erc_contract.methods.approve(smartContractAddress.toLowerCase(), userInput).send({
                from: accounts[0].toString().toLowerCase(),
            });
        } catch (error) {
            $(".overlay_custom").hide();
            console.log("Not approved occur error:");
            console.log(error);
        }
    }

    async function paymentSuccessNotifyERC20() {
        var productId = "{{ $id }}";
        var event = window.contract.once('ERC20PaymentSuccess', (error, result) => {
            // var event = window.contract.events.ERC20PaymentSuccess(function(error, result) {
            if (!error) {
                console.log("paymentSuccessNotifyERC20:");
                console.log(result);
                savePlaceBidPaymentDetail(productId, result);
            } else {
                $(".overlay_custom").hide();
                console.log("Error Occur in event:");
                console.log(error);
            }
        });
    }

    async function notifyPlaceBid(userInput) {
        var event = window.contract.once('BidPlaced', (error, result) => {
            // var event = window.contract.events.BidPlaced(function(error, result) {
            if (!error) {
                console.log("Notify Place Bid Event Result:");
                console.log(result);
                storeBid(userInput, result);
            } else {
                $.notify("Unable to place bid", "error");
                console.log("Error Occur in event:");
                console.log(error);
            }
        });
    }

    function savePlaceBidPaymentDetail(productId, result) {
        pbPaymentCount++;
        if (pbPaymentCount == 1) {
            var amount;
            var productId = "{{ $id }}";
            var amount = userInput;
            var url = "{{ route('savePlaceBidPaymentDetail') }}";
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                datatype: 'json',
                data: {
                    product_id: productId,
                    hash: assetHash,
                    signature: result.signature,
                    transaction_hash: result.transactionHash,
                    from_address: result.returnValues.from,
                    to_address: result.returnValues.to,
                    amount: amount,
                    block_no: result.blockNumber,
                    status: result.returnValues.success,
                },
                success: function(data) {
                    $(".overlay_custom").hide();
                }
            });
        }
    }

    function storeBid(userInput, result) {
        pbCount++;
        if (pbCount == 1) {
            var amount = userInput;
            // if(symbol == "UNIC") {
            //     amount = parseInt(result.returnValues.highestBid)/parseInt(multiplierDecimal);   
            // } else {
            //     amount = window.web3.utils.fromWei(result.returnValues.highestBid.toString(), 'ether');
            // }
            var p_id = "{{ $id }}";
            var url = "{{ route('bidNow') }}";
            var start_bid = $('.start_bid').val();
            var current_bid = parseFloat($('.current_bid').val());
            $.ajax({
                url: url,
                type: 'POST',
                datatype: 'json',
                data: {
                    amount: amount,
                    product_id: p_id,
                    hash: assetHash,
                    signature: result.signature,
                    transaction_hash: result.transactionHash,
                    account_address: result.returnValues.highestBidder,
                    from_address: result.returnValues.highestBidder,
                    to_address: result.address,
                    block_no: result.blockNumber,
                    status: true,
                },
                success: function(data) {
                    $("#inp_amount").val("");
                    $(".overlay_custom").hide();
                    if (data.status) {
                        $.notify(data.msg, "success");
                    } else {
                        $.notify(data.msg, "error");
                    }
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                }
            });
        }
    }

    $(document).on('click', '#reload-div', function() {
        location.reload();
    });

    $(document).on('click','#share',function(){
        $('#social-links').toggle();
    });
</script>
@endpush