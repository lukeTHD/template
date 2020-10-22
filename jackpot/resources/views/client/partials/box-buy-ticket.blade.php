<div class="box-table box-tickets">
    <form action="{{route("client.game.buy")}}" method="post" class="form-buy">
        @csrf
        <input type="hidden" name="total_price" class=""
               v-bind:value="_total_price">
        <input type="hidden" name="currency" class="" v-model="currency">
        <input type="hidden" name="game_code" class="" value="{{ $value->code }}">
        <input type="hidden" name="game_choose_number" class=""
               v-bind:value="_number_choose">
        <input type="hidden" name="is_user_dashboard" class="" value="true">
        <input type="hidden" name="game_max_number" class=""
               value="{{ $value->number_max }}">
        <input type="hidden" name="ticket_amount" class=""
               v-bind:value="_ticket_amount">
        <input type="hidden" name="type" class="" v-bind:value="_current_type">
        <input type="hidden" name="period" class="" v-bind:value="_current_period">
        <input type="hidden" name="currency" class="" v-bind:value="currency">
        <textarea name="ticket_number" class="d-none"><% _tickets_buy %></textarea>
    </form>

    <div class="box-title">
        <p class="box-title-left">{{ __('label.buy') }} {{ __('label.ticket.text') }}</p>
        <p class="box-title-right">{{ __('label.use') }} <span
                v-if="currency === 'ETI'">ETicket</span>
            <span v-else-if="currency === 'EUSDT'">USDT</span></p>
    </div>
    <div class="box-content p-3">
        {{--                           RADIO  --}}
        <div class="j-radio d-flex justify-content-center mb-3">
            <div>
                <label>
                    <input type="radio" value="ETI" v-model="currency" checked>
                    <div>
                        <img style="width: 20px;height: 20px;"
                             src="{{ asset('/assets/media/eticket.png') }}">
                        <span>ETicket</span>
                    </div>
                </label>
                <label>
                    <input type="radio" value="EUSDT" v-model="currency">
                    <div>
                        <img style="width: 20px;height: 20px;"
                             src="{{ asset('/assets/media/usdt.png') }}">
                        <span>USDT</span>
                    </div>
                </label>
            </div>
        </div>
        {{--                            <p class="text-center">Maximum ticket by USDT: 100 tickets</p>--}}
        <div class="tab-content">
            <div class="tab-pane active" id="{{ $prefix }}_kt_tabs_3_1" role="tabpanel">
                <ul class="nav nav-tabs box-nav-line nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-type="standard" data-toggle="tab"
                           href="#{{ $prefix }}_kt_tabs_2_1">{{ __('label.standard') }}</a>
                    </li>
                    @foreach($value['sacks'] as $sack)
                        <li class="nav-item">
                            <a class="nav-link" data-type="{{ $sack['value'] }}" data-toggle="tab"
                               href="#{{ $prefix }}_kt_tabs_{{ $sack['id'] }}_2">{{ $sack['value'] }}
                                {{ l(__('label.numbers')) }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="{{ $prefix }}_kt_tabs_2_1" role="tabpanel">
                        <ul class="nav nav-pills box-nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" v-bind:class="{active: _current_period == 1}"
                                   data-period="1" data-type="standard"
                                   data-toggle="tab"
                                   href="#{{ $prefix }}_kt_tabs_5_999_1">1
                                    {{ l(__('label.period')) }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" v-bind:class="{active: _current_period == 7}"
                                   data-period="7" data-type="standard"
                                   data-toggle="tab"
                                   href="#{{ $prefix }}_kt_tabs_5_1_1">7
                                    {{ l(__('label.period')) }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" v-bind:class="{active: _current_period == 14}"
                                   data-period="14" data-type="standard"
                                   data-toggle="tab"
                                   href="#{{ $prefix }}_kt_tabs_5_2_1">14 {{ l(__('label.period')) }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" v-bind:class="{active: _current_period == 28}"
                                   data-period="28" data-type="standard"
                                   data-toggle="tab"
                                   href="#{{ $prefix }}_kt_tabs_5_3_1">28 {{ l(__('label.period')) }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            {{--                                                kt_tabs_5_999_1--}}
                            <div class="tab-pane active" id="{{ $prefix }}_kt_tabs_5_999_1" role="tabpanel">
                                <div class="box-ticket">
                                    <div v-for="(ticket,ticketId) in _tickets"
                                         class="box-ticket-row">
                                        <div v-for="(number,numberId) in _number_choose"
                                             class="box-ticket-number">
                                            <button v-if="getNumber(ticketId,numberId)"
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                <% getNumber(ticketId,numberId) %>
                                                <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                            </button>
                                            <div v-else class="box-ticket-number box-ticket-blank">
                                                <button
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                    <svg width="31" height="17" viewBox="0 0 31 17"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                            fill="#EAF1FC"/>
                                                    </svg>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div v-if="getNumberChoose(ticketId) == _number_choose"
                                             v-on:click="removeTicket(ticketId)"
                                             class="box-ticket-number box-ticket-action-remove">
                                            <i class="la la-close box-ticket-circle"></i>
                                        </div>
                                        <div v-else
                                             v-on:click="autoNumbers(ticketId)"
                                             class="box-ticket-number box-ticket-action-sync">
                                            <i class="la la-refresh box-ticket-circle"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" v-on:click="addTicket()"
                                       class="more-tickets text-center mb-3 mt-4"><i
                                            class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                    </a>
                                </div>
                                <div class="box-ticket-footer">
                                    <div class="text-right">
                                        <p class="">{{ __('label.total_price') }} : <span
                                                class="kt-font-bolder"><%
                                                                _total_price %></span>
                                            <small
                                                v-if="currency === 'ETI'">ETicket</small>
                                            <small v-else-if="currency === 'EUSDT'">USDT</small>
                                        </p>
                                    </div>
                                    <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                        _total_quantity %>)
                                        {{ u(__('label.ticket._text')) }}
                                        @if(session('language') === 'en')
                                            <span v-if="_total_quantity > 1">( s )</span>
                                        @endif
                                    </button>
                                    <div class="d-flex mt-3 mb-5 justify-content-center">
                                        <a class="l-text"
                                           href="">{{ __('label.term_and_policy') }}</a>
                                        <span class="l-text mx-3">|</span>
                                        <a class="l-text" href="">{{ __('label.need_help') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="{{ $prefix }}_kt_tabs_5_1_1" role="tabpanel">
                                <div class="box-ticket">
                                    <div v-for="(ticket,ticketId) in _tickets"
                                         class="box-ticket-row">
                                        <div v-for="(number,numberId) in _number_choose"
                                             class="box-ticket-number">
                                            <button v-if="getNumber(ticketId,numberId)"
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                <% getNumber(ticketId,numberId) %>
                                                <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                            </button>
                                            <div v-else class="box-ticket-number box-ticket-blank">
                                                <button
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                    <svg width="31" height="17" viewBox="0 0 31 17"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                            fill="#EAF1FC"/>
                                                    </svg>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div v-if="getNumberChoose(ticketId) == _number_choose"
                                             v-on:click="removeTicket(ticketId)"
                                             class="box-ticket-number box-ticket-action-remove">
                                            <i class="la la-close box-ticket-circle"></i>
                                        </div>
                                        <div v-else
                                             v-on:click="autoNumbers(ticketId)"
                                             class="box-ticket-number box-ticket-action-sync">
                                            <i class="la la-refresh box-ticket-circle"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" v-on:click="addTicket()"
                                       class="more-tickets text-center mb-3 mt-4"><i
                                            class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                    </a>
                                </div>
                                <div class="box-ticket-footer">
                                    <div class="text-right">
                                        <p class="">{{ __('label.total_price') }} : <span
                                                class="kt-font-bolder"><%
                                                                _total_price %></span>
                                            <small
                                                v-if="currency === 'ETI'">ETicket</small>
                                            <small v-else-if="currency === 'EUSDT'">USDT</small>
                                        </p>
                                    </div>
                                    <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                        _total_quantity %>)
                                        {{ u(__('label.ticket._text')) }}
                                        @if(session('language') === 'en')
                                            <span v-if="_total_quantity > 1">( s )</span>
                                        @endif
                                    </button>
                                    <div class="d-flex mt-3 mb-5 justify-content-center">
                                        <a class="l-text"
                                           href="">{{ __('label.term_and_policy') }}</a>
                                        <span class="l-text mx-3">|</span>
                                        <a class="l-text" href="">{{ __('label.need_help') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="{{ $prefix }}_kt_tabs_5_2_1" role="tabpanel">
                                <div class="box-ticket">
                                    <div v-for="(ticket,ticketId) in _tickets"
                                         class="box-ticket-row">
                                        <div v-for="(number,numberId) in _number_choose"
                                             class="box-ticket-number">
                                            <button v-if="getNumber(ticketId,numberId)"
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                <% getNumber(ticketId,numberId) %>
                                                <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                            </button>
                                            <div v-else class="box-ticket-number box-ticket-blank">
                                                <button
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                    <svg width="31" height="17" viewBox="0 0 31 17"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                            fill="#EAF1FC"/>
                                                    </svg>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div v-if="getNumberChoose(ticketId) == _number_choose"
                                             v-on:click="removeTicket(ticketId)"
                                             class="box-ticket-number box-ticket-action-remove">
                                            <i class="la la-close box-ticket-circle"></i>
                                        </div>
                                        <div v-else
                                             v-on:click="autoNumbers(ticketId)"
                                             class="box-ticket-number box-ticket-action-sync">
                                            <i class="la la-refresh box-ticket-circle"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" v-on:click="addTicket()"
                                       class="more-tickets text-center mb-3 mt-4"><i
                                            class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                    </a>
                                </div>
                                <div class="box-ticket-footer">
                                    <div class="text-right">
                                        <p class="">{{ __('label.total_price') }} : <span
                                                class="kt-font-bolder"><%
                                                                _total_price %></span>
                                            <small
                                                v-if="currency === 'ETI'">ETicket</small>
                                            <small v-else-if="currency === 'EUSDT'">USDT</small>
                                        </p>
                                    </div>
                                    <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                        _total_quantity %>)
                                        {{ u(__('label.ticket._text')) }}
                                        @if(session('language') === 'en')
                                            <span v-if="_total_quantity > 1">( s )</span>
                                        @endif
                                    </button>
                                    <div class="d-flex mt-3 mb-5 justify-content-center">
                                        <a class="l-text"
                                           href="">{{ __('label.term_and_policy') }}</a>
                                        <span class="l-text mx-3">|</span>
                                        <a class="l-text" href="">{{ __('label.need_help') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="{{ $prefix }}_kt_tabs_5_3_1" role="tabpanel">
                                <div class="box-ticket">
                                    <div v-for="(ticket,ticketId) in _tickets"
                                         class="box-ticket-row">
                                        <div v-for="(number,numberId) in _number_choose"
                                             class="box-ticket-number">
                                            <button v-if="getNumber(ticketId,numberId)"
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                <% getNumber(ticketId,numberId) %>
                                                <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                            </button>
                                            <div v-else class="box-ticket-number box-ticket-blank">
                                                <button
                                                    type="button"
                                                    class="box-ticket-circle tooltip">
                                                    <svg width="31" height="17" viewBox="0 0 31 17"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                            fill="#EAF1FC"/>
                                                        <path
                                                            d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                            fill="#EAF1FC"/>
                                                    </svg>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div v-if="getNumberChoose(ticketId) == _number_choose"
                                             v-on:click="removeTicket(ticketId)"
                                             class="box-ticket-number box-ticket-action-remove">
                                            <i class="la la-close box-ticket-circle"></i>
                                        </div>
                                        <div v-else
                                             v-on:click="autoNumbers(ticketId)"
                                             class="box-ticket-number box-ticket-action-sync">
                                            <i class="la la-refresh box-ticket-circle"></i>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" v-on:click="addTicket()"
                                       class="more-tickets text-center mb-3 mt-4"><i
                                            class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                    </a>
                                </div>
                                <div class="box-ticket-footer">
                                    <div class="text-right">
                                        <p class="">{{ __('label.total_price') }} : <span
                                                class="kt-font-bolder"><%
                                                                _total_price %></span>
                                            <small
                                                v-if="currency === 'ETI'">ETicket</small>
                                            <small v-else-if="currency === 'EUSDT'">USDT</small>
                                        </p>
                                    </div>
                                    <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                        _total_quantity %>)
                                        {{ u(__('label.ticket._text')) }}
                                        @if(session('language') === 'en')
                                            <span v-if="_total_quantity > 1">( s )</span>
                                        @endif
                                    </button>
                                    <div class="d-flex mt-3 mb-5 justify-content-center">
                                        <a class="l-text"
                                           href="">{{ __('label.term_and_policy') }}</a>
                                        <span class="l-text mx-3">|</span>
                                        <a class="l-text" href="">{{ __('label.need_help') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($value['sacks'] as $sack)
                        <div class="tab-pane" id="{{ $prefix }}_kt_tabs_{{ $sack['id'] }}_2" role="tabpanel">
                            <ul class="nav nav-pills box-nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link"
                                       v-bind:class="{active: _current_period == 1}" data-period="1"
                                       data-type="{{ $sack['value'] }}"
                                       data-toggle="tab"
                                       href="#{{ $prefix }}_kt_tabs_5_999_2_{{ $sack['id'] }}">1
                                        {{ l(__('label.period')) }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       v-bind:class="{active: _current_period == 7}" data-period="7"
                                       data-type="{{ $sack['value'] }}"
                                       data-toggle="tab"
                                       href="#{{ $prefix }}_kt_tabs_5_1_2_{{ $sack['id'] }}">7
                                        {{ l(__('label.period')) }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       v-bind:class="{active: _current_period == 14}"
                                       data-period="14"
                                       data-type="{{ $sack['value'] }}"
                                       data-toggle="tab"
                                       href="#{{ $prefix }}_kt_tabs_5_2_2_{{ $sack['id'] }}">14 {{ l(__('label.period')) }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       v-bind:class="{active: _current_period == 28}"
                                       data-period="28"
                                       data-type="{{ $sack['value'] }}"
                                       data-toggle="tab"
                                       href="#{{ $prefix }}_kt_tabs_5_3_2_{{ $sack['id'] }}">28 {{ l(__('label.period')) }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="{{ $prefix }}__5_999_2_{{ $sack['id'] }}"
                                     role="tabpanel">
                                    <div class="box-ticket">
                                        <div v-for="(ticket,ticketId) in _tickets"
                                             class="box-ticket-row">
                                            <div v-for="(number,numberId) in _number_choose"
                                                 class="box-ticket-number">
                                                <button v-if="getNumber(ticketId,numberId)"
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                    <% getNumber(ticketId,numberId) %>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                                <div v-else
                                                     class="box-ticket-number box-ticket-blank">
                                                    <button
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                        <svg width="31" height="17"
                                                             viewBox="0 0 31 17"
                                                             fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                                fill="#EAF1FC"/>
                                                        </svg>
                                                        <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- test-- -->
                                            <div
                                                v-if="_number_choose < game_choose"
                                                v-for="i in (game_choose - _number_choose)"
                                                class="box-ticket-number">
                                                <div class="box-ticket-circle bg-disabled">
                                                    <svg width="31" height="17" viewBox="0 0 31 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.67134 14.1547H4.15991L8.98931 14.9345L8.75611 15.2003H6.19598L8.44017 15.5614L7.47981 16.6622L27.1284 16.5669L30.3179 12.911L10.6718 13.0063L9.67134 14.1547Z" fill="#F5F9FF"/>
                                                        <path d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z" fill="#F5F9FF"/>
                                                        <path d="M10.1979 1.42174L9.99233 1.65744H7.21405L9.64881 2.05111L8.16187 3.75369L27.8104 3.6584L30.9999 0L11.3539 0.0977923L10.905 0.611824H5.17798L10.1979 1.42174Z" fill="#F5F9FF"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div v-if="getNumberChoose(ticketId) == _number_choose"
                                                 v-on:click="removeTicket(ticketId)"
                                                 class="box-ticket-number box-ticket-action-remove">
                                                <i class="la la-close box-ticket-circle"></i>
                                            </div>

                                            <div v-else
                                                 v-on:click="autoNumbers(ticketId)"
                                                 class="box-ticket-number box-ticket-action-sync">
                                                <i class="la la-refresh box-ticket-circle"></i>
                                            </div>

                                        </div>
                                        <a href="javascript:void(0);" v-on:click="addTicket()"
                                           class="more-tickets text-center mb-3 mt-4"><i
                                                class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                        </a>
                                    </div>
                                    <div class="box-ticket-footer">
                                        <div class="text-right">
                                            <p class="">{{ __('label.total_price') }} : <span
                                                    class="kt-font-bolder"><%
                                                                _total_price %></span>
                                                <small
                                                    v-if="currency === 'ETI'">ETicket</small>
                                                <small v-else-if="currency === 'EUSDT'">USDT</small>
                                            </p>
                                        </div>
                                        <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                            _total_quantity %>)
                                            {{ u(__('label.ticket._text')) }}
                                            @if(session('language') === 'en')
                                                <span v-if="_total_quantity > 1">( s )</span>
                                            @endif
                                        </button>
                                        <div class="d-flex mt-3 mb-5 justify-content-center">
                                            <a class="l-text"
                                               href="">{{ __('label.term_and_policy') }}</a>
                                            <span class="l-text mx-3">|</span>
                                            <a class="l-text"
                                               href="">{{ __('label.need_help') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="{{ $prefix }}_kt_tabs_5_1_2_{{ $sack['id'] }}"
                                     role="tabpanel">
                                    <div class="box-ticket">
                                        <div v-for="(ticket,ticketId) in _tickets"
                                             class="box-ticket-row">
                                            <div v-for="(number,numberId) in _number_choose"
                                                 class="box-ticket-number">
                                                <button v-if="getNumber(ticketId,numberId)"
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                    <% getNumber(ticketId,numberId) %>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                                <div v-else
                                                     class="box-ticket-number box-ticket-blank">
                                                    <button
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                        <svg width="31" height="17"
                                                             viewBox="0 0 31 17"
                                                             fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                                fill="#EAF1FC"/>
                                                        </svg>
                                                        <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- test-- -->
                                            <div
                                                v-if="_number_choose < game_choose"
                                                v-for="i in (game_choose - _number_choose)"
                                                class="box-ticket-number">
                                                <div class="box-ticket-circle bg-disabled">
                                                    <svg width="31" height="17" viewBox="0 0 31 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.67134 14.1547H4.15991L8.98931 14.9345L8.75611 15.2003H6.19598L8.44017 15.5614L7.47981 16.6622L27.1284 16.5669L30.3179 12.911L10.6718 13.0063L9.67134 14.1547Z" fill="#F5F9FF"/>
                                                        <path d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z" fill="#F5F9FF"/>
                                                        <path d="M10.1979 1.42174L9.99233 1.65744H7.21405L9.64881 2.05111L8.16187 3.75369L27.8104 3.6584L30.9999 0L11.3539 0.0977923L10.905 0.611824H5.17798L10.1979 1.42174Z" fill="#F5F9FF"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div v-if="getNumberChoose(ticketId) == _number_choose"
                                                 v-on:click="removeTicket(ticketId)"
                                                 class="box-ticket-number box-ticket-action-remove">
                                                <i class="la la-close box-ticket-circle"></i>
                                            </div>

                                            <div v-else
                                                 v-on:click="autoNumbers(ticketId)"
                                                 class="box-ticket-number box-ticket-action-sync">
                                                <i class="la la-refresh box-ticket-circle"></i>
                                            </div>

                                        </div>
                                        <a href="javascript:void(0);" v-on:click="addTicket()"
                                           class="more-tickets text-center mb-3 mt-4"><i
                                                class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                        </a>
                                    </div>
                                    <div class="box-ticket-footer">
                                        <div class="text-right">
                                            <p class="">{{ __('label.total_price') }} : <span
                                                    class="kt-font-bolder"><%
                                                                _total_price %></span>
                                                <small
                                                    v-if="currency === 'ETI'">ETicket</small>
                                                <small v-else-if="currency === 'EUSDT'">USDT</small>
                                            </p>
                                        </div>
                                        <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                            _total_quantity %>)
                                            {{ u(__('label.ticket._text')) }}
                                            @if(session('language') === 'en')
                                                <span v-if="_total_quantity > 1">( s )</span>
                                            @endif
                                        </button>
                                        <div class="d-flex mt-3 mb-5 justify-content-center">
                                            <a class="l-text"
                                               href="">{{ __('label.term_and_policy') }}</a>
                                            <span class="l-text mx-3">|</span>
                                            <a class="l-text"
                                               href="">{{ __('label.need_help') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="{{ $prefix }}_kt_tabs_5_2_2_{{ $sack['id'] }}"
                                     role="tabpanel">
                                    <div class="box-ticket">
                                        <div v-for="(ticket,ticketId) in _tickets"
                                             class="box-ticket-row">
                                            <div v-for="(number,numberId) in _number_choose"
                                                 class="box-ticket-number">
                                                <button v-if="getNumber(ticketId,numberId)"
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                    <% getNumber(ticketId,numberId) %>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                                <div v-else
                                                     class="box-ticket-number box-ticket-blank">
                                                    <button
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                        <svg width="31" height="17"
                                                             viewBox="0 0 31 17"
                                                             fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                                fill="#EAF1FC"/>
                                                        </svg>
                                                        <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- test-- -->
                                            <div
                                                v-if="_number_choose < game_choose"
                                                v-for="i in (game_choose - _number_choose)"
                                                class="box-ticket-number">
                                                <div class="box-ticket-circle bg-disabled">
                                                    <svg width="31" height="17" viewBox="0 0 31 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.67134 14.1547H4.15991L8.98931 14.9345L8.75611 15.2003H6.19598L8.44017 15.5614L7.47981 16.6622L27.1284 16.5669L30.3179 12.911L10.6718 13.0063L9.67134 14.1547Z" fill="#F5F9FF"/>
                                                        <path d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z" fill="#F5F9FF"/>
                                                        <path d="M10.1979 1.42174L9.99233 1.65744H7.21405L9.64881 2.05111L8.16187 3.75369L27.8104 3.6584L30.9999 0L11.3539 0.0977923L10.905 0.611824H5.17798L10.1979 1.42174Z" fill="#F5F9FF"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div v-if="getNumberChoose(ticketId) == _number_choose"
                                                 v-on:click="removeTicket(ticketId)"
                                                 class="box-ticket-number box-ticket-action-remove">
                                                <i class="la la-close box-ticket-circle"></i>
                                            </div>

                                            <div v-else
                                                 v-on:click="autoNumbers(ticketId)"
                                                 class="box-ticket-number box-ticket-action-sync">
                                                <i class="la la-refresh box-ticket-circle"></i>
                                            </div>

                                        </div>
                                        <a href="javascript:void(0);" v-on:click="addTicket()"
                                           class="more-tickets text-center mb-3 mt-4"><i
                                                class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                        </a>
                                    </div>
                                    <div class="box-ticket-footer">
                                        <div class="text-right">
                                            <p class="">{{ __('label.total_price') }} : <span
                                                    class="kt-font-bolder"><%
                                                                _total_price %></span>
                                                <small
                                                    v-if="currency === 'ETI'">ETicket</small>
                                                <small v-else-if="currency === 'EUSDT'">USDT</small>
                                            </p>
                                        </div>
                                        <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                            _total_quantity %>)
                                            {{ u(__('label.ticket._text')) }}
                                            @if(session('language') === 'en')
                                                <span v-if="_total_quantity > 1">( s )</span>
                                            @endif
                                        </button>
                                        <div class="d-flex mt-3 mb-5 justify-content-center">
                                            <a class="l-text"
                                               href="">{{ __('label.term_and_policy') }}</a>
                                            <span class="l-text mx-3">|</span>
                                            <a class="l-text"
                                               href="">{{ __('label.need_help') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="{{ $prefix }}_kt_tabs_5_3_2_{{ $sack['id'] }}"
                                     role="tabpanel">
                                    <div class="box-ticket">
                                        <div v-for="(ticket,ticketId) in _tickets"
                                             class="box-ticket-row">
                                            <div v-for="(number,numberId) in _number_choose"
                                                 class="box-ticket-number">
                                                <button v-if="getNumber(ticketId,numberId)"
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                    <% getNumber(ticketId,numberId) %>
                                                    <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                </button>
                                                <div v-else
                                                     class="box-ticket-number box-ticket-blank">
                                                    <button
                                                        type="button"
                                                        class="box-ticket-circle tooltip">
                                                        <svg width="31" height="17"
                                                             viewBox="0 0 31 17"
                                                             fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.67128 14.1547H4.15985L8.98925 14.9345L8.75605 15.2003H6.19592L8.44011 15.5614L7.47975 16.6622L27.1283 16.5669L30.3178 12.911L10.6718 13.0063L9.67128 14.1547Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z"
                                                                fill="#EAF1FC"/>
                                                            <path
                                                                d="M10.198 1.42174L9.99239 1.65744H7.21411L9.64887 2.05111L8.16193 3.75369L27.8105 3.6584L31 0L11.3539 0.0977923L10.9051 0.611824H5.17804L10.198 1.42174Z"
                                                                fill="#EAF1FC"/>
                                                        </svg>
                                                        <span class="tooltiptext">
                                                                        <div class="ticket-to-choose">
                                                                            <div class="ticket-number"
                                                                                 v-for="number in numbersArray()"
                                                                            >
                                                                                <span
                                                                                    v-if="!getTicket(ticketId).includes(number == getNumber(ticketId,numberId) ? null : number)"
                                                                                    v-on:click="setNumber(ticketId,numberId,number)"

                                                                                    v-bind:class="{'bg-danger text-white border-danger': getNumber(ticketId,numberId) == number}"
                                                                                    class="d-block">
                                                                                    <% number %>
                                                                                </span>
                                                                                <span v-else
                                                                                      class="bg-dark text-white border-dark">
                                                                                    <% number %>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- test-- -->
                                            <div
                                                v-if="_number_choose < game_choose"
                                                v-for="i in (game_choose - _number_choose)"
                                                class="box-ticket-number">
                                                <div class="box-ticket-circle bg-disabled">
                                                    <svg width="31" height="17" viewBox="0 0 31 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.67134 14.1547H4.15991L8.98931 14.9345L8.75611 15.2003H6.19598L8.44017 15.5614L7.47981 16.6622L27.1284 16.5669L30.3179 12.911L10.6718 13.0063L9.67134 14.1547Z" fill="#F5F9FF"/>
                                                        <path d="M22.9609 10.3884L26.1504 6.73254L6.50439 6.82783L5.96027 7.45219H0L5.22307 8.2947L5.04755 8.49781H2.03607L4.67393 8.92408L3.31237 10.4837L22.9609 10.3884Z" fill="#F5F9FF"/>
                                                        <path d="M10.1979 1.42174L9.99233 1.65744H7.21405L9.64881 2.05111L8.16187 3.75369L27.8104 3.6584L30.9999 0L11.3539 0.0977923L10.905 0.611824H5.17798L10.1979 1.42174Z" fill="#F5F9FF"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div v-if="getNumberChoose(ticketId) == _number_choose"
                                                 v-on:click="removeTicket(ticketId)"
                                                 class="box-ticket-number box-ticket-action-remove">
                                                <i class="la la-close box-ticket-circle"></i>
                                            </div>

                                            <div v-else
                                                 v-on:click="autoNumbers(ticketId)"
                                                 class="box-ticket-number box-ticket-action-sync">
                                                <i class="la la-refresh box-ticket-circle"></i>
                                            </div>

                                        </div>
                                        <a href="javascript:void(0);" v-on:click="addTicket()"
                                           class="more-tickets text-center mb-3 mt-4"><i
                                                class="la la-plus mr-2"></i>{{ __('label.more_tickets') }}
                                        </a>
                                    </div>
                                    <div class="box-ticket-footer">
                                        <div class="text-right">
                                            <p class="">{{ __('label.total_price') }} : <span
                                                    class="kt-font-bolder"><%
                                                                _total_price %></span>
                                                <small
                                                    v-if="currency === 'ETI'">ETicket</small>
                                                <small v-else-if="currency === 'EUSDT'">USDT</small>
                                            </p>
                                        </div>
                                        <button class="l-button-buy">{{ u(__('label.buy')) }} (<%
                                            _total_quantity %>)
                                            {{ u(__('label.ticket._text')) }}
                                            @if(session('language') === 'en')
                                                <span v-if="_total_quantity > 1">( s )</span>
                                            @endif
                                        </button>
                                        <div class="d-flex mt-3 mb-5 justify-content-center">
                                            <a class="l-text"
                                               href="">{{ __('label.term_and_policy') }}</a>
                                            <span class="l-text mx-3">|</span>
                                            <a class="l-text"
                                               href="">{{ __('label.need_help') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane" id="{{ $prefix }}_kt_tabs_3_3" role="tabpanel">
                <!-- Tab -->
            </div>
        </div>
    </div>
</div>
