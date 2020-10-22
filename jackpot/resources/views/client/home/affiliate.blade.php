@extends("client.layouts.app")
@section("title")
    affiliate
@endsection
@section("content")
    <main class="page-affilite">
        <section class="affiliate-program">
            <div class="container">
                <div class="affiliate-program__inner">
                    <div class="affiliate-program__inner-left">
                        <div class="wrap-img">
                            <img src="Archive/images/examples/bg-2-1.png">
                        </div>
                    </div>
                    <div class="affiliate-program__inner-right">
                        <h2 class="title">
                            Affiliate program
                        </h2>
                        <div class="des">
                            {!! meta_box('affiliate') !!}
                        </div>
                        <ul>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Profit-Sharing:</span>
                                <span>earn up to 50% of the revenue on lottery ticket sales.</span>
                            </li>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Bigger Returns:</span>
                                <span>gain access to a multi-level referral distribution program with exponential return potential.</span>
                            </li>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Fast Payment:</span>
                                <span>enjoy instant Ethereum earnings based on smart contract guarantees.</span>
                            </li>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Quick Integration:</span>
                                <span>have the lottery platform running on your site within 1 day.</span>
                            </li>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Fully Custom:</span>
                                <span>Showcase your own brand with White Label integration.</span>
                            </li>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Flexible Options:</span>
                                <span>An opportunity to distribute lottery through reference.</span>
                            </li>
                            <li>
                                <img src="Archive/images/examples/check-mark.png">
                                <span>Hands-Free Operation:</span>
                                <span>Relax, Winnings and Jackpot payouts are made by the platform, requiring zero effort on your end.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="how-work">
            <div class="container">
                <div class="how-work__inner">
                    <div class="how-work__inner-left">
                        <h2 class="title">
                            how does it work
                        </h2>
                        <ul class="list-step">
                            <li class="list-step__item">
                                <div class="number">
                                    1
                                </div>
                                <div class="content">
                                    Player choose 6 numbers (0-45) in specific order. For example: 09, 13, 25, 23, 42, 17. Bet is accepted in block #20651
                                </div>
                            </li>
                            <li class="list-step__item">
                                <div class="number">
                                    2
                                </div>
                                <div class="content">
                                    The bet result will come in the third future block (+3): 20651. The draw result is the last 6 digits of block 20651 hash, i.e. 2f3b0d
                                </div>
                            </li>
                            <li class="list-step__item">
                                <div class="number">
                                    3
                                </div>
                                <div class="content">
                                    Numbers are converted into decimal format.
                                    <ul>
                                        <li>
                                            <span>Hexa decimal</span>
                                            <span>1</span>
                                            <span>2</span>
                                            <span>3</span>
                                            <span>4</span>
                                            <span>5</span>
                                            <span>6</span>
                                            <span>7</span>
                                            <span>8</span>
                                            <span>9</span>
                                            <span>a</span>
                                            <span>b</span>
                                            <span>c</span>
                                            <span>d</span>
                                            <span>e</span>
                                            <span>f</span>
                                        </li>
                                        <li>
                                            <span>Decimal</span>
                                            <span>1</span>
                                            <span>2</span>
                                            <span>3</span>
                                            <span>4</span>
                                            <span>5</span>
                                            <span>6</span>
                                            <span>7</span>
                                            <span>8</span>
                                            <span>9</span>
                                            <span>10</span>
                                            <span>11</span>
                                            <span>12</span>
                                            <span>13</span>
                                            <span>14</span>
                                            <span>15</span>
                                        </li>
                                    </ul>
                                    The draw result is: 09, 13, 25, 23, 42, 17.
                                </div>
                            </li>
                            <li class="list-step__item">
                                <div class="number">
                                    4
                                </div>
                                <div class="content">
                                    3 numbers match: 25, 23, 17.
                                </div>
                            </li>
                            <li class="list-step__item">
                                <div class="number">
                                    5
                                </div>
                                <div class="content">
                                    Player creceives payout.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="how-work__inner-right">
                        <div class="wrap-image">
                            <img src="Archive/images/examples/bg-how-work.png">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="management">
            <div class="container">
                <div class="management__inner">
                    <h2 class="title">
                        lottery funds management
                    </h2>
                    <div class="content">
                        <ul>
                            <li>Max hard cap = 200,000 ETH</li>
                            <li>Ethereum ERC20 Token</li>
                            <li>Purchase methods accepted: ETH</li>
                            <li>0.001 ETH = 1 PLAY Token (ca. $ 0.30)H</li>
                            <li>0.001 ETH = 1 PLAY Token (ca. $ 0.30)</li>
                        </ul>
                    </div>
                    <div class="management__diagram">
                        <div class="management__diagram-inner">
                            <div class="diagram-1 diagram">
                                <div class="diagram-inner">
                                    <h3 class="title">
                                        TOKEN HOLDERS
                                    </h3>
                                    <div class="info">
                                        <div class="up">
                                            Prize payouts
                                        </div>
                                        <div class="down">
                                            Ticket sales
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="diagram-2 diagram">
                                <div class="diagram-inner">
                                    <h3 class="title">
                                        PLAYERS
                                    </h3>
                                    <div class="info">
                                        <div class="up">
                                            Crowdsale
                                        </div>
                                        <div class="down">
                                            Dividents
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="diagram-main">
                                <div class="diagram-inner">
                                    <h3 class="title">
                                        SMART
                                        CONTRACT
                                    </h3>
                                </div>
                            </div>
                            <div class="diagram-3 diagram">
                                <div class="diagram-inner">
                                    <h3 class="title">
                                        ADMIN
                                    </h3>
                                    <div class="info">
                                        <div class="left">
                                            Hackathon
                                        </div>
                                        <div class="right">
                                            Market & Development
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="diagram-4 diagram">
                                <div class="diagram-inner">
                                    <h3 class="title">
                                        AFFILIATES
                                    </h3>
                                    <div class="info">
                                        <div class="left">
                                            Affiliate payouts
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
