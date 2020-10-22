@extends("client.layouts.app")
@section("title")
    Game {{$game->name}}
@endsection
@section("CustomCSS")
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <link rel="stylesheet" href="Archive/css/notyf.min.css">
    <style>
        .image-ball {
            -webkit-animation: spin 4s linear infinite;
            -moz-animation: spin 4s linear infinite;
            animation: spin 4s linear infinite;

        }

        @-moz-keyframes spin {
            100% {
                -moz-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section("content")
                <div class="popup-add mint-ticket">
                    <div class="popup-inner check-link">
                        <h4 class="text-center title-group error-mount"></h4>
                        <div class="text-center mt-3">
                            <img src="Archive/images/examples/sorry.png" alt="sorry">
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-xl-4 col-lg-4 col-md-4 m-auto">
                                <button class="anh-btn close-error-click" type="submit" id=""><i class="flaticon-edit"></i>{{__('label.confirm')}}</button>
                            </div>
                        </div>
                        <a class="popup-close close-error-click" href="javascript:void(0)">x</a>
                    </div>
                </div>
    <main class="page-play-lotto">
        <div class="loader-ticket">
            <div class="preloader-spinner">
                <img src="Archive/images/icons/load.png" alt="">
                LOADING
            </div>
        </div>
        <section class="lotto-play">
            <div class="container">
                <div class="lotto-play__inner">
                    <div class="lotto-play__inner-left">
                        <h1 class="title title-fix">
                            Lottery "Promo {{$game->name}} on <span>E-JACKPOT</span>"
                        </h1>
                        <div class="des">
                                <span>
                                    To see the {{$game->name}} Lotto rules,
                                </span>
                            <a href="#">
                                click here
                            </a>
                        </div>
                        @if($flag)
                            <a href="javascript:void(0)" class="button add-ticket custom-btn-1"
                               onclick="_p_g_j_n.add_ticket()">
                                ADD TICKET
                            </a>
                        @else
                            <h1 class="title">In the process of dialing, cannot buy tickets at this time!</h1>
                            <a href="{{route("client.dashboard.index")}}" class="button add-ticket custom-btn-1">MY
                                TICKET</a>
                        @endif

                        <div class="group-ticket">
                            <div class="button-arrowr-ticket">
                                <img src="Archive/images/icons/arrow-r-ticket.png">
                            </div>
                            <ul class="list-ticket" id="area_ticket_new">
                            </ul>
                        </div>
                    </div>
                    <div class="lotto-play__inner-right" style="text-align: center;">
                        <div class="top">
                            <div class="wrap-img" id="image-rotate-lotte">
                                <img src="Archive/images/examples/bg-buy-ticket.png">
                            </div>
                        </div>
                        <ul class="list-ball-buy">
                            @for($i=1;$i<=$game->number_pick;$i++)
                                <li class="list-ball-buy__item ball-{{$i}}-item">
                                    <div class="ball">
                                        <img src="Archive/images/examples/ball-1.png" class="" width="100%"
                                             height="100%">
                                    </div>
                                    <div class="count" id="number-lt-{{$i}}">
                                        <span>
                                            00
                                        </span>
                                    </div>
                                </li>
                            @endfor

                        </ul>
                        @if(!$flag)
                            <em class="text-warning text-notify-dial">dial in progress</em>
                        @endif
                        <div class="info">
                            @if($flag)
                                <div class="price">
                                    <span class="price__main">{{format_number_money($game->value)}}</span>
                                    <span class="price_unit">USDT</span>
                                </div>
                                <div class="date">
                                    <span class="countdown__time" data-date="{{$game->end_time}}"></span>
                                    <span>time left</span>
                                </div>
                            @endif

                            <form action="{{route("client.game.buy")}}" method="post" id="from_buy_ticket">
                                @csrf
                                <input type="hidden" value="{{$game->number_pick}}" name="game_choose_number">
                                <input type="hidden" value="{{$game->number_max}}" name="game_max_number">
                                <input type="hidden" value="{{$game->code}}" name="game_code">
                                <input type="hidden" id="ticket_number" name="ticket_number">
                                <input type="hidden" id="ticket_amount" name="ticket_amount">
                                <input type="hidden" name="period" value="1">
                                <input type="hidden" name="type" value="{{ config('constants.ticket.type.standard') }}">
                                <div id="review"></div>
                                @if($flag)
                                    <div class="group-button">
                                        <a href="javascript:void(0)" class="button custom-btn-1 opw"
                                           onclick="_p_g_j_n.buy_ticket()">
                                            BUY
                                            <span class="total-price-buy"></span>
                                            <span>USDT</span>
                                        </a>
                                        <div class="des_bt">
                                            You buy
                                            <span class="total-ticket"></span>
                                            tickets
                                        </div>
                                    </div>
                                @endif

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>



    {{--    <style>--}}
    {{--        .active {--}}
    {{--            background-color: red;--}}
    {{--        }--}}

    {{--        button {--}}
    {{--            cursor: pointer;--}}
    {{--        }--}}
    {{--    </style>--}}

@endsection
@section("CustomJS")
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="Archive/js/notyf.min.js"></script>
    <script>
        var notyf = new Notyf({
            delay: 5000,
            // dismissible: false,
        });
        @if($errors->has("error"))
        @foreach ($errors->all() as $error)
        notyf.alert('{{ $error}}');
        @endforeach
        @endif
        $('.countdown__time').each(function (i) {
            let Date = $(this).attr('data-date');
            Date = moment.utc(Date).local().format("YYYY-MM-DD HH:mm:ss");
            $(this).countdown(Date).on('update.countdown', function (event) {
                var format = '%H:%M:%S';
                if (event.offset.totalDays > 0) {
                    format = '%-d day%!d ' + format;
                }
                if (event.offset.weeks > 0) {
                    format = '%-w week%!w ' + format;
                }
                $(this).html(event.strftime(format));
            })
                .on('finish.countdown', function (event) {
                    // $(this).html('This offer has expired!')
                    //     .parent().addClass('disabled');
                    location.reload();

                });
        });
        $('#area_ticket_new').slick({
            dots: false,
            speed: 1500,
            slidesToShow: 3,
            slidesToScroll: 2,
            prevArrow: $('.button-arrowr-ticket img'),
            nextArrow: $('.button-arrowr-ticket img'),
            infinite: false,
            respondTo: 'window',
            // autoplay: true,
            // autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1679,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
        $('.close-error-click').on('click',function(){
            $('.mint-ticket').fadeOut(350);
        })
    </script>
    @include("client.game.IndexJS")
@endsection

