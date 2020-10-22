@extends('admin.layouts.app')
@section('content')
    <?php
    $id = param('ticket');
    $ticket = api(['api.tickets.show', ['id' => $id]]);
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-plus"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">{{ __('label.game.add') }} </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" onclick="submit('kt_form')" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">{{ __('label.save') }}</span>
                    </button>
                </div>
            </div>
            <div class="kt-portlet__body" id="app">
                <form class="kt-form" method="POST" id="kt_form">
                    @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                    @include('admin.partials.alert')
                    @csrf
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--last">
                                <div class="kt-section__body">
                                    <div class="form-group mb-2 row">
                                        <div class="col-12">
                                            <!--begin::Portlet-->
                                            <div
                                                class="kt-portlet kt-portlet--solid-secondary kt-portlet--height-fluid">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label">
                                                        {{--                                                        <span class="kt-portlet__head-icon"><i class="flaticon2-paper"></i></span>--}}
                                                        <h3 class="kt-portlet__head-title">{{ __('label.ticket.info') }}
                                                        </h3>
                                                    </div>
                                                    <div class="kt-portlet__head-toolbar">
                                                        <?php
                                                        $status = 'warning';
                                                        $text = __('label.ticket.status')[trim($ticket['status'])];
                                                        if ($ticket['status'] === 'create') {
                                                            $status = 'warning';
                                                        } else if ($ticket['status'] === 'failed') {
                                                            $status = 'danger';
                                                        } else if ($ticket['status'] === 'success') {
                                                            $status = 'success';
                                                        }
                                                        ?>
                                                        <span
                                                            class="kt-badge kt-badge--unified-{{ $status }} kt-badge--lg kt-badge--inline kt-badge--bold">{{ u($text) }}</span>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body">
                                                    <div class="kt-portlet__content">
                                                        <div class="form-group row">
                                                            <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                                            <div class="col-9">
                                                                <label
                                                                    class="kt-font-bolder col-form-label"><a
                                                                        class="text-dark"
                                                                        href="{{ route('admin.users.edit',['user' => $ticket['user']['id']]) }}">{{ $ticket['user']['name'] }}</a></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-3 col-form-label">{{ __('label.ticket.price') }}</label>
                                                            <div class="col-9">
                                                                <label
                                                                    class="kt-font-bolder col-form-label text-dark">{{ numberFormat($ticket['price']) }}
                                                                    <span
                                                                        class="text-muted">{{ $ticket['currency'] }}</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-3 col-form-label">{{ __('label.game._text') }}</label>
                                                            <div class="col-9">
                                                                <label
                                                                    class="kt-font-bolder text-dark col-form-label">
                                                                    <a
                                                                        class="text-dark"
                                                                        href="{{ route('admin.games.edit',['game' => $ticket['game']['id']]) }}">{{ $ticket['game']['name']}}
                                                                    </a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @if($ticket['status'] === 'success')
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-3 col-form-label">{{ __('label.prize') }}</label>
                                                                <div class="col-9">
                                                                    <label
                                                                        class="kt-font-bolder text-success col-form-label">
                                                                        + {{ numberFormat($ticket['prize_value']) }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-3 col-form-label">{{ __('label.won_prize') }}</label>
                                                                <div class="col-9">
                                                                    <label
                                                                        class="kt-font-bolder text-dark col-form-label">
                                                                        {{ $ticket['prize']['title'] }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-3 col-form-label">{{ __('label.type') }}</label>
                                                            <div class="col-9">
                                                                <label
                                                                    class="kt-font-bolder col-form-label text-dark">{{ uf($ticket['type']) }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-last row">
                                                            <label
                                                                class="col-3 col-form-label">{{ __('label.choose_number') }}</label>
                                                            <div class="col-9">
                                                                <div class="tickets-preview">
                                                                    <?php
                                                                    $picked = $ticket['picked'];
                                                                    ?>
                                                                    @foreach($picked as $pick)
                                                                        @if($ticket['status'] === 'success')
                                                                            <div
                                                                                style="width: {{ 100 / count($picked) }}%;">
                                                                                <p class="mb-0 @if(in_array($pick,$ticket['lottery']['numbers'])) bg-success text-white @endif">
                                                                                    {{ $pick }}
                                                                                </p>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                style="width: {{ 100 / count($picked) }}%;">
                                                                                <p class="mb-0">
                                                                                    {{ $pick }}
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end::Portlet-->
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <div class="col-12">
                                            <button type="button" v-on:click="loadTickets()"
                                                    class="btn btn-elevated btn-info w-100"><i class="la la-search"></i>
                                                {{ __('label.ticket_same_booking') }}
                                            </button>
                                        </div>
                                        <div class="col-12" style="margin-top: 23px;" v-if="loaded">
                                            <table v-if="tickets.length > 0" class="table table-bordered" id="kt_load">
                                                <thead>
                                                <tr>
                                                    <th>Ticket</th>
                                                    <th>Buy time</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Value</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="ticket in tickets">
                                                    <td>
                                                        <a v-bind:href="detailTicket(ticket.id)">
                                                            <span class="mr-1" v-for="picked in ticket.picked"><% picked %></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <% ticket.created_at %>
                                                    </td>
                                                    <td>
                                                        <% ticket.type %>
                                                    </td>
                                                    <td>
                                                        <% ticket.status %>
                                                    </td>
                                                    <td>
                                                        <% ticket.price %>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div v-else>
                                                <p class="mb-0 text-center">{{ __('label.no_ticket') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script>
        var EDIT_URL = '{{ route('admin.tickets.edit',':id') }}';

        axios.interceptors.request.use(function (config) {
            KTApp.block("#kt_load", {});
            return config;
        }, function (error) {
            // Do something with request error
            KTApp.block("#kt_load", {});
            return Promise.reject(error);
        });

        new Vue({
            el: '#app',
            delimiters: ['<%', '%>'],
            data: {
                tickets: [],
                loaded: false
            },
            methods: {
                loadTickets: async function () {
                    this.loaded = true;
                    var response = (await axios.get('{{ route('api.bookings.show',['booking' => $ticket['booking_id']]) }}'))['data'];
                    if (response.status === true) {
                        this.tickets = response.data.tickets.filter(function (value) {
                            return value.id != {{ $id }}
                        });
                        KTApp.unblock("#kt_load");
                    }
                },
                detailTicket: function (id) {
                    return EDIT_URL.replace(':id', id);
                }
            },
            computed: {}
        })
    </script>
@endsection
