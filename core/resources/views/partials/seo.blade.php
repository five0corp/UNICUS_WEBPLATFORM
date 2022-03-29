@if($seo)
    <meta name="title" Content="{{ $general->sitename(__($pageTitle)) }}">
    <meta name="description" content="">
    <meta name="keywords" content="{{ implode(',',$seo->keywords) }}">
    <link rel="shortcut icon" href="{{ getImage(imagePath()['logoIcon']['path'] .'/fv.png') }}" type="image/x-icon">

    {{--<!-- Apple Stuff -->--}}
    <link rel="apple-touch-icon" href="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ $general->sitename($pageTitle) }}">

    <meta itemprop="name" content="{{ $general->sitename($pageTitle) }}">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="{{ asset('assets/images/frontend/logo_wh.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="UNICUS : 3D NFT Platform">
    <meta property="og:description" content="">
    <meta property="og:image" content="http://test.art-unic.com/assets/images/frontend/logo_wh.png"/>
<!--    <meta property="og:image:type" content="image/{{ pathinfo(getImage(imagePath()['logoIcon']['path']) .'/logo.png')['extension'] }}" />-->

<!--    @php $social_image_size = explode('x', imagePath()['seo']['size']) @endphp-->
<!--    <meta property="og:image:width" content="{{ $social_image_size[0] }}" />-->
<!--    <meta property="og:image:height" content="{{ $social_image_size[1] }}" />-->
<!--    <meta property="og:url" content="{{ url()->current() }}">-->

<!--    <meta name="twitter:card" content="summary_large_image">-->
<!--@endif-->
