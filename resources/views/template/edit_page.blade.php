<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('landingpage/src/action-section.css ')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('landingpage/src/edit-text.css ')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</head>

<body>

    @include($link, ['listSectionDefault' => isset($listSectionDefault)? $listSectionDefault : [] ])

    <!-- Begin::Sticky toolbar all page -->
    <!-- <ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">

        <li class="nav-item mb-2" id="btn-save-page">

            <i class="flaticon2-telegram-logo"></i> Save

        </li>

    </ul> -->
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
    <!-- Edit:: Sticky toolbar delete session-->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="{{ asset('landingpage/src/jquery-contenteditable.js')}}"></script>
    <!-- Begin::Sweetalert  -->
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <!-- End::Sweetalert -->

    @include('pages.edit-text-js')
    @include('pages.action-section-js')
    <!-- End::Sticky toolbar image -->
    @endif
</body>

</html>
