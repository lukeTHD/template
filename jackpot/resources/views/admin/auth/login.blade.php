@extends('admin.layouts.auth')
@section("title")
    LOGIN
@endsection
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

        <!--begin::Body-->
        <div class="kt-login__body">

            <!--begin::Signin-->
            <div class="kt-login__form">
                <div class="kt-login__title">
                    <h3>Sign In</h3>
                </div>

                <!--begin::Form-->
                <form class="kt-form" action="{{ route('admin.auth.login') }}" method="POST" novalidate="novalidate" id="kt_login_form">
                    @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Username" name="email"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="password"
                               autocomplete="off">
                    </div>

                    <!--begin::Action-->
                    <div class="kt-login__actions">
                        <a href="#" class="kt-link kt-login__link-forgot">
                            Forgot Password ?
                        </a>
                        <button id="kt_login_signin_submit" class="btn btn-dark btn-elevate kt-login__btn-primary">
                            Sign In
                        </button>
                    </div>

                    <!--end::Action-->
                </form>

                <!--end::Form-->
            </div>

            <!--end::Signin-->
        </div>

        <!--end::Body-->
    </div>
@endsection
