    @extends('admin.layouts.app')
@section('content')
    <?php
    $users = api('api.users.index');
    $games = api('api.games.index');
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
            <div class="kt-portlet__body">
                <form class="kt-form" action="{{ route('admin.tickets.store') }}" method="POST" id="kt_form">
                    @include('admin.partials.error',['class' =>  'rounded-0 d-block'])
                    @include('admin.partials.alert')
                    @csrf
                    <textarea name="picked" v-if="picked.length > 0 " v-model="pickJson" class="d-none"></textarea>
                    <input type="hidden" v-if="pickedSack" v-model="pickedSack" name="sack">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--first" v-bind:class="{'kt-section--last':game_id === 0}">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __('label.ticket.info') }}
                                        :</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Tên người mua</label>
                                        <div class="col-9">
                                            <select name="uid" data-live-search="true"
                                                    class="form-control selectpicker">
                                                <option value="">Không chọn người mua</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-3 col-form-label">Trò chơi</label>
                                        <div class="col-9">
                                            <select v-on:change="changeGame($event)" name="game_id" data-live-search="true"
                                                    class="form-control selectpicker">
                                                <option value="0">Chọn trò chơi</option>
                                                @foreach($games as $game)
                                                    <option value="{{ $game['id'] }}">{{ $game['code'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"
                                 v-if="game_id !== 0"></div>
                            <div class="kt-section kt-section--last" v-if="game_id !== 0">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Chọn số
                                        :</h3>
                                    <p class="lead text-center kt-font-bolder">Số bạn đã chọn <span v-if="pickedSack"
                                                                                                    class="text-muted"><small>( bao <% pickedSack %> )</small></span>
                                    </p>
                                    <div class="tickets-preview mb-5">
                                        <div v-for="n in max" v-bind:style="{ width: percentBox }">
                                            <p v-text="getNumber(n)">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <div class="tickets">
                                            <div class="ticket-action">
                                                <div class="ticket-action-text kt-font-bolder" v-for="b in sacks"
                                                     v-on:click="pickSack(b)" v-bind:class="{active: b === pickedSack}">
                                                    Bao <% b %>
                                                </div>
                                            </div>
                                            <div class="ticket-pick">
                                                <div class="ticket-numbers">
                                                    <div class="ticket-number" v-for="number in numbers">
                                                        <div class="kt-font-bolder" v-on:click="pickNumber(number)"
                                                             v-bind:class="{active: isExists(number)}">
                                                            <% number %>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script>
        var URL_DETAIL = '{{ route('api.games.show',':id') }}';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script>
        new Vue({
            el: '#kt_form',
            delimiters: ['<%', '%>'],
            data: {
                numbers: [],
                picked: [],
                game_id: 0,
                max: 0,
                sacks: [],
                pickedSack: null,
                game: {}
            },
            methods: {
                pickNumber: function (number) {
                    if (this.isExists(number)) this.picked = this.picked.filter(function (value) {
                        return number !== value;
                    });
                    else {
                        if (this.picked.length >= this.max) {
                            alert('You only can pick ' + this.max + ' numbers');
                        } else {
                            this.picked.push(number);
                        }
                    }
                },
                isExists: function (number) {
                    var item = this.picked.filter(function (value) {
                        return value === number;
                    });
                    return item.length === 1;
                },
                pickSack: function (number) {
                    this.picked = [];
                    if (number === this.pickedSack) {
                        if (this.game_id) {
                            this.max = this.game.number_pick;
                        }
                        this.pickedSack = null;
                    } else {
                        this.max = number;
                        this.pickedSack = number
                    }
                    ;
                },
                getNumber: function (index) {
                    return this.picked[index - 1];
                },
                changeGame: async function (event) {
                    this.reset();
                    var id = event.target.value;
                    this.game_id = +id;
                    if (id) {
                        var url = URL_DETAIL.replace(':id', id);
                        try {
                            var response = await axios.get(url);
                            if (response.data.status) {
                                var data = response.data.data[0];
                                var sacks = [];
                                for(let sack of data.sacks) {
                                    sacks.push(sack.value);
                                }
                                this.game = data;
                                this.sacks = sacks;
                                this.max = data.number_pick;
                                this.numbers = Array.from(Array(data.number_max), (_, i) => i + 1);
                            } else {
                                this.game_id = 0;
                            }
                        } catch (e) {
                            console.log(e);
                        }
                    }
                },
                reset: function () {
                    this.numbers = [];
                    this.picked = [];
                    this.game_id = 0;
                    this.sacks = [];
                    this.max = 0;
                    this.pickedSack = null;
                    this.game = {};
                }
            },
            computed: {
                percentBox: function () {
                    var percent = 100 / this.max;
                    return percent + '%';
                },
                pickJson: function() {
                    return JSON.stringify(this.picked);
                }
            }
        })
    </script>
@endsection
