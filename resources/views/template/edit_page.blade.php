<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @include('./landingpage/page2/index')

    <!-- Begin::Sticky toolbar all page -->
    <ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">

        <li class="nav-item mb-2">

            <i class="flaticon2-drop"></i> Menu

        </li>


        <li class="nav-item mb-2">

            <i class="fas fa-bahai"></i> Setting

        </li>


        <li class="nav-item mb-2" id="btn-save-page">

            <i class="flaticon2-telegram-logo"></i> Save

        </li>


        <li class="nav-item">

            <i class="flaticon2-chat-1"></i> Delete

        </li>
    </ul>
    <!-- End::Sticky toolbar all page -->

    <!-- Begin::Sticky toolbar image -->
    <ul class="sticky-toolbar-setting-image nav flex-row ">

        <li class="nav-item " id="imgupload">

            <i class="fa fa-facebook"></i> Thay ảnh

        </li>

        <li class="nav-item ">

            <i class="fa fa-facebook"></i> Setting

        </li>

        <li class="nav-item " id="btn-save-page">

            <i class="flaticon2-telegram-logo"></i> Save

        </li>

        <li class="nav-item">

            <i class="fa fa-facebook"></i> Delete

        </li>

        <li class="nav-item" id="closeToolbarImg">

            <i class=""></i> Close

        </li>
    </ul>
    <!-- End::Sticky toolbar image -->
    <style>
    .sticky-toolbar {
        z-index: 999999;
        background: #dfdfdf;
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        color: #fff;
        border-radius: 8px;
        font-size: 1rem;
        text-align: center;
    }

    .sticky-toolbar li {
        padding: 5px 8px;
        text-align: center;
        cursor: pointer;
    }

    .sticky-toolbar-setting-image {
        z-index: 999999;
        background: #007bff;
        position: absolute;
        bottom: 0;
        left: 0;
        opacity: 0;
        color: #fff;
        border-radius: 5px;
        font-size: 1rem;
        text-align: left;
        transition: all 600ms;
        height: 34px;
    }

    .sticky-toolbar-setting-image li {
        padding: 5px 8px;
        text-align: center;
        cursor: pointer;
    }
    </style>
</body>
<!-- Begin::Sweetalert  -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<!-- End::Sweetalert -->
<script>
$(".edit-text").editable();
$(document).ready(function() {
    $('.btn-href').on('click', function(e) {
        e.preventDefault();

    });
    $('.btn-href').on('dblclick', function(e) {
        e.preventDefault();
        $(this).attr('contenteditable', 'true');
    });
    let tmpDataText = getAllDataText();
    let tmpDataImage = getAllDataImage();
    let tmp = tmpDataText.concat(tmpDataImage);

    // localStorage.setItem("page2", tmp);
    // console.log(tmp);
    // $(".edit-text").each(function(index){
    //     let that = $(this);
    //     let dataNumberText = that.data('number-text');
    //     that.text(tmp[dataNumberText]['content']);
    // });

    $(".edit-text").blur(function() {
        // console.log($(this).text());
        let that = $(this);
        let dataNumberText = that.data('number-text');
        let dataContent = that.text();
        let dataType = that.data('type');
        tmp[dataNumberText] = {
            'number-text': dataNumberText,
            'content': dataContent,
            'type': dataType
        };
        that.attr('data-content', dataContent);
        if (dataType == "button") {
            that.attr('contenteditable', 'false');
        }
    });

    $('#btn-save-page').on('click', function(e) {
        e.preventDefault();


    });

    $('#closeToolbarImg').on('click', function(e) {
        $(".sticky-toolbar-setting-image").css({
            "opacity": "0",
        });
    });

    $('.edit-image').on('click', function(e) {
        let that = $(this);
        var posP = that.offset();
        $(".sticky-toolbar-setting-image").css({
            "opacity": "1",
            "left": posP.left,
            "top": posP.top - 34
        });

        // $('#imgupload').on('click', function(e){
        //     // let that = $(this);
        //     console.log(that.data('number-text'));
        // });
        //remove all class selected-image
        that.parent().find('.edit-image').removeClass('selected-image');
        that.addClass('selected-image');
    });

    $('#imgupload').on('click', function(e) {
        swal({
            content: {
                element: "input",
                attributes: {
                    type: "file"
                },
            },
        }).then(async function(result) {
            console.log(result);

            if (result != '') { // result: path name file
                var formData = new FormData();
                console.log( $('.swal-content__input')[0].files[0]);
                formData.append('image', $('.swal-content__input')[0].files[0]);
                let string = result.split('\\').pop()
                $.ajax({
                    url: "{{ route('template.upLoadFile') }}/" + string,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: "POST",
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false,
                    data: formData,
                    success: function(image_url) {
                        console.log(image_url);
                        //debug
                        image_url = 'http://localhost/template/public/landingpage/page2/images/profile1.png';
                        $('.selected-image').find('img').attr("src",image_url);
                    }
                })
            }
        });
    });

});

function getAllDataText() {
    let arrEditText = [];
    $(".edit-text").each(function(index) {
        let that = $(this);
        let dataNumberText = that.data('number-text');
        let dataContent = that.data('content');
        let dataType = that.data('type');

        arrEditText[dataNumberText] = {
            'number-text': dataNumberText,
            'content': dataContent,
            'type': dataType
        }

    });
    return arrEditText;
}


function getAllDataImage() {
    let arrImage = [];
    $(".edit-image").each(function(index) {
        let that = $(this);
        let dataNumberImage = that.data('number-text');
        let dataContent = that.data('content');
        let dataType = that.data('type');
        arrImage[dataNumberImage] = {
            'number-text': dataNumberImage,
            'content': dataContent,
            'type': dataType
        }

    });
    return arrImage;
}
</script>

</html>
