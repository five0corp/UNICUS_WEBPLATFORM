@extends($activeTemplate.'layouts.frontend')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/main.css') }}" />
<!-- <section>
    <div class="container ">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mt-3">
                <h5>{{ $product->title }}</h5>
            </div>

        </div>
</section> -->
<style>
    .bid_amount{
        padding:10px;
    }
    .viewer{
        width:550px;
        height:550px
    }
    @media (max-width: 1150px) {
        .viewer{
        width:500px;
        height:500px
    }
    }
    @media (max-width: 1024px) {
        .viewer{
        width:400px;
        height:400px
    }
    }
    @media (max-width: 900px) {
        .viewer{
        width:300px;
        height:300px
    }
    }
</style>
<section class="pad-5">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mt-3">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-3 text-center img-viewer-div">
                        @if($product->image_type=='N')
                        <img class="img-fluid" src="{{ getImage(imagePath()['product']['path'].'/'.$product->image,imagePath()['product']['size'])}}" alt="">
                        @else
                        <model-viewer class="viewer" src="{{ asset('assets/images/product').'/'.$product->glb_image }}" style="padding:10px;background:#fff;margin:auto" auto-rotate camera-controls alt="cube" background-color="#455A64"></model-viewer>
                        @endif
                    </div>
                    <div class="col-12  mt-3 mb-3">
                        <div class="artwork-about">
                            <!-- <h3><i class="fa fa-arrows-alt" aria-hidden="true"></i> About the {{ $product->title }}</h3>
                            <h5 class="m-3">{{ $product->sub_title }}</h5> -->
                            <p><?php echo $product->description; ?></p>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mt-5 auction-main">
                <h2>{{ $product->title }} - {{ $product->sub_title }}</h2>
                <div class="row mt-3 left-prod-detail">
                    <div class="col-12">
                        <h3 class="detail-curr-bid mt-3">{{ $currentBid_amount }} USD</h3>
                    </div>
                   
                    
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12  mt-2">

                        <input type="hidden" id="end_date" value="{{ strtotime($product->end_date)}}">
                        <?php $date=time();
                            $start_date=strtotime($product->start_date);
                            if($start_date > $date){ ?>
                                <h3 class="text-center mt-3" style="color:black">Comming Soon</h3>
                                <!-- <p class="text-center">on</p> -->
                                <h5 class="text-center mt-2">{{showDateTime($product->start_date, 'd M, Y')}}</h5>
                            <?php }else{ ?>
                        <div class="countdown-area p-1">
                            <!-- <p>Bidding ending in</p> -->
                            <ul class="countdown" data-count_down="{{showDateTime($product->end_date, 'Y/m/d h:i:s')}}">
                                <li>
                                    <div class="countdown__title"><span class="days">@lang('00')</span></div>
                                    <span class="days_text">@lang('d')</span>
                                </li>
                                <li>
                                    <div class="countdown__title"><span class="hours">@lang('00')</span></div>
                                    <span class="hours_text">@lang('h')</span>
                                </li>
                                <li>
                                    <div class="countdown__title"><span class="minutes">@lang('00')</span></div>
                                    <span class="minu_text">@lang('m')</span>
                                </li>
                                <li>
                                    <div class="countdown__title"><span class="seconds">@lang('00')</span></div>
                                    <span class="seco_text">@lang('s')</span>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                    @if($start_date < $date)
                    <div class="ps-0 pt-3 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 contract-info">
                        <div ><h6>Contract : NAN</h6></div>
                        <div><h6>IPFS : NAN</h6></div>
                    </div>
                    @endif
                </div>

                  @if($start_date <= $date)
                    <div class="row bid-div">
                        <?php if ($myBid) {
                            $status = $myBid->status;
                            $bid_amount = $myBid->bid_amount;
                        } else {
                            $status = 'P';
                        } ?>
                        @if($status=='P')
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6 mt-2 pe-0">
                            <input type="hidden" class="start_bid" value="{{ $product->start_price }}">
                            <input type="hidden" class="current_bid" value="{{ $currentBid_amount }}">
                            <input type="text" class="form-control bid_amount" placeholder="Enter bid amount">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6 mt-2 ps-0 w100">
                            <button type="button" class="btn btn-dark" id="place_bid">Place Bid</button>
                        </div>
                        @else
                        <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-7 mt-2">
                        <input type="hidden" class="form-control" name="amount" value="{{ $myBid->bid_amount }}" id="inp_amount" aria-describedby="helpId">
                            <div class="alert alert-success">You won this item for ${{ $myBid->bid_amount }} USD</div>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-5 mt-3 w100">
                            <button type="button" class="btn btn-dark" onClick="startProcess()" id="pay_now">Pay Now</button>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
                            <h5>History</h5>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 text-center" style="height: 300px;overflow-y: scroll;">

                            <table class="table  bidding-table">
                                <!-- <tr class="table-dark">
                                    <th>User</th>
                                    <th>Bid Amount</th>
                                </tr> -->
                                @if($biddings->count()>0)
                                @foreach($biddings as $bid)
                                <tr>
                                    <td> {{ $bid->user->username }}</td>
                                    <td> {{ $bid->bid_amount}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="2" class="no_record">No record found</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    @endif
            </div>


        </div>
    </div>
</section>






@endsection


@push('script')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
<script src="{{ asset('assets/templates/basic/frontend/js/countdown.min.js') }}"></script>
<script>
    "use strict";


    $(document).on('click', '#place_bid', function() {
        var amount = $('.bid_amount').val();
        var p_id = "{{ $id }}";
        var url = "{{ route('bidNow') }}";
        var start_bid = $('.start_bid').val();
        var current_bid = $('.current_bid').val();
        if (amount == "") {
            alert('Please enter bid amount.');
        } else {
            if (amount >= parseInt(current_bid)) {
                if (amount >= parseInt(start_bid)) {
                    $('.bid_amount').val('');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        datatype: 'json',
                        data: {
                            amount: amount,
                            product_id: p_id
                        },
                        success: function(data) {
                            if (data.status == 400) {
                                window.location = "{{ route('user.login') }}";
                            } else {
                                var bid_amount = parseFloat(amount).toFixed(2);
                                $('.no_record').hide();
                                if (data.bid_status == 'P') {
                                    $('.current_bid').val(bid_amount);
                                    // var row = '<tr><td>' + data.username + '</td><td>' + bid_amount + '</td></tr>';
                                    // $(".bidding-table tr:first").after(row);
                                } else {
                                    var html = '<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-7 mt-2">' +
                                        '<div class="alert alert-success">You won this item for $' + bid_amount + ' USD</div>' +
                                        '</div>' +
                                        '<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-5 mt-3 w100">' +
                                        '<button type="button" class="btn btn-dark" onClick="startProcess()" id="pay_now">Pay Now</button>' +
                                        '</div>';
                                    $('.bid-div').html(html)
                                }
                            }
                        }
                    });
                } else {
                    alert('amount must be greater than ' + start_bid);
                }
            } else {
                alert('amount must be greater than ' + current_bid);
            }
        }

    });

    

    // $(function() {
    //     function getCounterData(obj) {
    //         var days = parseInt($('.e-m-days', obj).val());
    //         var hours = parseInt($('.e-m-hours', obj).text());
    //         var minutes = parseInt($('.e-m-minutes', obj).text());
    //         var seconds = parseInt($('.e-m-seconds', obj).text());
    //         return seconds + (minutes * 60) + (hours * 3600) + (days * 3600 * 24);
    //     }

    //     function setCounterData(s, obj) {
    //         var days = Math.floor(s / (3600 * 24));
    //         var hours = Math.floor((s % (60 * 60 * 24)) / (3600));
    //         var minutes = Math.floor((s % (60 * 60)) / 60);
    //         var seconds = Math.floor(s % 60);

    //         // console.log(days, hours, minutes, seconds);
    //         hours = (days * 24) + hours;
    //         // $('.e-m-days', obj).html(days);
    //         $('.e-m-hours', obj).html(hours);
    //         $('.e-m-minutes', obj).html(minutes);
    //         $('.e-m-seconds', obj).html(seconds);
    //     }

    //     var count = getCounterData($(".counter"));

    //     var timer = setInterval(function() {
    //         count--;
    //         if (count == 0) {
    //             clearInterval(timer);
    //             return;
    //         }
    //         setCounterData(count, $(".counter"));
    //     }, 1000);
    // });


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

            console.log('alert done');
        });
