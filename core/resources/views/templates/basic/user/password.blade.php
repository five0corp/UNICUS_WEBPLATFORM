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
                        <h3>Change Password</h3>
                    </div>
                    <div class="card-body ">
                    <form class="user-profile-form row" method="post">
                            @csrf
                            <div class="col-md-12 mb-20">
                                <label for="current_password" class="form--label mb-2">@lang('Current Password')</label>
                                <input class="form-control form--control-2 bg--body" id="current_password" type="password"  name="current_password" required="" autocomplete="">
                            </div>

                            <div class="col-md-12 mb-20 hover-input-popup">
                                <label for="current_password" class="form--label mb-2">@lang('New Password')</label>
                                <input class="form-control form--control-2 bg--body" id="current_password" type="password" name="password"  required="" autocomplete="">
                                @if($general->secure_password)
                                    <div class="input-popup">
                                        <p class="error lower">@lang('1 small letter minimum')</p>
                                        <p class="error capital">@lang('1 capital letter minimum')</p>
                                        <p class="error number">@lang('1 number minimum')</p>
                                        <p class="error special">@lang('1 special character minimum')</p>
                                        <p class="error minimum">@lang('6 character password')</p>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-20">
                                <label for="confirm_password" class="form--label mb-2">@lang('Confirm Password')</label>
                                <input class="form-control form--control-2 bg--body" id="confirm_password" type="password" name="password_confirmation" required="" autocomplete="">
                            </div>

                            <div class="col-lg-12 text-end">
                                <button type="submit" class="cmn--btn">@lang('Change Password')</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
                <br />
                <br />
            </div>

        </div>
    </div>
</section>

@endsection