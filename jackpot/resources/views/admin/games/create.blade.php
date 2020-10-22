@extends('admin.layouts.app')
@section('content')
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
            <div class="kt-portlet__body">
                <form class="kt-form" action="{{ route('admin.games.store') }}" method="POST" id="kt_form"
                      enctype="multipart/form-data">
                    @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                    @include('admin.partials.alert')
                    @csrf
                    <textarea name="sacks" v-model="sacksJson" class="form-control d-none"></textarea>
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.game.info') }}:</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.game.type') }}</label>
                                        <div class="col-9">
                                            <div class="row">
                                                <div class="col-2">
                                                    <select name="number_pick" v-model="number_pick"
                                                            class="selectpicker form-control" data-live-search="true">
                                                        @for($i = 1;$i <= 99; $i++)
                                                            <option @if(old('number_pick') == $i) selected="selected"
                                                                    @endif value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    <p class="lead text-center mb-0" style="margin-top: 6px;">
                                                        X
                                                    </p>
                                                </div>
                                                <div class="col-2">
                                                    <select name="number_max" v-model="number_max"
                                                            class="selectpicker form-control" data-live-search="true">
                                                        @for($i = 1;$i <= 99; $i++)
                                                            <option @if(old('number_max') == $i) selected="selected"
                                                                    @endif  value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.name') }}</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="name"
                                                   value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.avatar') }}</label>
                                        <div class="col-9">
                                            <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                                <div class="kt-avatar__holder" style=""></div>
                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                                       data-original-title="Change avatar">
                                                    <i class="fa fa-pen"></i>
                                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                                </label>
                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                                                      data-original-title="Cancel avatar">
																				<i class="fa fa-times"></i>
																			</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.description') }}</label>
                                        <div class="col-9">
                                            <textarea name="description" rows="5"
                                                      class="form-control">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.sack') }}</label>
                                        <div class="col-9">
                                            <button class="btn btn-sm btn-outline-secondary mr-2 btn-sack" type="button"
                                                    v-for="sack in sacks" v-on:click="deleteSack(sack)">
                                                <span class="btn-sack-text"><% sack %></span>
                                                <span class="btn-sack-close"><i class="la la-close text-danger m-0"></i></span>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success ml-0" type="button"
                                                    data-toggle="modal" data-target="#kt_modal_5"><i
                                                    class="la la-plus m-0"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.code') }}</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="code"
                                                   value="{{ old('code') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.algorithm') }}</label>
                                        <div class="col-9">
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" value="random"
                                                           name="algorithm"> Random
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio">
                                                    <input type="radio" value="option"
                                                           name="algorithm"> Option
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.ticket.price') }}</label>
                                        <div class="col-9">
                                            <input type="number" class="form-control" name="price"
                                                   value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.minimum_ticket') }}</label>
                                        <div class="col-9">
                                            <input type="number" class="form-control" name="minimum_ticket"
                                                   value="{{ old('minimum_ticket') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.ticket.limit') }}</label>
                                        <div class="col-9">
                                            <input type="number" class="form-control" name="ticket_limit"
                                                   value="{{ old('ticket_limit') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.game_start_at') }}</label>
                                        <div class="col-9">
                                            <div class="input-group timepicker">
                                                <input class="form-control" name="start_time" id="kt_timepicker_2_"
                                                       readonly
                                                       placeholder="Chọn thời gian" value="00:00:00"
                                                       type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.game_end_at') }}</label>
                                        <div class="col-9">
                                            <div class="input-group timepicker">
                                                <input class="form-control" name="roll_time" id="kt_timepicker_2__"
                                                       readonly
                                                       placeholder="Chọn thời gian" value="23:55:00"
                                                       type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">{{ __('label.game_appear_at') }}</label>
                                        <div class="col-9">
                                            <div class="input-group timepicker">
                                                <input class="form-control" name="appear_time" id="kt_timepicker_2"
                                                       readonly
                                                       placeholder="Chọn thời gian" value="23:57:00"
                                                       type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-3 col-form-label">{{ __('label.status') }}</label>
                                        <div class="col-9">
                                            <select name="status" class="selectpicker">
                                                <option @if(old('status') == '1') selected
                                                        @endif value="1">{{ __('label.available') }}</option>
                                                <option @if(old('status') == '0') selected
                                                        @endif value="0">{{ __('label.unavailable') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="kt-section">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.setting_before_start') }}
                                        :</h3>
                                    <div class="form-group form-group-last row">
                                        <textarea name="rewards" v-model="itemsJson" class="form-control d-none"
                                                  rows="10"></textarea>
                                        <div class="col-12">
                                            <table class="table mb-0">
                                                <thead>
                                                <tr>
                                                    <th width="40%">{{ __('label.name_prize') }}</th>
                                                    <th width="40%">% {{ __('label.percent_for_crate') }} ( <span
                                                            v-bind:class="{ 'text-danger': (percent < 0 | percent > 100) }"
                                                            v-text="percent"></span> % )
                                                    </th>
                                                    <th width="10%">{{ __('label.win_if_same') }}</th>
                                                    <th width="10%"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="sortable-game">
                                                <tr v-for="(item,key) in items">
                                                    <td class="g-col-1">
                                                        <input type="text" class="form-control" v-model="item.name">
                                                    </td>
                                                    <td class="g-col-2">
                                                        <input type="text" class="form-control"
                                                               v-model="item.value_percent">
                                                    </td>
                                                    <td class="g-col-3">
                                                        <select v-model="item.number" class="form-control">
                                                            <option v-for="n in +number_pick" v-bind:value="n"><% n %>
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="g-col-4 text-right">
                                                        <div class="btn-group">
                                                            {{-- <button type="button" data-toggle="modal"
                                                                     data-target="#modal_config"
                                                                     v-on:click="configReward(key)"
                                                                     class="btn btn-sm btn-outline-secondary"
                                                                     style="padding: 0.65rem 1rem;">
                                                                 <i class="la la-cog m-0"></i>
                                                             </button>--}}
                                                            <button type="button" v-on:click="addItem()"
                                                                    class="btn btn-sm btn-primary"
                                                                    v-if="key + 1 === items.length"
                                                                    style="padding: 0.65rem 1rem;">
                                                                <i class="la la-plus m-0"></i>
                                                            </button>
                                                            <button type="button" v-on:click="removeItem(key)"
                                                                    class="btn btn-sm btn-danger" v-else
                                                                    style="padding: 0.65rem 1rem;">
                                                                <i class="la la-trash m-0"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="kt-section kt-section--last">
                                {{--<div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.setting_income') }}
                                        :</h3>
                                    <div class="form-group form-group-last row">
                                        <div class="col-12">
                                            @foreach($game_setting_code as $_game_setting_code)
                                                <div
                                                    class="form-group row @if($_game_setting_code['code'] === 'parent-2') form-group-last @endif">
                                                    <label
                                                        class="col-3 col-form-label">{{ __('label.'.$_game_setting_code['title']) }}</label>
                                                    <div class="col-9">
                                                        <div class="input-group timepicker">
                                                            <input class="form-control"
                                                                   name="share[{{ $_game_setting_code['code'] }}]"
                                                                   type="number"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.setting_commission') }}
                                        :</h3>
                                    <div class="form-group form-group-last row">
                                        <div class="col-12">
                                            @foreach($game_setting_code as $_game_setting_code)
                                                <div
                                                    class="form-group row @if($_game_setting_code['code'] === 'parent-2') form-group-last @endif">
                                                    <label
                                                        class="col-3 col-form-label">{{ __('label.'.$_game_setting_code['title']) }} </label>
                                                    <div class="col-9">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="input-group">
                                                                    <input class="form-control"
                                                                           name="share[{{ $_game_setting_code['code'] }}][value]"
                                                                           type="number"
                                                                           value=""/>
                                                                    <div class="input-group-append"><span
                                                                            class="input-group-text"><i
                                                                                class="fa fa-sm fa-percent"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($_game_setting_code['code'] !== 'parent' && $_game_setting_code['code'] !== 'parent-2')

                                                                <div class="col-3">
                                                                    <div class="input-group">
                                                                        <select
                                                                            name="share[{{ $_game_setting_code['code'] }}][currency]"
                                                                            class="form-control">
                                                                            @foreach(config('constants.currency') as $key => $value)
                                                                                <option
                                                                                    value="{{ $key }}">{{$value}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="input-group-append"><span
                                                                                class="input-group-text"><i
                                                                                    class="fa fa-sm fa-money-bill"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-6">
                                                                    <div class="d-flex align-items-center h-100">
                                                                        <p class="mb-0">5 Cash / 3 ePoint / 2 eTicket</p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($_game_setting_code['code'] === 'company')
                                                                <div class="col-6">
                                                                    <div class="input-group">
                                                                        <input class="form-control"
                                                                               name="share[{{ $_game_setting_code['code'] }}][ssoId]"
                                                                               type="text"
                                                                        />
                                                                        <div class="input-group-append"><span
                                                                                class="input-group-text kt-font-boldest">SSO ID</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                    <!--begin::Modal-->
                    {{--<div class="modal fade" id="modal_config" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cấu hình phần thưởng ( <span
                                            v-bind:class="{ 'text-danger': (percentConfig < 0 | percentConfig > 100) }"
                                            v-text="percentConfig"></span> % )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Số % chuyển sang hũ Jackpot mới</label>
                                        <input type="text" v-model="currentItem.share_new" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Số % chuyển sang công ty</label>
                                        <input type="text" v-model="currentItem.share_company" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Số % chuyển sang tuyến trên trực tiếp</label>
                                        <input type="text" v-model="currentItem.share_up" class="form-control">
                                    </div>
                                    <div class="form-group form-group-last">
                                        <label>Số % chuyển sang tuyến trên cấp 2</label>
                                        <input type="text" v-model="currentItem.share_level_2" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('label.close') }}</button>
                                    --}}{{--                                    <button type="button" class="btn btn-primary"> {{ __('label.save') }}</button>--}}{{--
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('label.select_sack') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group form-group-last">
                                        <label for="recipient-name" class="form-control-label">{{ __('label.value') }}
                                            :</label>
                                        <select v-model="sackValue" class="form-control" data-live-search="true">
                                            <option v-for="n in +number_pick" v-bind:value="n"><% n %></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('label.close') }}</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                            v-on:click="addSack()">{{ __('label.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Modal-->
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/pages/custom/user/profile.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
    @include('admin.partials.scripts.game')
@endsection
