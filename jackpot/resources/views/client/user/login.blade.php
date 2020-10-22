<!DOCTYPE html>
<html>
<head>
    <title>E-Legend | eJackpot | Login</title>
    <style>
        body {
            position: relative;
            margin: 0;
            padding: 0;
            background-color: black;
        }

        .fill-white path {
            fill: white !important;
        }

        .icon-center {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            flex-direction: row;
        }

        .loading-text {
            font-size: 21px;
            font-family: monospace;
            color: white;
        }

        .bg {
            background-image: url({{ asset('images/loading.gif') }});
            background-size: cover;
            width: 100%;
            height: 100%;
            position: fixed;
            transform: scale(.3);
        }
    </style>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}"/>
</head>
<body>
<div class="icon-center">

    <svg width="63" height="34" viewBox="0 0 63 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M19.6033 28.6911H8.43188L18.2209 30.2717L17.7482 30.8105H12.5589L17.1078 31.5424L15.1612 33.7736L54.9881 33.5805L61.4531 26.1701L21.6313 26.3632L19.6033 28.6911Z"
            fill="#EC1C24"/>
        <path
            d="M46.541 21.0571L53.006 13.6467L13.1842 13.8399L12.0812 15.1054H0L10.587 16.8132L10.2312 17.2249H4.12704L9.47389 18.0889L6.71406 21.2502L46.541 21.0571Z"
            fill="#EC1C24"/>
        <path
            d="M20.6709 2.88181L20.2542 3.35957H14.6227L19.5579 4.15753L16.5439 7.60859L56.3708 7.41545L62.8358 0L23.014 0.198221L22.1042 1.24015H10.4957L20.6709 2.88181Z"
            fill="#EC1C24"/>
    </svg>
    <svg width="125" class="fill-white" height="14" viewBox="0 0 125 14" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M118.363 0.246277C122.027 0.246277 125.001 3.21449 125.001 6.8841C125.001 8.51052 124.416 10.0099 123.43 11.1636C123.313 11.3059 123.186 11.4482 123.049 11.5804C121.85 12.79 120.193 13.5321 118.363 13.5321H112.706C112.162 13.5321 111.72 13.0899 111.72 12.5461V1.23229C111.72 0.688459 112.162 0.246277 112.706 0.246277H118.363ZM114.088 11.1636H118.368C120.721 11.1636 122.637 9.24749 122.637 6.8841C122.637 4.53087 120.721 2.61475 118.368 2.61475H114.088V11.1636Z"
            fill="#0F2345"/>
        <path
            d="M81.1683 3.82436V5.0645H90.9472C91.491 5.0645 91.9332 5.50668 91.9332 6.05051V6.44695C91.9332 6.99079 91.491 7.43297 90.9472 7.43297H81.1683V9.94375C81.1683 10.6146 81.7172 11.1687 82.3932 11.1687H91.0996C91.6435 11.1687 92.0857 11.6108 92.0857 12.1547V12.546C92.0857 13.0899 91.6435 13.532 91.0996 13.532H82.3881C80.411 13.532 78.8049 11.926 78.8049 9.94884V3.82436C78.8049 1.84724 80.411 0.24115 82.3881 0.24115H91.0996C91.6435 0.24115 92.0857 0.683334 92.0857 1.22717V1.62361C92.0857 2.16744 91.6435 2.60962 91.0996 2.60962H82.3881C81.7121 2.60962 81.1683 3.15346 81.1683 3.82436Z"
            fill="#0F2345"/>
        <path
            d="M47.2422 3.82436V5.0645H57.0211C57.5649 5.0645 58.0071 5.50668 58.0071 6.05051V6.44695C58.0071 6.99079 57.5649 7.43297 57.0211 7.43297H47.2422V9.94375C47.2422 10.6146 47.7912 11.1687 48.4671 11.1687H57.1736C57.7174 11.1687 58.1596 11.6108 58.1596 12.1547V12.546C58.1596 13.0899 57.7174 13.532 57.1736 13.532H48.4621C46.4849 13.532 44.8788 11.926 44.8788 9.94884V3.82436C44.8788 1.84724 46.4849 0.24115 48.4621 0.24115H57.1736C57.7174 0.24115 58.1596 0.683334 58.1596 1.22717V1.62361C58.1596 2.16744 57.7174 2.60962 57.1736 2.60962H48.4621C47.7861 2.60962 47.2422 3.15346 47.2422 3.82436Z"
            fill="#0F2345"/>
        <path
            d="M2.65776 3.82515V5.06529H12.4366C12.9804 5.06529 13.4226 5.50747 13.4226 6.05131V6.44775C13.4226 6.99158 12.9804 7.43376 12.4366 7.43376H2.65776V9.94455C2.65776 10.6154 3.20668 11.1694 3.88266 11.1694H12.5891C13.1329 11.1694 13.5751 11.6116 13.5751 12.1555V12.5468C13.5751 13.0907 13.1329 13.5328 12.5891 13.5328H3.87757C1.90045 13.5328 0.294373 11.9267 0.294373 9.94963V3.82515C0.294373 1.84803 1.90045 0.241943 3.87757 0.241943H12.5891C13.1329 0.241943 13.5751 0.684127 13.5751 1.22796V1.6244C13.5751 2.16823 13.1329 2.61042 12.5891 2.61042H3.87757C3.20159 2.61042 2.65776 3.15425 2.65776 3.82515Z"
            fill="#0F2345"/>
        <path
            d="M41.8499 12.1394V12.5359C41.8499 13.0797 41.4077 13.5219 40.8639 13.5219H35.1206C34.4497 13.5219 33.8195 13.3643 33.2604 13.0899C32.4167 12.6782 31.7356 12.0022 31.3341 11.1585C31.0495 10.5994 30.8919 9.96408 30.8919 9.29318V1.22717C30.8919 0.683334 31.3341 0.24115 31.8779 0.24115H32.2744C32.8182 0.24115 33.2604 0.683334 33.2604 1.22717V9.53207C33.3722 10.3758 34.0431 11.0467 34.8868 11.1585H40.869C41.4077 11.1534 41.8499 11.5956 41.8499 12.1394Z"
            fill="#0F2345"/>
        <path
            d="M108.548 1.22722V12.1852C108.548 13.278 107.293 13.898 106.429 13.2271L106.174 13.034L97.6358 3.7075V12.541C97.6358 13.0848 97.1936 13.527 96.6497 13.527H96.2482C95.7044 13.527 95.2622 13.0848 95.2622 12.541V1.55758C95.2622 0.464828 96.5176 -0.155242 97.3816 0.515656L97.6358 0.708792L106.174 10.0353V1.22722C106.174 0.683381 106.617 0.241198 107.16 0.241198H107.562C108.106 0.241198 108.548 0.683381 108.548 1.22722Z"
            fill="#0F2345"/>
        <path
            d="M75.7709 6.96539C75.7709 6.92981 75.776 6.89423 75.776 6.85865H75.7709V5.31864H69.4939C68.9501 5.31864 68.5079 5.76082 68.5079 6.30466V6.77225C68.5079 7.31609 68.9501 7.75827 69.4939 7.75827H73.3211C72.9145 9.69981 71.1915 11.1585 69.1331 11.1585H68.2081H67.9793C65.7024 11.1585 63.71 9.4406 63.5626 7.17378C63.3949 4.68332 65.3771 2.60456 67.832 2.60456H74.7137C75.2576 2.60456 75.6997 2.16237 75.6997 1.61854V1.2221C75.6997 0.678266 75.2576 0.236084 74.7137 0.236084H68.2081H68.02C64.4419 0.236084 61.3619 2.98575 61.1941 6.55879C61.0162 10.3758 64.0556 13.527 67.832 13.527H68.2081H68.757H69.1331C72.6655 13.527 75.5473 10.7671 75.7557 7.29068C75.7607 7.26526 75.7709 7.23985 75.7709 7.21444V6.96539Z"
            fill="#0F2345"/>
        <path
            d="M26.3075 8.12934H18.7294C18.3686 8.12934 18.0738 7.83456 18.0738 7.47369V6.28437C18.0738 5.92351 18.3686 5.62872 18.7294 5.62872H26.3075C26.6684 5.62872 26.9632 5.92351 26.9632 6.28437V7.47369C26.9632 7.83456 26.6735 8.12934 26.3075 8.12934Z"
            fill="#0F2345"/>
    </svg>

</div>

<div class="bg">

</div>

<script src="{{ asset('js/oidc-client.min.js') }}"></script>
<script>
    Oidc.Log.logger = console;
    Oidc.Log.level = Oidc.Log.INFO;

    var settings = {
        authority: 'https://id.elegend.io',
        client_id: 'jackpot.elegend.io',
        redirect_uri: window.location.origin + '/callback',
        silent_redirect_uri: window.location.origin + '/silentcallback',
        response_type: 'code',
        scope: 'openid profile offline_access',
        post_logout_redirect_uri: window.location.origin + '/logout',
        loadUserInfo: true
    };
    var client = new Oidc.OidcClient(settings);

    client.createSigninRequest().then(function (req) {
        window.location.replace(req.url);
    }).catch(function (err) {
        log(err);
    });
</script>
</body>
</html>
