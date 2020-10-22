@extends("client.layouts.app")
@section("title")
    Game
@endsection
@section("content")

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
                        <h1 class="title text-success">
                            Successful ticket purchase
                        </h1>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
@section("CustomJS")
@endsection

