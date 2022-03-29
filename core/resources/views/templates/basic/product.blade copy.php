@extends($activeTemplate . 'layouts.frontend')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/main.css') }}" />

<section>
    <div class="container-fluid">
        <div class="row artwoks">
            <div class="i-header ">
                <h4>Artworks</h4>
            </div>
        </div>
    </div>
</section>

<!-- <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6 text-right type-d">
                <select class="form-select " aria-label="Default select example">
                    <option selected>Type</option>
                    <option value="1">Photo</option>
                    <option value="2">3D</option>
                    <option value="3">Painting</option>
                    <option value="4">Video</option>
                </select>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-6">
                <div class="search "> <i class="fa fa-search"></i> <input type="text" class="form-control search-product" placeholder="Search by artworks name"> </div>
            </div>
        </div>

    </div>
</section> -->
<section>
    <div class=" pad-5">
        <div class="row mt-1 p-2">
            <div class="col-6">
                <h3 class="mt-1">Artwork</h3>
            </div>
            <div class="col-4 offset-2">
            <div class="search "> <i class="fa fa-search"></i> <input type="text" class="form-control search-product" placeholder="Search by artworks name"> </div>
            </div>
        </div>
    </div>
</section>


<section class=" pad-5">
    <div class="container-fluid ">
        <div class="row product-list">

            @include('templates.basic.product-list',[$products,$totalProducts,$loaded])

        </div>

        <div class="loadmore-div text-center mt-3">
            <?php if ($totalProducts > $loaded) { ?>
                <botton class="btn btn-light loadmore">Load More</botton>
            <?php } ?>
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="{{ asset('assets/templates/basic/frontend/js/countdown.min.js') }}"></script>

    <script>
        "use strict";
        $('.staffCountdown').each(function() {
            var finalDate = $(this).data('count_down');
            $(this).countdown({
                date: finalDate,
                offset: +6,
                day: 'd',
                days: 'd',
                hours:'h',
                hour:'h'
            });
        });

        $('.categoryType').on('click', function(){
            this.form.submit();
        });

        $('.brandType').on('click', function(){
            this.form.submit();
        });

        $('.sortType').on('change', function(){
            this.form.submit();
        });

        // @if(session()->has('range'))
        //     var data1 = {{session('range')[0]}};
        //     var data2 = {{session('range')[1]}};
        // @else
        //     var data1 = 0;
        //     var data2 = {{$general->search_max}};
        // @endif

        // $( "#slider-range" ).slider({
        //     range:true,
        //     min:0,
        //     max:{{$general->search_max}},
        //     values: [data1, data2],
        //     slide: function( event, ui ) {
        //       $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        //     }
        // });
        // $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $( "#slider-range").slider( "values", 1));
    </script>
