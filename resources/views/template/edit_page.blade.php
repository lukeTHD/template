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

        <li class="nav-item">

            <i class="fa fa-facebook"></i> Delete

        </li>

        <li class="nav-item" id="closeToolbarImg">

            <i class=""></i> Close

        </li>
    </ul>
    <!-- Edit-text -->

    <!-- Begin::Sticky toolbar delete session -->
    <ul class="sticky-toolbar-setting-session nav flex-row ">

        <li class="nav-item " >

            <i class="fa fa-facebook"></i> Delete

        </li>

        <li class="nav-item ">

            <i class="fa fa-facebook"></i> Add Session Top

        </li>

        <li class="nav-item">

            <i class="fa fa-facebook"></i> Add Session Bottom

        </li>

        <li class="nav-item" >

            <i class=""></i> Close

        </li>
    </ul>
    <!-- Edit:: Sticky toolbar delete session-->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="{{ asset('landingpage/src/jquery-contenteditable.js')}}"></script>
    <!-- End::Sticky toolbar image -->
    <style>
    .sticky-toolbar {
        z-index: 9;
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
        z-index: 9;
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

    .edit-section{
        transition: all 600ms;
    }
    /* .edit-section:hover{
        border: 2px solid red;
    } */
    .sticky-toolbar-setting-session{
        z-index: 9;
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
    $('.edit-text-double-click').on('dblclick', function(e) {
        e.preventDefault();
        $(this).attr('contenteditable', 'true');
    });

    var arrData = []
    let tmpDataText = getAllDataText(arrData);
    let tmpDataImage = getAllDataImage(arrData);

    console.log(arrData);
    $(".edit-text").blur(function() {
        // console.log($(this).text());
        let that = $(this);
        let dataNumberText = that.data('number-text');
        let dataContent = that.text();
        let dataType = that.data('type');
        arrData[dataNumberText] = {
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
        swal({
            content: {
                element: "input",
                attributes: {
                    type: "text",
                },
            },
        });

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

        that.parent().find('.edit-image').removeClass('selected-image');
        // $(".edit-image").removeClass("selected-image");
        that.addClass('selected-image');
    });

    $('#imgupload').on('click', function(e) {
        swal({
            content: {
                element: "input",
                attributes: {
                    type: "file",
                    accept: 'image/*',
                },
            },
        }).then(async function(result) {
            if (result != '') { // result: path name file
                var formData = new FormData();
                formData.append('image', $('.swal-content__input')[0].files[0]);
                let string = result.split('\\').pop()
                $.ajax({
                    url: "{{ route('template.upLoadFile') }}/" + string,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        let destinationPath = "{{url('/')}}/" + data
                            .destinationPath;
                        let nameImg = data.nameImg;
                        $('.selected-image').attr("src", data.link);
                        let height = $('.selected-image').data("height");
                        let width  = $('.selected-image').data("width");
                        $('.selected-image').css({"max-height" : height, "max-width": width});
                        // $('.selected-image').css("max-width", width);
                        $('.selected-image').data("content", data.link);
                        // $(".edit-image").removeClass("selected-image");
                        // console.log(getAllDataImage(arrData));
                    }
                })
            }
        });
    });
    console.log(arrData);
});

function getAllDataText(arrData) {
    $(".edit-text").each(function(index) {
        let that = $(this);
        let dataNumberText = that.data('number-text');
        let dataContent = that.data('content');
        let dataType = that.data('type');

        arrData[dataNumberText] = {
            'number-text': dataNumberText,
            'content': dataContent,
            'type': dataType
        }
    });

    return arrData;
}

function getAllDataImage(arrData) {
    $(".edit-image").each(function() {
        let that = $(this);
        let dataNumberImage = that.data('number-text');
        let dataContent = that.data('content');
        let dataType = that.data('type');
        arrData[dataNumberImage] = {
            'number-text': dataNumberImage,
            'content': dataContent,
            'type': dataType
        }
    });
    return arrData;
}
</script>

</html>
