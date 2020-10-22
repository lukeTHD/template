@extends("client.layouts.app")
@section("title")
    {{__("client.home.title")}}
@endsection
@section("content")
    <section class="background-image">
        <div class="container">
            <div class="background-image__inner">
                <div class="background-image__inner-top">
                    <div class="top-l">
                        <h1 class="title">
                            {!! meta_box(config("constants.metabox.home_text")) !!}
                        </h1>
                        <div class="des">
                            {!! meta_box(config("constants.metabox.home_description")) !!}
                        </div>
                        <div class="group-button">
                            <a href="https://wallet.elegend.io/wallet/balance" class="button custom-btn-1">
                                DIPOSIT ETICKET
                            </a>
                            <a href="" class="button custom-btn-2">
                                WHITEPAPER
                            </a>
                            <a href="https://www.youtube.com/watch?v=5VHFO-77OgE" class="btn-play-i" data-fancybox>
                                <img src="Archive/images/icons/icon-play.png">
                            </a>
                        </div>
                    </div>
                    <div class="top-r">
                        <div class="wrap-img">
                            <img src="Archive/images/examples/bg-top.png" class="img" alt="">
                        </div>
                    </div>
                </div>
                <div class="background-image__inner-bottom">
                    <ul class="list-jackpost">
                        @foreach($mListGame as $value)
                            <li class="list-jackpost__item">
                                <div class="item-inner">
                                    <div class="info">
                                        <div class="lottery">
                                            {{ $value->name }}
                                        </div>
                                        <div class="title">
                                            JACKPOT
                                        </div>
                                        <div class="eth">
                                            <span style="font-size: 32px;">{{numberFormat($value->price)}}</span>
                                            <span style="font-size: 28px;">USDT</span>
                                            <span style="font-size: 28px;">/</span>
                                            <span style="font-size: 20px;">ticket</span>
                                        </div>
                                        <div class="price">
                                            <span>win</span>
                                            <span>$</span>
                                            <span>{{!empty($value->value)?numberFormat($value->value):0}}</span>
                                        </div>
                                        <div class="deal-count-down countdown" data-date="2020/06/07">
                                    <span class="countdown__time" data-date="{{$value->end_time}}">
                                    </span>
                                            <span>
                                        time left
                                    </span>
                                        </div>
                                    </div>
                                    @if(session()->has('is_auth_client')&&session('is_auth_client'))
                                        <a class="btn-play" href="{{route("client.game.index",$value->code)}}">
                                            PLAY NOW
                                        </a>
                                    @else
                                        <button id="pop-up-login" class="btn-play" type="submit">PLAY NOW</button>
                                    @endif
                                    <div class="ball-1">
                                        <img src="Archive/images/ball/{{intval($value->number_pick)}}.png">
                                    </div>
                                    <div class="ball-2">
                                        <img src="Archive/images/ball/{{intval($value->number_max)}}.png">
                                    </div>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("CustomJS")
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script>
        $(document).ready(function () {
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
                        $(this).html('This offer has expired!')
                            .parent().addClass('disabled');

                    });
            });
            $("#pop-up-login").on('click', function () {
                $('.popup-add').fadeIn(350);
            });
            $(".close-add-group").on('click', function () {
                $('.popup-add').fadeOut(350);
            });
        });
    </script>
@endsection
