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
        let code = that.data('code');
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
            $.ajax({
                    url: "{{ route('template.getListSection') }}",
                    method: "GET",
                    data: { code:code, arr_section_used: loadListIdSection() },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status){
                            let listItemSectionDivHtml = response.data.map(function(item) {
                                return getSectionHtml(item.page, item.section , item.img);
                            });
                           $('.modal-content-list-section').html(listItemSectionDivHtml.join(''));
                            $('#addSectionModal').modal('show');
                        }
                    }
                })
            return;
        }
    });

    // Add Section in page
    $('.modal-content-list-section').on('click','.btn-chose-section' , function (e) {
        let that = $(this);
        let _page = that.data('page');
        let _section = that.data('section');
        $('.loading-add-section').css('opacity', 1);
        let listIdSection = loadListIdSection();
        //ajax to get html section
        $.ajax({
                    url: "{{ route('template.getDetailCodeSection') }}",
                    method: "GET",
                    data: { page:_page, section:_section },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                       if(response.status){
                        let divSectionHtml = `${response.data}`;
                        $(`${divSectionHtml}`).insertAfter(`[data-section-index='${indexDiv}']`);
                        $('.loading-add-section').css('opacity', 0);
                        $('#addSectionModal').modal('hide');
                        $(".edit-text").editable();
                        let itemNew = $(`[data-section-index='${indexDiv}']`).next().offset();
                        $('html,body').animate({
                            scrollTop: itemNew.top - 10
                        }, 600);
                        loadListSection();
                       }
                    }
                })
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

function loadListIdSection() {
    let divList = [];
    $('.section-page').each(function (index, value) {
        let itemSection = $(this).data('section-index');
        divList.push(itemSection);
    });
    return divList;
}


function getSectionHtml(page,section , img){
   return  ` <div class="col-lg-3 col-md-4 item-section-modal">
                <button class="btn btn-chose-section" data-page="${page}" data-section="${section}">Sử dụng</button>
                <img class="img-item-section-modal" src="{{asset('${img}')}}" alt="">
            </div>`;
}
</script>
