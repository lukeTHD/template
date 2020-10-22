<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmProduct</title>
</head>
<body>
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
    <tbody>
    <tr>
        <td style="min-width: 512px; background-color: #f3f3f3;" align="center">
            <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                <tr>
                    <td align="center">
                        <table class="m_8079505300453937607w100" border="0" width="512" cellspacing="0" cellpadding="0"
                               align="center">
                            <tbody>
                            <tr>
                                <td class="m_8079505300453937607hide" style="padding-top: 10px; padding-bottom: 15px;"
                                    align="center">&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: white;" align="center">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td style="border-top: 3px solid #5867dd; border-radius: 4px 4px 0 0;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="m_8079505300453937607padt10m m_8079505300453937607padb10m"
                                    style="background-color: #fdfdfe; padding-top: 15px; padding-bottom: 15px;"
                                    align="center">
                                    <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
{{--                                            <td align="left" width="46"><a href="#" target="_blank" rel="noopener"--}}
{{--                                                                           data-saferedirecturl="#">--}}
{{--                                                    <img class="CToWUd" style="display: block; border: 0; font-size: 20px; font-weight: bold; font-family: sans-serif; color: #222222;"--}}
{{--                                                                                                         src="https://mydas.life/assets/media/logos/LOGO%20MYDAS%20FINAL-01.png"--}}
{{--                                                                                                         width="50"--}}
{{--                                                                                                         height="50"/>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
                                            <td align="left">
                                                <div
                                                    style="display: block; border: 0; font-size: 16px; font-weight: bold; font-family: sans-serif; color: #222222;">
                                                    LOTTO
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #f5f5f6;" align="center">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td style="border-top: 1px solid #f5f5f6;">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: white; padding-top: 25px; padding-bottom: 0;"
                                    align="center">
                                    <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <h1 class="m_8079505300453937607h1m"
                                                    style="font-size: 22px; line-height: 28px; letter-spacing: -.20px; margin: 10px 0 16px 0; font-family: Helvetica Neue,Arial,sans-serif; color: #5867dd; text-align: left;">
                                                    Purchase information
                                                </h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="m_8079505300453937607h2m"
                                                   style="margin: 0 0 15px 0; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #000000; text-align: left; line-height: 24px;">
                                                    Dear, {{$dataMail['display_name']}}

                                                    <br/> Status : <b style="color: green;">{{$dataMail['status']}}</b></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: white; padding-top: 15px; padding-bottom: 10px;"
                                    align="center">
                                    <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td style="font-size: 16px; font-family: Helvetica Neue,Arial,sans-serif; color: #969696; text-align: center;">
                                                The payment
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; font-size: 28px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: center; line-height: 1.2em; font-weight: 500;">
                                                {{$dataMail['total_price']}} USD
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: white; padding-top: 10px; padding-bottom: 10px;"
                                    align="center">
                                    <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td class="m_8079505300453937607h2m"
                                                style="font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; font-weight: bold; padding-bottom: 5px;">
                                                INFORMATION BOOKING
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    Game
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    {{$dataMail['game_name']}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    PRICE
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    {{numberFormat($dataMail['price'])}} USD
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    AMOUNT
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    {{numberFormat($dataMail['amount'])}} TICKET
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: white; padding-top: 10px; padding-bottom: 10px;"
                                    align="center">
                                    <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td class="m_8079505300453937607h2m"
                                                style="font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; font-weight: bold; padding-bottom: 5px;">
                                                INFORMATION GAME
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    DIAL  TIME
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    {{$dataMail['ROTATE_TIME']}} UTC
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    GAME CODE
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    {{$dataMail['GAME_CODE']}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    WINNING AMOUNT
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    {{$dataMail['TOTAL_VAULT']}} USD
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="70%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal; padding-right: 10px;">
                                                    CHECK THE ORDER
                                                </div>
                                            </td>
                                            <td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; font-family: Helvetica Neue,Arial,sans-serif; color: #3c4043; text-align: left; line-height: 1.55em;"
                                                width="50%">
                                                <div
                                                    style="color: #3c4043; margin: 0px; font-size: 15px; line-height: 22px; font-weight: normal;">
                                                    <a href="">Click</a>
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
                        <table class="m_8079505300453937607w100" border="0" width="512" cellspacing="0" cellpadding="0"
                               align="center">
                            <tbody>
                            <tr>
                                <td style="background-color: #5867dd; padding-top: 20px; padding-bottom: 20px;"
                                    align="center">
                                    <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table border="0" width="100%" cellspacing="0" cellpadding="0"
                                                       align="center">
                                                    <tbody>
                                                    <tr>
                                                        <td class="m_8079505300453937607h2m m_8079505300453937607stack-column-center"
                                                            style="padding: 0; margin: 0; text-align: center;">
                                                            <div
                                                                style="color: #f3e6ec; display: block; font-family: sans-serif; font-size: 13px; font-weight: bold; line-height: 19px; margin: 0px; padding: 0px;">
                                                                Lotto <a href="../../">http://lotto.com</a>
                                                            </div>
                                                            <div
                                                                style="margin: 5px 0 0 0; color: #f3e6ec; display: block; font-family: sans-serif; font-size: 12px; font-weight: normal; line-height: 20px;">
                                                                08 Hoa Hong Street, Ward 02, Phu Nhuan District, Ho Chi Minh City
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="m_8079505300453937607h2m m_8079505300453937607stack-column-center"
                                                            style="padding: 0; text-align: center;">
                                                            <div
                                                                style="color: #737373; margin: 10px 0; font-size: 12px; line-height: 22px; text-transform: uppercase; font-weight: bold;">
                                                                <a style="margin: 0; color: transparent; font-family: Roboto,Helvetica,sans-serif; font-weight: 400; line-height: 1.3; padding: 0; text-align: left;"
                                                                   href="https://www.facebook.com/" target="_blank"
                                                                   rel="noopener" data-saferedirecturl="#"> <img
                                                                        class="CToWUd"
                                                                        style="border: none; clear: both; display: inline-block; height: 26px; max-width: 100%; outline: 0; text-decoration: none; vertical-align: middle; width: 26px;"
                                                                        title="facebook"
                                                                        src="https://ci5.googleusercontent.com/proxy/sHQrymeM5KQ-F86v_-vxy9A48n8xUk_pHIj5y5doeQtxm6q7cB6Qd7psf-NcB-vPIWhAvnNrFDkpdJngemkbh_Cj8Uc5uCanGfO_W7iIJtGNASgVdruzlif4eMOc09K4DkxJQiqRPPBiYA=s0-d-e1-ft#https://static.mservice.io/images/s/momo-upload-api-191105150846-637085633269386698.png"
                                                                        width="26" height="26"/> </a>&nbsp;&nbsp; <a
                                                                    style="margin: 0; color: transparent; font-family: Roboto,Helvetica,sans-serif; font-weight: 400; line-height: 1.3; padding: 0; text-align: left;"
                                                                    target="_blank" rel="noopener"
                                                                    data-saferedirecturl="https://www.google.com/url?q=https://momo.vn/&amp;source=gmail&amp;ust=1589422506572000&amp;usg=AFQjCNHvRygstFAm1jtVdyJFnK2gxeCGCQ">
                                                                    <img class="CToWUd"
                                                                         style="border: none; clear: both; display: inline-block; height: 26px; max-width: 100%; outline: 0; text-decoration: none; vertical-align: middle; width: 26px;"
                                                                         title="myDas"
                                                                         src="https://ci4.googleusercontent.com/proxy/oORNn-LtrHgsiNysIssG4R2mAgOEV-mbe9v9I8tuWR4eBXMY7l-WyhPjxQGr7jYaxqsZsc_K60pwu3_RxJvGdpNDB_LKkYbCm78bcevmHe1OTfnG06uv_6r8uOud0DFbLa7qHKLxlIcz8A=s0-d-e1-ft#https://static.mservice.io/images/s/momo-upload-api-191105150920-637085633600093600.png"
                                                                         width="26" height="26"/> </a>&nbsp;&nbsp; <a
                                                                    style="margin: 0; color: transparent; font-family: Roboto,Helvetica,sans-serif; font-weight: 400; line-height: 1.3; padding: 0; text-align: left;"
                                                                    href="#" target="_blank" rel="noopener"> <img
                                                                        class="CToWUd"
                                                                        style="border: none; clear: both; display: inline-block; height: 26px; max-width: 100%; outline: 0; text-decoration: none; vertical-align: middle; width: 26px;"
                                                                        title="email"
                                                                        src="https://ci4.googleusercontent.com/proxy/TwzLO-58hn4IBTemaQnEL_-eYcHvphCO6iZNExO9wrbLMCiX2_tm5pw2YOHwkCqcUb2rh5CHfgG_3t-qEBDno6Cpf9SRhcYQnFs199rd9Y5kl_t8Xbn1QkWbIYUxJh-zAEdZRhSR3zLwRA=s0-d-e1-ft#https://static.mservice.io/images/s/momo-upload-api-191105150941-637085633813746314.png"
                                                                        width="26" height="26"/> </a>&nbsp;&nbsp; <a
                                                                    style="margin: 0; color: transparent; font-family: Roboto,Helvetica,sans-serif; font-weight: 400; line-height: 1.3; padding: 0; text-align: left;"
                                                                    href="#" target="_blank" rel="noopener"
                                                                    data-saferedirecturl="https://www.google.com/url?q=https://www.youtube.com/channel/UCKHHW-qL2JoZqcSNm1jPlqw&amp;source=gmail&amp;ust=1589422506573000&amp;usg=AFQjCNF0wtKCSnadl-I64O9_wtEHHW3Uyw">
                                                                    <img class="CToWUd"
                                                                         style="border: none; clear: both; display: inline-block; height: 26px; max-width: 100%; outline: 0; text-decoration: none; vertical-align: middle; width: 26px;"
                                                                         title="youtube"
                                                                         src="https://ci5.googleusercontent.com/proxy/bSmZZW4ot-BNb3kpBfVqJz8J7wjeQ7b5p9fX_KyVGuSbN9zDiQ0kzd2tdE80HTb5gFRbUHShGlgYitbj9_Rze9NZV449sDx8ptVr3pmPNZ3uTSIgdv4YfPd-egCdSR-L0fuqIz2IqmDGGw=s0-d-e1-ft#https://static.mservice.io/images/s/momo-upload-api-191105151010-637085634100025706.png"
                                                                         width="26" height="26"/> </a></div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px 0 10px;" align="center">
                                                <table border="0" width="100%" cellspacing="0" cellpadding="0"
                                                       align="center">
                                                    <tbody>
                                                    <tr>
                                                        <td style="border-top: 1px dashed #bf6191;">&nbsp;</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div
                                                    style="color: #e5c6d5; display: block; font-family: sans-serif; font-size: 11px; font-weight: normal; text-align: center; line-height: 17px; margin: 0px; padding: 0px;">
                                                    You are receiving email from<strong>Lotto</strong></div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #f5f5f6;" align="center">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td style="border-top: 1px solid #f5f5f6;">&nbsp;</td>
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
</body>
</html>
