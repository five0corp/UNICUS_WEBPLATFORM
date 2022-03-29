@extends($activeTemplate.'layouts.auth')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/global/css/font-awesome.min.css') }}">
<style>
    .google-btn {
        background: #cf4332;
        padding: 14px 30px 12px;
        border: 0px;
        color: #fff;
        margin: 10px 0px;
        width: 100%;
    }

    .preloader {
        width: 100%;
        height: 100%;
        background: #000000;
    }

    .cmn--btn {
        color: #fff;
        border-radius: 0;
        line-height: 24px;
        font-weight: 500;
        padding: 14px 30px 12px;
        background: #000000;
        border: 1px solid rgba(255, 106, 0, 0.2);
        text-transform: uppercase;
        font-size: 16px;
        overflow: hidden;
        position: relative;
        display: block;
        width: 100%;
        align-items: center;
        font-family: "Josefin Sans", sans-serif;
    }

    .account-section {
        background-color: #fff;
    }

    .account-wrapper {
        position: relative;
        z-index: 9;
        box-shadow: 0 0px 6px #ccc;
        border-radius: 0px;
    }

    .account-wrapper .left-side,
    .account-wrapper .right-side {
        background: #fff;
        color: #000;
    }

    h3,
    h4,
    h6 {
        color: #4a4a4a;
    }

    .form--label {
        color: #000;
    }

    .form--control,
    .form--control:focus {
        /* background: transparent !important; */
        outline: none;
        border: 1px solid #ccc;
        /* border-bottom: 1px solid rgba(255, 255, 255, 0.3); */
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        padding: 10px;
        height: 42px;
        color: #000;
    }

    .recent__logins .item .thumb,
    .widget {
        border: 1px dashed #0202024d;
    }

    .preloader .wellcome span,
    .specification__lists li .name,
    .text--base {
        color: #5e5e5e !important;
    }
</style>
<section class="account-section d-flex flex-wrap align-items-center justify-content-center">
    <div class="container">
        <div class="account-wrapper">
            <div class="row g-0 flex-row-reverse">
                <div class="col-lg-6 left-side">
                    <div class="account-logo">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <!-- <img src="{{ asset('assets/images/frontend/logo_wh.png') }}" alt="@lang('logo')"> -->
                                <h3 style="color:#000000">{{$general->sitename}}</h3>
                            </a>
                        </div>
                        <select class="select-bar langSel">
                            @foreach($language as $item)
                            <option value="{{$item->code}}" @if(session('lang')==$item->code) selected @endif>{{ __($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="account-header">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger background-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{{ $message }}</strong>
                                @if (session('verified'))
                                <div>
                                    <a class="a_msg" href="{{ route('web.login-email-verify',['email' => old('email')])}}">Click here to verify Your Email</a>
                                </div>
                                @endif
                            </div>
                        @endif
                        
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <h3 class="title">@lang('Sign In')</h3>
                    </div>

                    <form class="account-form" method="POST" action="{{ route('user.login')}}" onsubmit="return submitUserForm();">
                        @csrf

                        <div class="form-group">
                            <label for="username" class="form--label">@lang('Email Or Username')</label>
                            <input type="text" id="username" value="{{old('username')}}" class="form-control form--control" name="username" required="">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form--label">@lang('Password')</label>
                            <div class="position-relative">
                                <input type="password" id="password" class="form-control form--control" name="password">
                                <div class="type-change">
                                    <i class="las la-eye"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            @php echo loadReCaptcha() @endphp
                        </div>

                        @include($activeTemplate.'partials.custom_captcha')
                        <div class="d-flex flex-wrap justify-content-between">
                            <a href="{{route('user.password.request')}}" class="text--base">@lang('Forgot Password')?</a>
                        </div>
                        <div class="mt-4">
                            <button class="cmn--btn" type="submit">@lang('Sign In')</button>
                        </div>
                        <div class="text-center mt-2">or</div>
                        <div>
                            <button class="google-btn" onclick="window.location.href='{{ route('user.googleLogin') }}'"><i class="fa fa-google"></i> &nbsp; Sign In With Google</button>
                        </div>
                        <div class="mt-3">
                            @lang("Don't have an account") ? <a href="{{ route('user.register') }}" class="text--base">@lang('Create Account Now')</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 right-side d-flex flex-wrap align-items-center left-login-div">
                    <div class="w-100">
                        <div class="account-header text-center mb-3">
                            <h4 class="title mb-0">@lang('Recently Signed In')</h4>
                        </div>
                        <div class="recent__logins owl-carousel owl-theme">
                            @foreach($users as $user)
                            <div class="item">
                                <div class="thumb">
                               <?php
                               if ($user->image != "") {
                                    if(strpos($user->image,'http') !== false)
                                    {
                                    $img=$user->image;
                                    }else{
                                    $img = asset('assets/images/user/profile/' . $user->image);
                                    } 
                                }else {
                                    $img = asset('assets/images/default-user.png');
                                } ?>
                                    <img src="{{ $img }}" alt="@lang('client')">

                                </div>
                                <h6 class="name">{{$user->username}}</h6>
                            </div>
                            @endforeach
                        </div>
                        <div class="copyright mt-lg-5 mt-4 text-center">
                            &copy; {{Carbon\Carbon::now()->format('Y')}} @lang('All Right Reserved by') <a href="{{route('user.login')}}" class="text--base">Unicus</a>
                            <!-- &copy; {{Carbon\Carbon::now()->format('Y')}} @lang('All Right Reserved by') <a href="{{route('user.login')}}" class="text--base">{{$general->sitename}}</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    "use strict";

    function submitUserForm() {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
            return false;
        }
        return true;
    }
</script>
@endpush