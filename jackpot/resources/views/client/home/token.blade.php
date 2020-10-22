@extends("client.layouts.app")
@section("title")
    Profit
@endsection
@section("content")
    <main class="page-profit">
        <section class="percent-profit">
            <div class="container">
                <div class="percent-profit__inner">
                    <h1 class="title">
                        Percent profit
                    </h1>
                    <div class="des">
                        {!! meta_box('profit') !!}
                    </div>
                    <div class="group-chart">
                        <div class="group-chart__left">
                            <div class="radar-chart">
                                <canvas id="chart-container-left"></canvas>
                            </div>
                            <div class="info">
                                PLAY TOKENS </br>
                                DISTRIBUTION
                            </div>
                        </div>
                        <div class="group-chart__right">
                            <div class="radar-chart">
                                <canvas id="chart-container-right"></canvas>
                            </div>
                            <div class="info">
                                FUNDS DISTRIBUTION</br>
                                FROM CROWDFUND
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
