<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;}
    </style>
</head>
<body style="margin:0;padding:0;">
<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
        <td align="center" style="padding:0;">
            <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                <tr>
                    <td align="center" style="padding:40px 0 30px 0;background:#4EA069;">
                        <img src="{{ $message->embed(asset('web/img/logo-white.png')) }}" alt="" width="200" style="height:auto;display:block;" />
                    </td>
                </tr>
                <tr>
                    <td style="padding:36px 30px 42px 30px;">
                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                                <td style="padding:0 0 36px 0;color:#153643;" align="center">
                                    <img src="{{ getImagePathFromDirectory( $news->main_image , 'News') }}" width="200" >
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sanCreating Email Magics-serif;">{!! $news->description !!}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:30px;background:#4EA069">
                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                            <tr style="color:#B89E72">
                                <td style="padding:0;width:50%;margin: 0 20px" align="center">
                                    <p style="margin:0;font-size:14px;line-height:16px;color:white;font-family:Arial,sans-serif;">
                                        &reg; CodeCar {{ date('Y') }}
                                    </p>
                                </td>
                                <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                        <tr>
                                            @if ( settings()->getSettings('facebook_url'))
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="{{  settings()->getSettings('facebook_url') }}" target="_blank"><img src="{{  $message->embed(asset('web/social_icons/facebook.png'))  }}" alt="facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                            @endif
                                            @if ( settings()->getSettings('twitter_url'))
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="{{  settings()->getSettings('twitter_url') }}" target="_blank"><img src="{{  $message->embed(asset('web/social_icons/twitter.png'))  }}" alt="twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                            @endif
                                            @if ( settings()->getSettings('youtube_url'))
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="{{  settings()->getSettings('youtube_url') }}" target="_blank"><img src="{{  $message->embed(asset('web/social_icons/youtube.png'))  }}" alt="youtube" width="38" style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                            @endif
                                            @if ( settings()->getSettings('instagram_url'))
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="{{ settings()->getSettings('instagram_url') }}" target="_blank"><img src="{{  $message->embed(asset('web/social_icons/instagram.png'))  }}" alt="instagram" width="38" style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                            @endif
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
