<script>
$(document).ready(function () {
    //Begin::Laod list section in page
    loadListSection();
    $('#list-li-section').on('click', 'li', function (e) {
        let sectionTo = $(this).data('section-index-to');
        let wrapper = $(`[data-section-index='${sectionTo}']`);
        let itemNew = wrapper.offset();
        $('html,body').animate({
            scrollTop: itemNew.top
        }, 600);
        return;
    })
    //End::Laod list section in page
    let indexDiv = 0;
    $('body').on('click', '.section-page', function (e) {
        let that = $(this);
        indexDiv = that.data('section-index');
        let itemNew = that.offset();
        // $('html,body').animate({
        //     scrollTop: itemNew.top - 50
        // }, 600);
        $('.option-section span:nth-child(1)').addClass('active-section');
        $('.option-section').css('right', 30);
        // $('.option-section').css('top', 10);
        $('.option-section').css('top', '50vh');
        $('.option-section').css('transform', 'translateY(-50%)');
        $('.option-section').css('opacity', 1);
    });

    $('.option-section').on('click', 'span', function (e) {
        let that = $(this);
        let action = that.data('type');
        if (action == 'top') {
            let wrapper = $(`[data-section-index='${indexDiv}']`);
            let itemNew = wrapper.prev().offset();
            $('html,body').animate({
                scrollTop: itemNew.top - 10
            }, 600);
            $('.option-section').css('right', 30);
            // $('.option-section').css('top', 60);
            $('.option-section').css('top', '50vh');
            $('.option-section').css('transform', 'translateY(-50%)');
            wrapper.insertBefore(wrapper.prev());
            return;
        }
        if (action == 'bottom') {
            let wrapper = $(`[data-section-index='${indexDiv}']`);
            $('.option-section').css('right', 30);
            // $('.option-section').css('top', 60);
            $('.option-section').css('top', '50vh');
            $('.option-section').css('transform', 'translateY(-50%)');
            wrapper.insertAfter(wrapper.next());
            let itemNew = wrapper.offset();
            $('html,body').animate({
                scrollTop: itemNew.top - 10
            }, 600);
            return;
        }
        if (action == 'delete') {
            let wrapper = $(`[data-section-index='${indexDiv}']`);
            wrapper.remove();
            $('.option-section').css('opacity', 0);
            loadListSection();
            return;
        }

        if (action == 'addsection') {
            $('#addSectionModal').modal('show');
            return;
        }
    });

    // Add Section in page
    $('.btn-chose-section').on('click', function (e) {
        let that = $(this);
        let _page = that.data('page');
        let _section = that.data('section');
        $('.loading-add-section').css('opacity', 1);
        //ajax to get html section
        let divSectionHtml = ` <div class="banner-v3 section-page" data-section-index="10">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <h3>Why Travel Gateway <img src="assets/img/logo-cricle.png" alt="logo"></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed condimentum ultricies nunc,met,
                        consectetu condimentum ultricies nunc,met, consectetur adipiscing elit. Sed condimentum
                        ultricies nunc, quis condimentum massa hendrerit sit amet. Duis at pharetra sem. </p>
                    <p><a href="#" class="btn btn-read-more-v2"><i class="fa fa-hand-o-right"></i> Learn More</a></p>
                </div>
                <div class="col-md-7 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-box">
                                <span><i class="fa fa-taxi"></i></span>
                                <h4>TAXI DISCOUNT</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adip. Maecenas dapibus facilisis cvallis.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <span><i class="fa fa-lock"></i></span>
                                <h4>TRUST AND SECURITY
                                </h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing dapibus facilisis cvallis.</p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <span><i class="fa fa-map"></i></span>
                                <h4>Around world</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maece facilisis cvallis.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <span><i class="fa fa-cutlery"></i></span>
                                <h4>BEST FOOD
                                </h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing apibus facilisis cvallis.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
        $(`${divSectionHtml}`).insertAfter(`[data-section-index='${indexDiv}']`);
        $('.loading-add-section').css('opacity', 0);
        $('#addSectionModal').modal('hide');
        let itemNew = $(`[data-section-index='${indexDiv}']`).next().offset();
        $('html,body').animate({
            scrollTop: itemNew.top - 10
        }, 600);
        loadListSection();
        return;
    });


});

function loadListSection() {
    let divList = [];
    $('.section-page').each(function (index, value) {
        let itemSection = ` <li data-section-index-to="${$(this).data('section-index')}">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-view-list" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2zm0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14z" />
        </svg>
        <span> section${$(this).data('section-index')}</span>
    </li>`;
        divList.push(itemSection);
    });
    $('#list-li-section').html(divList);
}
</script>
