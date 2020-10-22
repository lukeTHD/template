<script>
    new Vue({
        el: '#kt_form',
        delimiters: ['<%', '%>'],
        data: {
            items: @if(isset($game['game_rewards']))
                {!! json_encode($game['game_rewards']) !!}
                @else
                @if(old('rewards')) {!! old('rewards') !!} @else [
                {
                    name: 'Jackpot',
                    value_percent: 70,
                    number: 5
                }
            ] @endif
            @endif ,
            current_id: 0,
            sacks: @if(isset($game['sacks'])) {!! json_encode($game['sacks']) !!} @else [] @endif,
            sackValue: 0,
            number_pick: @if(isset($game['number_pick'])) {{ $game['number_pick'] }} @else 5 @endif,
            number_max: @if(isset($game['number_max'])) {{ $game['number_max'] }} @else 36 @endif,
            number_selected: []
        },
        methods: {
            addItem: function () {
                this.items.push({
                    name: '',
                    value_percent: 0,
                    number: 0
                });
            },
            removeItem: function (key) {
                this.items = this.items.filter(function (value, index) {
                    return key !== index;
                });
            },
            configReward: function (key) {
                this.current_id = key;
            },
            addSack: function () {
                if (this.sackValue > 0 && +this.sackValue <= this.number_max) {
                    var vm = this;
                    var is = this.sacks.filter(function (value, index) {
                        return value === +vm.sackValue;
                    });
                    if (is.length === 0) this.sacks.push(+this.sackValue);
                }
                this.sackValue = 0;
            },
            deleteSack: function (sack) {
                this.sacks = this.sacks.filter(function(value) {
                    return +value !== +sack;
                });
                this.sackValue = 0;
            }
        },
        computed: {
            itemsJson: function () {
                return JSON.stringify(this.items);
            },
            sacksJson: function () {
                return JSON.stringify(this.sacks);
            },
            percent: function () {
                return this.items.reduce((accumulator, item) => +accumulator + +item['value_percent'], 0);
            },
            currentItem: function () {
                return this.items[this.current_id];
            },
            percentConfig: function () {
                var item = this.items[this.current_id];
                return +item.share_new + +item.share_company + +item.share_up + +item.share_level_2;
            }
        }
    })
</script>
