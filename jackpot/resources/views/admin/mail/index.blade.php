@extends('admin.layouts.app')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-mail"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.mail') }} </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                    </button>
                </div>
            </div>
            <div class="kt-portlet__body">
                <button type="button" class="btn btn-sm btn-secondary mb-3 toggle" data-toggle="des">Show help</button>
                <div class="user-info-wrap mb-3 mt-0" id="des" style="display: none;">
                    <div class="row">
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@TICKET_ID@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                ID of the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@AMOUNT@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Amount of the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@GAME_NAME@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Game's name of the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@PRICE@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Price of the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@QUALITY@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Quantity of the booking
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@TICKET@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Numbers choose of the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@CUSTOMERNAME@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Customer name, who buy the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@EMAIL@</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Customer email, who buy the ticket
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="row-user-info">
                                <div class="left">
                                    <span class="word-break kt-font-dark kt-font-md">@PHONE</span>
                                </div>
                                <div class="right">
                            <span class="word-break kt-font-md">
                                Phone number
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.mail.update') }}" id="kt_form" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="mail" class="summernote" id="kt_summernote_1">
                        {!! setting('mail_html')->value !!}
                    </textarea>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.summernote').summernote();
            @if(session()->has('message'))
            toastr.success('{{ session('message') }}','{{ __('label.success') }} !');
            @endif
        });
    </script>
@endsection
