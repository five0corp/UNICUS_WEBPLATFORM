@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="mrg-top35">
    <div class="container-fluid">
        <div class="row  ">
            <div class="col-xxl-2 list-left-main   mt-4 p-0">
                @include('templates.basic.partials.dashboard-sidebar')
            </div>
            <div class="col-xxl-10 w-bg  my-wallet ">
                <div class="card b-radius--10 ">
                    <div class="card-header">
                        <h3>Profile Setting</h3>
                    </div>
                    <div class="card-body ">
                        <!-- <div class="mb-4 d-xl-none text-end">
                            <div class="sidebar__init">
                                <i class="las la-columns"></i>
                            </div>
                        </div> -->
                        <div class="row pt-60 gy-5">
                            <div class="col-lg-4">
                                <div class="user--thumb h-100">
                                    <div class="thumb">
                                        @if(strpos($user->image,'http') !== false)
                                        <img src="{{ $user->image }}" alt="@lang('client')">
                                        @else
                                        <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" alt="@lang('client')">
                                        @endif
                                    </div>
                                    <h6 class="name">{{__($user->email)}}</h6>
                                    <span class="info">{{__($user->username)}}</span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="profle-wrapper ">
                                    <form class="user-profile-form row" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12 mb-20">
                                            <label for="username" class="form--label mb-2">@lang('Username')</label>
                                            <input class="form-control form--control-2 bg--body" id="username" type="text" name="username" value="{{$user->username}}" readonly>
                                        </div>
                                        <!-- <div class="col-md-12 mb-20">
                                        <label for="fname" class="form--label mb-2">@lang('Name')</label>
                                        <input class="form-control form--control-2 bg--body" id="fname" type="text" name="firstname" value="{{$user->firstname}} {{$user->lastname}}" required="">
                                    </div> -->
                                        <!-- <div class="col-md-6 mb-20">
                                        <label for="lname" class="form--label mb-2">@lang('Last Name')</label>
                                        <input class="form-control form--control-2 bg--body" id="lname" type="text" name="lastname" value="{{$user->lastname}}" required="">
                                    </div> -->
                                        <!-- <div class="col-md-6 mb-20">
                                        <label for="phone" class="form--label mb-2">@lang('Phone')</label>
                                        <input class="form-control form--control-2 bg--body" id="phone" name="mobile" type="text" value="{{$user->mobile}}" required="">
                                    </div> -->
                                        <div class="col-md-12 mb-20">
                                            <label for="email" class="form--label mb-2">@lang('Email Address')</label>
                                            <input class="form-control form--control-2 bg--body" id="email" name="email" type="text" value="{{$user->email}}" readonly>
                                        </div>

                                        <!-- <div class="col-md-12 mb-20">
                                        <label for="address" class="form--label mb-2">@lang('Address')</label>
                                        <input class="form-control form--control-2 bg--body" id="address" name="address" type="text" value="{{@$user->address->address}}" required="">
                                    </div> -->

                                        <!-- <div class="col-md-6 mb-20">
                                        <label for="state" class="form--label mb-2">@lang('State')</label>
                                        <input class="form-control form--control-2 bg--body" id="state" name="state" type="text" value="{{@$user->address->state}}" required="">
                                    </div>

                                    <div class="col-md-6 mb-20">
                                        <label for="city" class="form--label mb-2">@lang('Town/City')</label>
                                        <input class="form-control form--control-2 bg--body" id="city" name="city" type="text" value="{{@$user->address->city}}" required="">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label for="zip" class="form--label mb-2">@lang('Postcode/ZIP')</label>
                                        <input class="form-control form--control-2 bg--body" id="zip" name="zip" type="text" value="{{@$user->address->zip}}" required="">
                                    </div> -->
                                        <div class="col-md-12 mb-20">
                                            <label for="file" class="form--label mb-2">@lang('Update Profile Photos')</label>
                                            <input class="form-control form--control-2 bg--body" type="file" id="file" name="image">
                                        </div>
                                        <div class="col-lg-12 text-end">
                                            <button type="submit" class="cmn--btn">@lang('Update Profile')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <br />
                <br />
            </div>

        </div>
    </div>
</section>

@endsection
@push('style-lib')
    <link href="{{ asset($activeTemplateTrue.'css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endpush
@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100% !important;
        }
    </style>
@endpush