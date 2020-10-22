<?php
return [
    "white_list" => [
        "127.0.0.1"
    ],
    "game_config" => [
        'type' => [
            'before' => 'before',
            'after' => 'after'
        ],
        "code" => [
            "jackpot" => "5",
            "first_prize" => "4",
            "second_prize" => "3",
            "third_prize" => 2,
            "keep_return" => "return",
            "for_company" => "company",
            "for_affiliator" => "parent",
            "for_affiliator_2" => "parent-2"
        ]
    ],
    "ticket" => [
        "type" => [
            "standard" => "standard",
            "3" => "3",
            "4" => "4"
        ],
        "status" => [
            "create" => "create",
            "success" => "success",
            "failed" => "failed"
        ],
        "status_label" => [
            "create" => "Available",
            "failed" => "Expired",
            "success" => "Winning",
        ],
        "color" => [
            "create" => "#ffc107",
            "success" => "#28a745",
            "failed" => "#dc3545"
        ]
    ],
    "background" => [
        "linear-gradient(to right, #EA255E , #FECA05);",
        "linear-gradient(to right, #F5D509 , #13ABEA);",
        "linear-gradient(to right, #07A5F2 , #842DAF);",
    ],
    "currency" => [
        'usdt' => 'EUSDT',
        'epoint' => 'EPO',
        'eticket' => 'ETI'
    ],
    'ratio' => [
        'EUSDT' => 50,
        'EPO' => 30,
        'ETI' => 20
    ],
    "credit" => [
        "type" => [
            "plus" => 'plus',
            "minus" => 'minus'
        ],
    ],
    "pagination" => [
        "ticket" => 10,
        "lottery" => 10,
        "commission" => 10
    ],
    "vault" => [
        "add_to_vault" => 1,
        "not_add_to_vault" => 0
    ],
    "group" => [
        "super_admin" => 1,
        "admin" => 2,
        "user" => 3
    ],
    "api_status_from_elegend" => [
        "error" => "Error",
        "success" => "Success"
    ],
    "request" => [
        "type" => [
            "withdraw" => "withdraw"
        ],
        "status" => [
            "pending" => "pending",
            "success" => "success",
            "fail" => "fail"
        ]
    ],
    "metabox" => [
        "home_text" => "home_text",
        "home_description" => "home_description"
    ],
    'flag' => [
        'vi' => '220-vietnam.svg',
        'en' => '226-united-states.svg'
    ],
    "mail_html" => '                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="center" style="min-width:512px;background-color:#f3f3f3">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <table class="m_8079505300453937607w100" align="center" width="512" border="0" cellspacing="0" cellpadding="0" style="background-color:#0e0e0f;background-image: url(\'./images/logo/bg.png\');background-size: 130%;">
                                                    <tbody>
                                                    <tr>
                                                        <td class="m_8079505300453937607hide" align="center" style="padding-top:10px;padding-bottom:15px">
                                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center" style="background-color:white">
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>

                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="m_8079505300453937607padt10m m_8079505300453937607padb10m" align="center" style="padding-top:15px;padding-bottom:15px">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>

                                                                    <td align="left" width="46">
                                                                        <a href="#" target="_blank" data-saferedirecturl="#"><img src="https://elegend.io/wp-content/uploads/2020/06/logo-elegend.png" width="50%" height="35" alt="jackpot" style="display:block;border:0;font-size:20px;font-weight:bold;font-family:sans-serif;color:#222222;" class="CToWUd"></a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style=" padding-top:25px;padding-bottom:0">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h1 class="m_8079505300453937607h1m" style="text-transform: uppercase;line-height:28px;letter-spacing:-.20px;margin:10px 0 16px 0;font-family:Helvetica Neue,Arial,sans-serif;color:#ffff;text-align:center">
                                                                            Confirm Reward</h1>
                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td>

                                                                        <p class="m_8079505300453937607h2m" style="margin:0 0 15px 0;font-size:15px;font-family:Helvetica Neue,Arial,sans-serif;color:#7c7c80;text-align:center;line-height:24px">
                                                                            Hello, You have successfully won order
                                                                            @TICKET_ID@.
                                                                        </p>

                                                                    </td>

                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">
                                                            <table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="border-top:1px solid #df523d">
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style=" padding-top:15px;padding-bottom:10px">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>

                                                                    <td style="font-weight:550;font-size:18px;font-family:Helvetica Neue,Arial,sans-serif;color:#df523d;text-align:center">

                                                                        Prize value
                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td style="font-weight:550;padding-top:5px;font-size:30px;font-family:Helvetica Neue,Arial,sans-serif;color:#7c7c80;text-align:center;line-height:1.2em;">

                                                                        @AMOUNT@ <span>USDT</span>
                                                                    </td>

                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style=" padding-top:10px;padding-bottom:10px">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>

                                                                    <td class="m_8079505300453937607h2m" style="text-transform:uppercase;font-size:18px;font-family:Helvetica Neue,Arial,sans-serif;color:#fff;text-align:left;font-weight:400;padding-bottom:10px;padding-left:15px;">
                                                                        DETAIL INFORMATION
                                                                    </td>
                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-top-left-radius: 8px;border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="70%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px">
                                                                            GAME
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-top-right-radius: 8px;border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;line-height:22px;font-size:15px">
                                                                            @GAME_NAME@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="70%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px">
                                                                            PRICE/TICKET
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;font-size:12px;line-height:22px;font-size:15px">
                                                                            @PRICE@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-bottom-left-radius: 8px;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="70%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px;">
                                                                            AMOUNT
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-bottom-right-radius: 8px;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;font-size:12px;line-height:22px;font-size:15px">
                                                                            @QUALITY@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-bottom-left-radius: 8px;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="70%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px;">
                                                                            TICKET
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-bottom-right-radius: 8px;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;font-size:12px;line-height:22px;font-size:15px">
                                                                            @TICKET@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="
                                            border-bottom-left-radius: 8px;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,
                                            sans-serif;color:#3c4043;text-align:right;line-height:1.55em;" width="70%" colspan="2">
                                                                        DETAIL: <a href="http://localhost/ltoto/public">VIEW
                                                                            MORE</a>
                                                                    </td>

                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style=" padding-top:30px;padding-bottom:10px">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>

                                                                    <td class="m_8079505300453937607h2m" style="text-transform:uppercase;font-size:18px;font-family:Helvetica Neue,Arial,sans-serif;color:#fff;text-align:left;font-weight:400;padding-bottom:10px;padding-left:15px;">
                                                                        CUSTOMER INFORMATION
                                                                    </td>
                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-top-left-radius: 8px;border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px">
                                                                            CUSTOMER NAME
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-top-right-radius: 8px;border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;font-size:12px;line-height:22px;font-size:15px">
                                                                            @CUSTOMERNAME@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="70%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px">
                                                                            EMAIL
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;font-size:12px;line-height:22px;font-size:15px">
                                                                            @EMAIL@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr style="background-color: rgba(9, 9, 9, 0.8);">
                                                                    <td style="border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="70%">

                                                                        <div style="font-weight: 550;color:#7c7c80;margin:0px;font-size:14px;line-height:22px;font-size:15px;padding-right:10px">
                                                                            PHONE
                                                                        </div>
                                                                    </td>
                                                                    <td style="border-bottom: 1px solid #383839;padding: 10px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:right;line-height:1.55em" width="50%">

                                                                        <div style="font-weight: 550;color:#ffc62c;margin:0px;font-size:12px;line-height:22px;font-size:15px">
                                                                            @PHONE@
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <table class="m_8079505300453937607w100" align="center" width="512" border="0" cellspacing="0" cellpadding="0">


                                                    <tbody>
                                                    <tr>
                                                        <td align="center" style="background-color:#0e0e0f;padding-top:20px;padding-bottom:20px">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                            <tbody>
                                                                            <tr>

                                                                                <td class="m_8079505300453937607h2m m_8079505300453937607stack-column-center" style="padding:0;margin:0;text-align:center">

                                                                                    <div style="color:#fff;display:block;font-family:sans-serif;font-size:13px;font-weight:700;line-height:19px;margin:0px;padding:0px">
                                                                                        Liên hệ với chúng tôi: <span style="color: #ffc62c !important;">support@ijackpot.elegend.io</span>
                                                                                    </div>

                                                                                    <div style="margin:5px 0 0 0;color:#5d5d64;display:block;font-family:sans-serif;font-size:12px;font-weight:normal;line-height:20px">
                                                                                        © 2020. All rights Reserved
                                                                                    </div>
                                                                                    <div style="margin:5px 0 0 0;color:#7c7c80;display:block;font-family:sans-serif;font-size:12px;font-weight:normal;line-height:20px">
                                                                                        Theo dõi
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>

                                                                                <td class="m_8079505300453937607h2m m_8079505300453937607stack-column-center" style="padding:0;text-align:center">

                                                                                    <div style="color:#737373;margin:10px 0;font-size:12px;line-height:22px;text-transform:uppercase;font-weight:bold">

                                                                                        <a href="https://www.facebook.com/" style="Margin:0;color:transparent;font-family:Roboto,Helvetica,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left" target="_blank" data-saferedirecturl="#">

                                                                                            <img height="32" width="32" style="border:none;clear:both;display:inline-block;height:26px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:26px" src="http://localhost/ltoto/public/Archive/images/examples/facebook.png" title="facebook" class="CToWUd">

                                                                                        </a>&nbsp;&nbsp;

                                                                                        <a href="" style="Margin:0;color:transparent;font-family:Roboto,Helvetica,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left" target="_blank" data-saferedirecturl="">

                                                                                            <img height="32" width="32" style="border:none;clear:both;display:inline-block;height:26px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:26px" src="http://localhost/ltoto/public/Archive/images/examples/twitter.png" title="twitter" class="CToWUd">

                                                                                        </a>&nbsp;&nbsp;

                                                                                        <a href="#" style="Margin:0;color:transparent;font-family:Roboto,Helvetica,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left" target="_blank">

                                                                                            <img height="32" width="32" style="border:none;clear:both;display:inline-block;height:26px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:26px" src="http://localhost/ltoto/public/Archive/images/examples/google-plus.png" title="google" class="CToWUd">

                                                                                        </a>&nbsp;&nbsp;

                                                                                        <a href="#" style="Margin:0;color:transparent;font-family:Roboto,Helvetica,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left" target="_blank" data-saferedirecturl="">

                                                                                            <img height="32" width="32" style="border:none;clear:both;display:inline-block;height:26px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:26px" src="http://localhost/ltoto/public/Archive/images/examples/telegram.png" title="youtube" class="CToWUd">

                                                                                        </a>&nbsp;&nbsp;
                                                                                        <a href="#" style="Margin:0;color:transparent;font-family:Roboto,Helvetica,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left" target="_blank" data-saferedirecturl="">

                                                                                            <img height="32" width="32" style="border:none;clear:both;display:inline-block;height:26px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:26px" src="http://localhost/ltoto/public/Archive/images/examples/youtube.png" title="youtube" class="CToWUd">

                                                                                        </a>

                                                                                    </div>

                                                                                </td>

                                                                            </tr>

                                                                            </tbody>
                                                                        </table>

                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="background-color:#f5f5f6">
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="border-top:1px solid #f5f5f6"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    '
];
