<script>
    class play_game_jackpot {
        constructor(game_code, max_number, max_count_number) {
            // console.log(game_code);
            this.game_code = game_code;
            this.max_count_number = max_count_number;
            this.max_number = max_number;
            this.arr_ticket = [];
            this.id_area_ticket = "area_ticket";
            this.class_ticket = "item_ticket";
            this.class_ticket_number = "item_number";
            this.class_active = "active";
            this.minimum_ticket = 3;
        }


        add_ticket() {
            this.html_item_ticket();
        }

        html_item_ticket(amount = 1) {
            let item_html_new = `<li class="list-ticket__item">
                                    <div class="heading-group">
                                        <div class="heading">
                                            <h3 class="name">
                                                Ticket @TICKET_NUMBER@
                                            </h3>
                                            <div class="select">
                                                Select @PICK_NUMBER@ number
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" class="random-ticket">
                                            <img src="Archive/images/examples/button-random.png">
                                        </a>
                                    </div>
                                    <div class="item-inner">
                                        <div class="left">
                                            <div class="info">
                                                <div class="info-l">
                                                    <div class="inner">
                                                        <h3 class="title-ticket">
                                                            Blockchain<br>
                                                            Lottery
                                                        </h3>
                                                        <div class="type">
                                                            <img src="Archive/images/examples/bg-type-vip.png">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="info-r">
                                                    <div class="logo">
                                                        <img src="Archive/images/logo/favicon.png" alt="">
                                                    </div>
                                                    <div class="price">
                                                        <span class="price__main">0.018598</span>
                                                        <span class="price__unit">ETH</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-number">
                                                @ITEM_NUMBER@
                                                <li>
                                                    <div class="number active">1</div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="right">
                                            <div class="right-t">
                                                GO
                                            </div>
                                            <div class="right-b">
                                                BLOCKCHAIN LOTTERY
                                            </div>
                                        </div>
                                    </div>
                                </li>`;


            let item_html = `<div class="${this.class_ticket}">@ITEM_NUMBER@</div>`;
            let item_number_html = "";
            for (let i = 1; i <= this.max_number; i++) {
                item_number_html += `<button type="button" class="${this.class_ticket_number}" data-number="${i}" onclick="_p_g_j.choose_number_ticket(this)">${i}</button>`;
            }
            item_number_html += `<button type="button" onclick="_p_g_j.random_number_ticket(this)" style="background: yellow;">RANDOM</button>`;
            item_number_html += `<button type="button" onclick="_p_g_j.remove_number_ticket(this)" style="background: red;">REMOVE</button><hr>`;
            item_html = item_html.replace("@ITEM_NUMBER@", item_number_html);
            let amonnt_html = "";
            for (let i = 1; i <= amount; i++) {
                amonnt_html += item_html;
            }
            $("#area_ticket").append(amonnt_html);
        }

        choose_number_ticket(tag) {
            //check class active
            let check_active = $(tag).hasClass("active");
            if (check_active) {
                $(tag).removeClass("active");
                return false;
            }
            let count_number_active = $(tag).parent("." + this.class_ticket).find(".active");
            console.log({count_number_active})
            if (count_number_active.length >= this.max_count_number) {
                alert("ban da chon " + this.max_count_number);
                return false;
            }
            $(tag).addClass("active");
            return true;
        }

        random_number_ticket(tag) {
            //count number active
            let count_active_number_in_ticket = $(tag).parent("." + this.class_ticket).find(".active");
            let listNumberActive = [];
            if (count_active_number_in_ticket.length >= this.max_count_number) {
                alert("da du " + this.max_count_number + " so");
                return false;
            }
            count_active_number_in_ticket.each(function () {
                listNumberActive.push(parseInt($(this).attr("data-number")));
                // $(this).removeClass("active")
            });

            for (let i = this.max_count_number; i > count_active_number_in_ticket.length; i--) {
                let nimber = this.get_number_random_ticket(listNumberActive, this.max_number);
                listNumberActive.push(nimber);
                $(tag).parent("." + this.class_ticket).find("[data-number=" + nimber + "]").addClass("active");
            }
            // console.log({listNumberActive})
        }

        get_number_random_ticket(list, max) {
            let number_ran = this.random_number(max);
            if (list.indexOf(number_ran) === -1) {
                return number_ran;
            } else {
                return this.get_number_random_ticket(list, max)
            }
        }

        random_number(max, min = 1) {
            return Math.floor((Math.random() * max) + min);
        }

        remove_number_ticket(tag) {
            console.log($(tag).parents("." + this.class_ticket))
            $(tag).parent("." + this.class_ticket).remove();
        }

        buy_ticket() {
            //get all ticket
            let count_ticket = $("#" + this.id_area_ticket).find("." + this.class_ticket);
            // console.log({count_ticket})
            if (count_ticket.length < 1) {
                alert("chon khong chon ve nao de mua");
                return false;
            }
            let arr_ticket = [];
            let max_number_ticket = this.max_count_number;
            let flag = true;
            count_ticket.each(function (index) {
                let item_ticket = [];
                // let count=0;
                $(this).find('.active').each(function () {
                    item_ticket.push($(this).attr("data-number"));
                })
                if (item_ticket.length < max_number_ticket) {
                    flag = false;
                    alert("ve " + (index + 1) + " thieu " + (max_number_ticket - item_ticket.length) + " số mới đủ  ");
                    return false;
                }

                arr_ticket.push(item_ticket);
            });
            // console.log({arr_ticket})
            if (flag) {
                $("#ticket_amount").val(arr_ticket.length);
                $("#ticket_number").val(JSON.stringify(arr_ticket));
                $("#review").html(JSON.stringify(arr_ticket))
            }

        }
    }

    const _p_g_j = new play_game_jackpot("{{$game}}", 45, 6);
    _p_g_j.html_item_ticket(3);


    class play_game_jackpot_new {
        constructor(game_code, number_pick, number_max, price) {
            // console.log({game_code, number_pick, number_max})
            this.game_code = game_code;
            this.number_pick = parseInt(number_pick);
            this.number_max = parseInt(number_max);
            this.price = parseFloat(price);
            this.count_ticket = 0;
            this.id_area_ticket = "area_ticket_new";
            this.class_ticket = "list-number";
            this.min_ticket = 0;
            this.old_number_jacpot = [];
        }


        set_old_ticket($number) {
            $number = JSON.parse($number);
            console.log({$number})
            this.old_number_jacpot = $number;
            for (let i = 1; i <= this.old_number_jacpot.length; i++) {
                $(".ball-" + i + "-item").find("img").attr("src", "Archive/images/ball/" + parseInt(this.old_number_jacpot[i - 1]) + ".png");
                $("#number-lt-" + i).find("span").html(this.old_number_jacpot[i - 1]);
            }

        }

        set_min_ticket(min_ticket) {
            // console.log({min_ticket})
            this.min_ticket = parseInt(min_ticket);
            for (let id = 0; id < this.min_ticket; id++) {
                this.html_item_ticket()
            }
        }

        random_number_ticket(tag) {


            //count number active
            let tag_number_in_ticket = $(tag).parent(".heading-group").parent(".slick-slide").find(".item-inner>.left>.list-number>li");
            let count_active_number_in_ticket = tag_number_in_ticket.find(".active");
            // console.log({count_active_number_in_ticket});
            // return false;
            let listNumberActive = [];
            // if (count_active_number_in_ticket.length >= this.number_pick) {
            //     alert("da du " + this.number_pick + " so");
            //     return false;
            // }
            count_active_number_in_ticket.each(function () {
                listNumberActive.push(parseInt($(this).attr("data-number")));
                // $(this).removeClass("active")
            });
            // console.log({l??istNumberActive})
            // return  false;
            for (let i = this.number_pick; i > count_active_number_in_ticket.length; i--) {
                let nimber = this.get_number_random_ticket(listNumberActive, this.number_max);
                listNumberActive.push(nimber);
                tag_number_in_ticket.find("[data-number=" + nimber + "]").addClass("active");
            }
            console.log({listNumberActive})
        }

        get_number_random_ticket(list, max) {
            let number_ran = this.random_number(max);
            if (list.indexOf(number_ran) === -1) {
                return number_ran;
            } else {
                return this.get_number_random_ticket(list, max)
            }
        }

        remove_ticket(tag) {
            if (this.count_ticket === 0) {
                return false;
            }
            $('.loader-ticket').addClass('active');
            let tag_number_in_ticket = $(tag).parent(".heading-group").parent(".slick-slide");
            let index = tag_number_in_ticket.attr("data-slick-index");
            $('#' + this.id_area_ticket).slick('removeSlide', index)
            $('#' + this.id_area_ticket).find(".list-ticket__item.slick-slide").each(function (number) {
                $(this).find('.heading-group>.heading>.name').html("Ticket " + (number + 1));
                $(this).attr("data-slick-index", number);
            });
            this.count_ticket = this.count_ticket - 1;
            if (this.count_ticket < 0) {
                this.count_ticket = 0;
            }
            this.update_info_booking();
            setTimeout(function () {
                $('.loader-ticket').removeClass('active');
            }, 1000);
        }

        random_number(max, min = 1) {
            return Math.floor((Math.random() * max) + min);
        }

        choose_number_ticket(tag) {
            let check_active = $(tag).hasClass("active");
            if (check_active) {
                $(tag).removeClass("active");
                return false;
            }
            let count_number_active = $(tag).parents("." + this.class_ticket).find(".active");
            // console.log({count_number_active})
            if (count_number_active.length >= this.number_pick) {
                notyf.alert('You have chosen ' + this.number_pick + ' numbers');
                // alert("ban da chon " + this.number_pick);
                return false;
            }
            $(tag).addClass("active");
            return true;
        }

        html_item_ticket(number = 1) {
            $('.loader-ticket').addClass('active');
            this.count_ticket = this.count_ticket + number;
            let item_html_new = `<li class="list-ticket__item">
                                    <div class="heading-group">
                                        <div class="heading">
                                            <h3 class="name">
                                                Ticket @TICKET_NUMBER@
                                            </h3>
                                            <div class="select">
                                                Select @PICK_NUMBER@ number
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" class="random-ticket" style="right:35px;width: 28px;" onclick="_p_g_j_n.random_number_ticket(this)" title="random">
                                            <img src="Archive/images/examples/button-random.png">
                                        </a>
                                        <a href="javascript:void(0)" class="random-ticket" style="top:28px;width: 22px;" onclick="_p_g_j_n.remove_ticket(this)" title="remove">
                                            <img src="Archive/images/examples/remove.png">
                                        </a>
                                    </div>
                                    <div class="item-inner">
                                        <div class="left">
                                            <div class="info">
                                                <div class="info-l">
                                                    <div class="inner">
                                                        <h3 class="title-ticket">
                                                            Blockchain<br>
                                                            Lottery
                                                        </h3>
                                                        <div class="type">
                                                            <img src="Archive/images/examples/bg-type-vip.png">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="info-r">
                                                    <div class="logo">
                                                        <img src="Archive/images/logo/favicon.png" alt="">
                                                    </div>
                                                    <div class="price">
                                                        <span class="price__main">@PRICE_1_TICKET@</span>
                                                        <span class="price__unit">USDT</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-number">
                                                @ITEM_NUMBER@

                                            </ul>
                                        </div>
                                        <div class="right">
                                            <div class="right-t">
                                                GO
                                            </div>
                                            <div class="right-b">
                                                BLOCKCHAIN LOTTERY
                                            </div>
                                        </div>
                                    </div>
                                </li>`;
            item_html_new = item_html_new.replace("@TICKET_NUMBER@", this.count_ticket);
            item_html_new = item_html_new.replace("@PICK_NUMBER@", this.number_pick);
            item_html_new = item_html_new.replace("@PRICE_1_TICKET@", this.price);
            let htmlItem = "";
            for (let i = 1; i < this.number_max + 1; i++) {
                htmlItem += `<li>
                                    <div class="number" data-number="${i}" onclick="_p_g_j_n.choose_number_ticket(this)">${i}</div>
                              </li>`;
            }
            item_html_new = item_html_new.replace("@ITEM_NUMBER@", htmlItem);
            // $("#" + this.id_area_ticket).append(item_html_new);
            $('#' + this.id_area_ticket).slick('addSlide', item_html_new)
            this.update_info_booking();
            $('#' + this.id_area_ticket).slick('slickGoTo', this.count_ticket)
            setTimeout(function () {
                $('.loader-ticket').removeClass('active');
            }, 1000);

        }

        update_info_booking() {
            $('.total-price-buy').html(this.price * this.count_ticket);
            $('.total-ticket').html(this.count_ticket);
        }

        add_ticket() {
            this.html_item_ticket();
        }

        buy_ticket() {
            let count_ticket = $("#" + this.id_area_ticket).find("." + this.class_ticket);
            let arr_ticket = [];
            let max_number_ticket = this.number_pick;
            let flag = true;

            if (count_ticket.length < 1) {
                notyf.alert("There are currently no tickets to buy")
                return false;
            }
            count_ticket.each(function (index) {
                let item_ticket = [];
                // let count=0;
                $(this).find('.active').each(function () {
                    let data_number = $(this).attr("data-number");
                    item_ticket.push(parseInt(data_number));
                })
                if (item_ticket.length < max_number_ticket) {
                    flag = false;
                    notyf.alert("Ticket " + (index + 1) + " is missing " + (max_number_ticket - item_ticket.length) + " numbers");
                    return false;
                }
                arr_ticket.push(item_ticket);
            });
            if (!flag) {
                return false;
            }
            if (arr_ticket.length < this.min_ticket) {
                notyf.alert(`Please buy at least: ${this.min_ticket} tickets`);
                return false;
            }
            if (flag) {
                $("#ticket_amount").val(arr_ticket.length);
                $("#ticket_number").val(JSON.stringify(arr_ticket));
                // $("#review").html(JSON.stringify(arr_ticket))
                $("#from_buy_ticket").submit();
            }

        }


    }


    // _p_g_j_n.html_item_ticket();

    class lottery_game_jackpot {
        constructor(game_code, number_pick) {
            this.game_code = game_code;
            this.number_pick = number_pick;
            this.jackpot = [];
            this.id_img_rotate = "image-rotate-lotte";
            this.interval_rotate = null;
        }

        init() {
            //run rotate
            $("#" + this.id_img_rotate).find("img").attr("src", "Archive/images/examples/Comp-3_00000.gif")
            $(".ball").find("img").addClass("image-ball");
        }

        getNumber(game_code) {
            // let game_code=this.game_code;
            // console.log({game_code})
            $.ajax({
                url: "{{route("client.game.rost")}}/" + game_code,
                method: "GET",
                success: function (data) {
                    if (data.status) {
                        for (let i = 1; i <= data.data.length; i++) {
                            console.log(data.data[i - 1])
                            $(".ball-" + i + "-item").find("img").attr("src", "Archive/images/ball/" + data.data[i - 1] + ".png");
                            $("#number-lt-" + i).find("span").html(data.data[i - 1]);
                        }
                    }
                }
            })
        }

        rotate(seconds, game_code) {
            this.interval_rotate = setInterval(function () {
                getNumber(game_code)
            }, seconds * 1000)
        }

        stop_rotate() {
            clearInterval(this.interval_rotate);
            $("#" + this.id_img_rotate).find("img").attr("src", "Archive/images/examples/bg-buy-ticket.png")
            $(".text-notify-dial").html("end the dialing process")
        }

    }

    function getNumber(game_code) {
        $.ajax({
            url: "{{route("client.game.rost")}}/" + game_code,
            method: "GET",
            success: function (data) {

                if (data.data.length == number_pick) {
                    _l_g_j.stop_rotate();
                }
                if (data.status) {
                    for (let i = 1; i <= data.data.length; i++) {
                        // console.log(data.data[i - 1])
                        $(".ball-" + i + "-item").find("img").attr("src", "Archive/images/ball/" + parseInt(data.data[i - 1]) + ".png");
                        $("#number-lt-" + i).find("span").html(data.data[i - 1]);
                    }
                } else {
                    _l_g_j.stop_rotate();
                }
            }
        })
    }

    const _l_g_j = new lottery_game_jackpot("{{$game->code}}", "{{$game->number_pick}}");
    const number_pick = '{{$game->number_pick}}';
    var flag_rotate = false;

        @if($flag)
    const _p_g_j_n = new play_game_jackpot_new("{{$game->code}}", "{{$game->number_pick}}", "{{$game->number_max}}", "{{$game->price}}");
    _p_g_j_n.set_min_ticket('{{$game->minimum_ticket}}')
    _p_g_j_n.set_old_ticket('{!! json_encode($oldNumberJackpot->numbers) !!}')
    @else
    // dd($WinNumber);
    @if($WinNumber['status']&&count($WinNumber['data']['arr_win_number'])==$game->number_pick)
    getNumber("{{$game->code}}");
    @else
    _l_g_j.init();
    _l_g_j.rotate(5, "{{$game->code}}");
    @endif
    @endif
</script>
