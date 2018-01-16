<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('email_title')</title>
    <link href="{{ base_url('assets/backend/css/email/styles.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/backend/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
</head>

<body>

<table style="background-color: #f6f6f6; width: 100%;">
    <tr>
        <td></td>
        <td style="display: block !important; max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600">
            <div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="background: #fff;border: 1px solid #e9e9e9;
                border-radius: 3px;">
                    @yield('content')
                </table>
                <div style="width: 100%;clear: both;color: #999;padding: 20px;">
                    <table width="100%">
                        <tr>
                            <td style="font-size: 12px;text-align: center;padding: 0 0 20px;vertical-align: top;"><a style="color:#FF9800;" href="{{ site_url() }}">max-bread.cl</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>