</script>
<script>

$(document).ready(function(){
        // if ($(window).width() < 700) {
        //     var width=$('.img-viewer-div').outerWidth();
        //     $('.viewer').css({'width':"100%", "height":width});
        // }
    });

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
                hours:'h',
                hour:'h'
            });
        });
    })(jQuery);
</script>


<script>
        function startProcess() {
            if ($('#inp_amount').val() > 0) {
                // run metamsk functions here
                EThAppDeploy.loadEtherium();
            } else {
                alert('Please Enter Valid Amount');
            }
        }


        EThAppDeploy = {
            loadEtherium: async () => {
                if (typeof window.ethereum !== 'undefined') {
                    EThAppDeploy.web3Provider = ethereum;
                    EThAppDeploy.requestAccount(ethereum);
                } else {
                    alert(
                        "Not able to locate an Ethereum connection, please install a Metamask wallet"
                    );
                }
            },
            /****
             * Request A Account
             * **/
            requestAccount: async (ethereum) => {
                ethereum
                    .request({
                        method: 'eth_requestAccounts'
                    })
                    .then((resp) => {
                        //do payments with activated account
                        EThAppDeploy.payNow(ethereum, resp[0]);
                    })
                    .catch((err) => {
                        // Some unexpected error.
                        console.log(err);
                    });
            },
            /***
             *
             * Do Payment
             * */
            payNow: async (ethereum, from) => {
                var amount = $('#inp_amount').val();
                ethereum
                    .request({
                        method: 'eth_sendTransaction',
                        params: [{
                            from: from,
                            to: "0x6cA0323B6DB3bbC5331614b1E5aFf01C0b1771d6",
                            value: '0x' + ((amount * 1000000000000000000).toString(16)),
                        }, ],
                    })
                    .then((txHash) => {
                        if (txHash) {
                            console.log(txHash);
                            storeTransaction(txHash, amount);
                        } else {
                            console.log("Something went wrong. Please try again");
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        }
        /***
         *
         * @param Transaction id
         *
         */
        function storeTransaction(txHash, amount) {
            $.ajax({
                url: "{{ route('metamask.transaction.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    txHash: txHash,
                    amount: amount,
                },
                success: function (response) {
                    // reload page after success
                    window.location.reload();
                }
            });
        }

    </script>
@endpush