@endpush
@push('script')
<script>
    page = 1;
    $(document).on('keyup', '.search-product', function() {
        url = "{{ route('product') }}";
        search = $(this).val();
        $.ajax({
            url: url,
            type: 'GET',
            datatype: 'json',
            data: {
                ajax: 'yes',
                search: search
            },
            success: function(data) {
                if (data.status == 200) {
                    if (data.view != "") {
                        $('.product-list').html(data.view);
                        if (data.totalProducts == data.loaded) {
                            $('.loadmore').hide();
                        } else {
                            $('.loadmore').show();
                        }
                    } else {
                        $('.product-list').html("<h4 class='text-center mt-4'>No record found.</h4>");
                    }

                }
            },
            error: function(data) {

            }
        });
    });
    var thats;
    $(document).on('click', '.loadmore', function() {
        url = "{{ route('product') }}";
        page = page + 1;
        $.ajax({
            url: url,
            type: 'GET',
            datatype: 'json',
            data: {
                ajax: 'yes',
                page: page
            },
            success: function(data) {
                if (data.status == 200) {

                    if (data.view != "") {
                        $('.product-list').append(data.view);
                        if (data.totalProducts == data.loaded) {
                            $('.loadmore').hide();
                            // getCounter()
                            
                            var cur;
                            var kakku;
                            var count = 0;
                            // $.each(data.view,function(){

                            // });
                            $(data.view).find('.counter').each(function(){
                                    // var count = getCounterData($(this));
                                    var vId=$(this).attr('id');
                                    thats=this;
                                    cur=$(this);
                                    
                                    var days = parseInt($('.e-m-days', thats).val());
                                    var hours = parseInt($('.e-m-hours', thats).text());
                                    var minutes = parseInt($('.e-m-minutes', thats).text());
                                    var seconds = parseInt($('.e-m-seconds', thats).text());
                                   
                                    
                                    count = seconds + (minutes * 60) + (hours * 3600) + (days * 3600 * 24);
                                    
                                     console.log('aaaa '+count);
                                    var timer = setInterval(function() {
                                        count--;
                                        if (count == 0) {
                                            clearInterval(timer);
                                            return;
                                        }
                                        // setCounterData(count, $(this));
                                        // console.log('count '+count);
                                        //var days = Math.floor(count / (3600 * 24));
                                        var hours = Math.floor((count % (60 * 60 * 24)) / (3600));
                                        var minutes = Math.floor((count % (60 * 60)) / 60);
                                        var seconds = Math.floor(count % 60);
                                        // console.log('aaaabbb '+days);
                                        // console.log(cur);
                                        // cur.find('.e-m-seconds').html(seconds);
                                        // console.log(days, hours, minutes, seconds);
                                        hours = (days * 24) + hours;
                                        // console.log('bbbb '+vId);
                                        // $('.e-m-days', obj).html(days);
                                        $('#'+vId+' .e-m-hours').html(hours);
                                        $('#'+vId+' .e-m-minutes').html(minutes);
                                       $('#'+vId+' .e-m-seconds').html(seconds);

                                    //     $('.e-m-hours', thats).html(hours);
                                    //     $('.e-m-minutes', thats).html(minutes);
                                    //    $('.e-m-seconds',thats).html(seconds);
                                        // $('.e-m-seconds',that).html(seconds);
                                        // cur.find('e-m-seconds').html(seconds);
                                        

                                    }, 1000);
                            });
                            // alert($(data.view));
                        }
                    } else {
                        $('.loadmore').hide();
                        //$('.product-list').html("<h4 class='text-center mt-4'> No record found.</h4>");
                    }

                }
            },
            error: function(data) {

            }
        });
    });

    $(document).ready(function(){
        // function myFunc(obj,count) {
        //    getCounter();
    });

    // function getCounter(){
    //     $('.counter').each(function() {
    //         // var count = getCounterData($(this));
    //         var days = parseInt($('.e-m-days', this).val());
    //         var hours = parseInt($('.e-m-hours', this).text());
    //         var minutes = parseInt($('.e-m-minutes', this).text());
    //         var seconds = parseInt($('.e-m-seconds', this).text());
    //         var count= seconds + (minutes * 60) + (hours * 3600) + (days * 3600 * 24);
    //         var that=this;
    //         //  alert(count);
    //         var timer = setInterval(function() {
    //             count--;
    //             if (count == 0) {
    //                 clearInterval(timer);
    //                 return;
    //             }
    //             // setCounterData(count, $(this));

    //             var days = Math.floor(count / (3600 * 24));
    //             var hours = Math.floor((count % (60 * 60 * 24)) / (3600));
    //             var minutes = Math.floor((count % (60 * 60)) / 60);
    //             var seconds = Math.floor(count % 60);

    //             // console.log(days, hours, minutes, seconds);
    //             hours = (days * 24) + hours;
    //             // $('.e-m-days', obj).html(days);
    //             $('.e-m-hours', that).html(hours);
    //             $('.e-m-minutes', that).html(minutes);
    //             $('.e-m-seconds', that).html(seconds);

    //         }, 1000);
    //     });
    // }

</script>
@endpush