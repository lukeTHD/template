<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Website</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700;800&family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <link href="{{ asset('landingpage/src/action-section.css ')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('landingpage/src/edit-text.css ')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('landingpage/src/manage-product.css ')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('landingpage/src/form-product.css ')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
    <!--end::Layout Skins -->
	<link rel="shortcut icon" href="{{ asset('img/logos/favicon.ico') }}" />
</head>

<body>

    @include($link, ['listSectionDefault' => isset($listSectionDefault)? $listSectionDefault : [] ])
    <!-- Begin::Sticky toolbar all page -->
    <!-- <ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">

        <li class="nav-item mb-2" id="btn-save-page">

            <i class="flaticon2-telegram-logo"></i> Save

        </li>

    </ul> -->
    @if(isset($list_content))
        <script>
            $( document ).ready(function() {
                let id = <?php echo $code; ?>;

                $.ajax({
                    url: "{{ route('page.getDetailPage') }}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: "GET",
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $.each(data.list_content, function(k,v){
                            if(v!= null){
                                var arr = Object.keys(v).map(function (key) { return v[key]; });
                                $('.edit-text , .edit-image').each(function(){
                                    if($(this).data("number-text") == (arr[0]))
                                    {
                                            $(this).attr("data-content", arr[1]);
                                            $(this).text(arr[1]);
                                            $(this).attr("src", arr[1]);
                                            let type = $(this).attr("data-type");
                                            if(type == 'image'){
                                                let height = $(this).attr("data-height");
                                                let width = $(this).attr("data-width");
                                                $(this).attr("height", height);
                                                $(this).attr("width", width);
                                            }
                                    }
                                });
                            }

                        })
                    }
                })
            });
        </script>
    @endif

    @if(isset($preview) && $preview == true)

    @else
    <!-- End::Sticky toolbar all page -->
    @include('pages.option-section', [ 'arrSection' => isset($arrSection)? $arrSection : [] , 'code' => isset($code)? $code : '' ])
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

        <li class="nav-item ">

            <i class="fa fa-facebook"></i> Delete

        </li>

        <li class="nav-item ">

            <i class="fa fa-facebook"></i> Add Session Top

        </li>

        <li class="nav-item">

            <i class="fa fa-facebook"></i> Add Session Bottom

        </li>

        <li class="nav-item">

            <i class=""></i> Close

        </li>
    </ul>
    @include('template.list_product_table' , [ 'listCampaign' => isset($listCampaign) ? $listCampaign : []])

    <!-- Edit:: Sticky toolbar delete session-->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="{{ asset('landingpage/src/jquery-contenteditable.js')}}"></script>
    <!-- Begin::Sweetalert  -->
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <!-- End::Sweetalert -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>

    @include('pages.edit-text-js')
    @include('pages.action-section-js')
    @include('pages.action-list-product-js' , [ 'listProduct' => isset($listProduct) ? $listProduct : [] ])
    @include('pages.form-product-js')
    <!-- End::Sticky toolbar image -->
    @endif

</body>

</html>
