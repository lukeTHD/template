jQuery(document).ready(function($) {

	var $height_menu = $('#header').outerHeight();
    var $width_screen = $(window).width();
    var flat_count = true;
    var flat_height = true;

    // Menu
    {

        // Click Menu Mobile

        $('button.navbar-toggler').click(function(event) {
            /* Act on the event */
            $(this).toggleClass('collapsed');
        });

        $('header button.navbar-toggler').click(function(event) {
            /* Act on the event */
            $('header.header .mobile-menu').addClass('open');
        });

        $('.mobile-menu__close-button').click(function(event) {
            /* Act on the event */
            $('header.header .mobile-menu').removeClass('open');
            $('header button.navbar-toggler').addClass('collapsed');
        });


        // Dropdown
        $('.nav-item>.nav-link').click(function(event) {
            /* Act on the event */
            $('.dropdown-menu').slideToggle();
        });

        // Scroll
        $(window).scroll(function(event) {
            setTimeout(function(){ stickyMenu();}, 500);
            console.log(1);
        });
        function stickyMenu(){
            if ($(window).scrollTop() > 80){
                $("header.header").addClass('sticky');
                $("footer").addClass('sticky');
            }
            if($(window).scrollTop() < 40 ){
                $("header.header").removeClass('sticky');
                $("footer").removeClass('sticky');
            }
        }
    }

    function stickyMenu(){
        if ($(window).scrollTop() > 150){
            $("header.header").addClass('active');
          }
        if($(window).scrollTop() < 80 ){
          $("header.header").removeClass('active');
        }
    }

    // HomePage
    if($('main.homepage').length > 0) {
        // Slider list-jackpost
        {
            $('.list-jackpost').slick({
                dots: false,
                arrows: false,
                speed: 1500,
                slidesToShow: 4,
                slidesToScroll: 1,
                // autoplay: true,
                // autoplaySpeed: 2000,
                responsive: [
                    {
                      breakpoint: 1199,
                      settings: {
                        slidesToShow: 3,
                      }
                    },
                    {
                      breakpoint: 991,
                      settings: {
                        slidesToShow: 2,
                      }
                    },
                    {
                      breakpoint: 539,
                      settings: {
                        slidesToShow: 1,
                      }
                    },
                ]
            });
        }
    }


    // Slider RoadMap

    {
        $('.road-map__slider').slick({
            // autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.road-map__time',
        });
        $('.road-map__time').slick({
          slidesToShow: 7,
          slidesToScroll: 1,
          asNavFor: '.road-map__slider',
          dots: false,
          arrows: false,
          centerMode: true,
          focusOnSelect: true,
          responsive: [
                    {
                      breakpoint: 1199,
                      settings: {
                        slidesToShow: 5,
                        centerPadding: '0px',
                      }
                    },
                    {
                      breakpoint: 539,
                      settings: {
                        slidesToShow: 3,
                        centerPadding: '0px',
                      }
                    },
                ]
        });
    }


    // Countdown-Page
    {
        $(".preeloader").fadeOut(3000);

        var set_date = $('.clock-countdown .date-config').data('date');

        var countDownDate = new Date(set_date).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"

        $('.coundown-timer .single-counter .days').text(days);
        $('.coundown-timer .single-counter .hours').text(hours);
        $('.coundown-timer .single-counter .minutes').text(minutes);
        $('.coundown-timer .single-counter .seconds').text(seconds);


        if (distance < 0) {
            clearInterval(x);
                $(".coundown-timer").text("YES!DONE");
            }
        }, 1000);
    }

    // Profit Page
    {
        if($('.page-profit').length > 0) {
            // ChartJs
            var data_home_left = {
                            labels: ['Re-contributed to the Lotto GO community fund', 'For Developers', 'For Marketing'],
                            datasets: [{
                                data: [1, 20, 79, ],
                                backgroundColor: [
                                    '#3da4ff',
                                    '#ec4444',
                                    '#55c955',
                                ],
                                borderColor: [
                                    '#0f0f10',
                                    '#0f0f10',
                                    '#0f0f10',
                                ],
                                borderWidth: 5
                            }]
                        }

            var data_home_right = {
                            labels: ['For the Community', 'For Developers', 'For the Community Reserved Fund'],
                            datasets: [{
                                data: [69, 1, 30, ],
                                backgroundColor: [
                                    '#ec3847',
                                    '#3ea6ff',
                                    '#ffb63e',
                                ],
                                borderColor: [
                                    '#0f0f10',
                                    '#0f0f10',
                                    '#0f0f10',
                                ],
                                borderWidth: 5
                            }]
                        }

            {
                var ctx = $('#chart-container-left');
                var myDoughnutChartHomel = new Chart(ctx, {
                    type: 'doughnut',
                    data: data_home_left,
                    options:
                    {
                        legend: {
                            display: false,
                        },
                        layout: {
                            padding: {
                              top: 10
                           }
                        },
                    }
                });

                var ctx = $('#chart-container-right');
                var myDoughnutChartHomeR = new Chart(ctx, {
                    type: 'doughnut',
                    data: data_home_right,
                    options:
                    {
                        legend: {
                            display: false,
                        },
                        layout: {
                            padding: {
                              top: 10
                           }
                        },
                    }
                });
            }

        }
    }

    // Page Token
    {
        if($('.page-token').length > 0){
            var data_chart_token_left = {
                    labels: ['Shared tokens holder', 'of the tokens are converted into tickets', ],
                    datasets: [{
                        data: [10, 89],
                        backgroundColor: [
                            '#ec4444',
                            '#55c955',
                        ],
                        borderColor: [
                            '#0f0f10',
                            '#0f0f10',
                            '#0f0f10',
                        ],
                        borderWidth: 5
                    }]
                }

            var data_chart_token_right = {
                            labels: ['Shared tokens holder', 'of the tokens are converted into tickets',],
                            datasets: [{
                                data: [40, 60],
                                backgroundColor: [
                                    '#ec3847',
                                    '#55c955',
                                ],
                                borderColor: [
                                    '#0f0f10',
                                    '#0f0f10',
                                    '#0f0f10',
                                ],
                                borderWidth: 5
                            }]
                        }

            {
                var ctx = $('#group-chart__left-container');
                var tokenChartl = new Chart(ctx, {
                    type: 'doughnut',
                    data: data_chart_token_left,
                    options:
                    {
                        legend: {
                            display: false,
                        },
                        layout: {
                            padding: {
                              top: 10
                           }
                        },
                    }
                });

                var ctx = $('#group-chart__right-container');
                var tokenChartR = new Chart(ctx, {
                    type: 'doughnut',
                    data: data_chart_token_right,
                    options:
                    {
                        legend: {
                            display: false,
                        },
                        layout: {
                            padding: {
                              top: 10
                           }
                        },
                    }
                });
            }

        }
    }


    // Ticket

    {
        for (let arr_myticket=[],i=1;i<=40;++i) arr_myticket[i]=i;
                current = Math.floor(Math.random() * (top + 1));



        // $('.group-ticket .list-ticket__item .heading-group .random-ticket').click(function(event) {
        //     /* Act on the event */
        //         var arr = [];
        //         while(arr.length < 6){
        //             var r = Math.floor(Math.random() * 40) + 1;
        //             if(arr.indexOf(r) === -1) arr.push(r);
        //         }
        //         var list_number_a = $(this).parents('.list-ticket__item').find('.list-number li');
        //         $(this).parents('.list-ticket__item').find('.list-number li .number').removeClass('active');
        //
        //         for(let i = 0; i < arr.length ; i++) {
        //             console.log(arr[i]);
        //             $(this).parents('.list-ticket__item').find('.list-number li:nth-of-type('+arr[i]+') .number').addClass('active');
        //         }
        //
        //
        //
        // });



        var index_ticket;
        var li_number_ticket = '';
        // var count_item_ticket = parseInt($(".list-ticket").slick("getSlick").slideCount);
        // for (index_ticket = 1; index_ticket <= 40; index_ticket++) {
        //     li_number_ticket += '<li>'+
        //               '<div class="number">'+ index_ticket +'</div>'+
        //             '</li>';
        // };
        //
        // function show_item_ticket($count) {
        //     var li_item_ticket =   '<li class="list-ticket__item">'+
        //                                 '<div class="heading-group">'+
        //                                     '<div class="heading">'+
        //                                         '<h3 class="name">Ticket '+ $count +'</h3>'+
        //                                         '<div class="select">Select 6 number</div>'+
        //                                     '</div>'+
        //                                     '<a href="javascript:void(0)" class="random-ticket">'+
        //                                         '<img src="images/examples/button-random.png">'+
        //                                     '</a>'+
        //                                 '</div>'+
        //                                 '<div class="item-inner">'+
        //                                     '<div class="left">'+
        //                                         '<div class="info">'+
        //                                             '<div class="info-l">'+
        //                                                 '<div class="inner">'+
        //                                                     '<h3 class="title-ticket">Blockchain<br>Lottery</h3>'+
        //                                                     '<div class="type">'+
        //                                                         '<img src="images/examples/bg-type-vip.png">'+
        //                                                     '</div>'+
        //                                                 '</div>'+
        //                                             '</div>'+
        //                                             '<div class="info-r">'+
        //                                                 '<div class="logo">'+
        //                                                     '<img src="images/logo/favicon.png" alt="">'+
        //                                                 '</div>'+
        //                                                 '<div class="price">'+
        //                                                     '<span class="price__main">0.018598 </span>'+
        //                                                     '<span class="price__unit">ETH</span>'+
        //                                                 '</div>'+
        //                                             '</div>'+
        //                                         '</div>'+
        //                                         '<ul class="list-number">'+
        //                                             li_number_ticket+
        //                                         '</ul>'+
        //                                     '</div>'+
        //                                     '<div class="right">'+
        //                                         '<div class="right-t">GO</div>'+
        //                                         '<div class="right-b">BLOCKCHAIN LOTTERY</div>'+
        //                                     '</div>'+
        //                                 '</div>'+
        //                             '</li>';
        //     return li_item_ticket;
        // }


        // $('.add-ticket').on('click', function() {
        //     count_item_ticket++;
        //     $('.loader-ticket').addClass('active');
        //     setTimeout(function(){ $('.loader-ticket').removeClass('active'); }, 2000);
        //     $('.list-ticket').slick('slickAdd', show_item_ticket(count_item_ticket));
        //
        //     if($width_screen > 1679) {
        //         // $('.list-ticket').slick('slickAdd', show_item_ticket(count_item_ticket));
        //         $('.list-ticket').slick('slickGoTo', parseInt(count_item_ticket-3));
        //     }
        //     if( 450 < $width_screen <= 1679 ) {
        //         $('.list-ticket').slick('slickGoTo', 2);
        //         console.log('hi');
        //     }
        // });
    }


});
