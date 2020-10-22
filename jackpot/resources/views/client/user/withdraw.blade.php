@extends('client.master')
@section("title")
{{ __('label.withdraw') }}
@endsection
@section("pre_styles")
    <link rel="stylesheet" href="{{ asset('Archive/css/notyf.min.css') }}">
@endsection
@section('content')

    <div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor py-3 py-xl-0"
         id="kt_content">

        <!-- begin:: Content -->

        <!-- begin:: Section -->
        <div class="kt-container kt-jackpot-container">

            <div class="row">
                <div class="col-md-12 col-xl-6">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Withdrawal Request <small>USDT</small>
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <p class="lead">When making a withdrawal, the money (USDT) will be transferred to your
                                <a href="https://wallet.elegend.io/">elegend account</a>!</p>
                            <form action="{{route("client.user.port-withdraw")}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="money">Amount USDT to withdraw</label>
                                    <input type="number" name="amount" class="form-control" id="money"
                                           placeholder="" required>
                                </div>
                                <button type="submit" class="btn btn-green">{{ __('label.submit') }}</button>
                                <a href="{{route("client.user.myRequest")}}" class="btn btn-secondary">
                                    Go to (My Request)
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("scripts")
    <script src="{{ asset('Archive/js/notyf.min.js') }}"></script>
    <script>
        var notyf = new Notyf({
            delay: 5000,
            // dismissible: false,
        });
        @if($errors->any())
        @foreach ($errors->all() as $error)
        notyf.alert('{{ $error}}');
        @endforeach
        @endif

        @if(session()->get( 'message'))
        notyf.confirm('{{ session()->get( 'message')}}');
        @endif
    </script>
@endsection
