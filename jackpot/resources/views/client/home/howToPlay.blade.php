@extends("client.layouts.app")
@section("title")
    how to play
@endsection
@section("content")
    <section class="how-play" style="padding-bottom: 20vh;">
        <div class="container">
            <div class="how-play__inner">
                <div class="how-play__inner-left">

                    <h1 class="title">
                        How to play
                    </h1>
                    <div class="des">
                        {!! meta_box('how_to_play') !!}
                    </div>

                    <div id="accordion-howplay">
                        @foreach($mList as $key=> $value)
                            <div class="play-item">
                                <div class="item-header">
                                    <a class="link" data-toggle="collapse" href="#collapse-{{$value->id}}">
                                        <img src="Archive/images/examples/icon-use.png">
                                        {{$value->question}}
                                    </a>
                                </div>
                                <div id="collapse-{{$value->id}}" class="collapse {{$key===0?"show":""}}"
                                     data-parent="#accordion-howplay">
                                    <div class="content">
                                        {{$value->answer}}
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <div class="how-play__inner-right">
                    <div class="wrap-image">
                        <img src="Archive/images/examples/bg-faq.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
