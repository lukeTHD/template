@extends("client.layouts.app")
@section("title")
    top
@endsection
@section("content")
    <main class="page-top-winner">
        <section class="top-general top-winner" style="padding-bottom: 20vh;">
            <div class="container">
                <div class="top-general__inner">
                    <div class="top-general__inner-left">
                        <h1 class="title">
                            TOP Winners
                        </h1>
                        <div class="des">
                            {!! meta_box('top_winners') !!}
                        </div>
                        <ul class="list-info">
                            <li class="list-info__item">
                                WINNER: <span>{{ $total_amount_awarded }}</span> <span>USDT</span>
                            </li>
                            <li class="list-info__item">
                                Total amount awarded: <span>{{ $total_amount_awarded }}</span> <span>USDT</span>
                            </li>
                            <li class="list-info__item">
                                Winning tickets: <span>{{ $count_winning_tickets }}</span>
                            </li>
                            <li class="list-info__item">
                                Grand jackpot winners: <span>{{ $count_jackpot_winners }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="top-general__inner-right">
                        <ul class="list-table-info">
                            @foreach($top_winners as $top_winner)
                                <li class="list-table-info__item">
                                    <div class="inner">
                                        <ul>
                                            <div class="top-image">
                                                <div class="wrap-img">
                                                    <img src="Archive/images/examples/TopWinner-TopPlayer.png">
                                                </div>
                                                <div class="ball-1">
                                                    <img src="Archive/images/examples/ball-9.png">
                                                </div>
                                                <div class="ball-2">
                                                    <img src="Archive/images/examples/ball-6.png">
                                                </div>
                                            </div>
                                            @foreach($top_winner['users'] as $index => $user)
                                                <li>
                                                    @if($index < 3)
                                                        <div class="serial">
                                                            <span>
                                                                <img
                                                                    src="Archive/images/examples/top-{{ ++$index }}.png">
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="serial">
                                                            <span>
                                                                {{ ++$index }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div class="top">
                                                        <div class="code">
                                                            #{{ $user['user_id'] }}
                                                        </div>
                                                        <div class="price">
                                                            Won
                                                            <span
                                                                class="price__main">{{ numberFormat($user['money']) }}</span>
                                                            <span class="price__unit">USDT</span>
                                                        </div>
                                                    </div>
                                                    <div class="bottom">
                                                        <div class="content">
                                                            {{ $user['name'] }}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                            <div class="result">
                                                {{ __('label.prize')}}:
                                                <span>
                                                    {{ $top_winner['name'] }}
                                                </span>
                                            </div>
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
