<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <style>
        p,h1,h2,h3{
            margin:0;
            padding:0;
            padding-bottom: 5px;
            margin-bottom: 5px;
            line-height:1.5em;

        }
        table{
            border-collapse:collapse;
            font:11px;
            font-family:Verdana, Tahoma, sans-serif;
            color:#636866;
        }
        .header tr.top{
            border-top:8px solid #8DC63F;
            background:#E5F1FF;
        }

        .mast-head{
            padding:25px;
            text-align:center
        }
        .mail-body{
            width: 600px;
            text-align:left;
            border-collapse:collapse;
            font:11px;
            color:#636866;
        }
        .subject{
            font-family: Arial, sans-serif;
            font-size:22px;
            color:#FFF;
            font-weight:normal;
            margin:0px;
            padding:10px;
            text-decoration:none;
            border:none;
            background: #8DC63F;
        }
        .content{
            text-align:left;
            border:1px solid #F1F1F1;
            background:#FDFDFD;
            padding:20px;
            font-size:12px;
        }
        .mail-footer{
            text-align:left;
            line-height:16px;
            color:#999999;
            font-size:10px;
            padding:10px 0px;
        }

    </style>
</head>
<body>
<table class="header" width="100%" border="0">
    <tr class="top">
        <td class="mast-head">
            <table class="mail-body" width="600" border="0" align="center">
                <tr id="site_logo">
                    <td style="padding-bottom:15px;">
                        <img src="http://demo.dubaigot.com/public/images/green-oasis-mail-logo.png" width="283" height="58" alt="dubaigot.com" />
                    </td>
                </tr>
                <tr id="mail_heading">
                    <td class="subject"><?=$subject; ?></td>
                </tr>
                <tr>
                    <td class="content">
                        <!-- begin email content -->
                        <?=$emailContent; ?>
                        <!-- end email content -->
                    </td>
                </tr>
                <tr>
                    <td class="mail-footer">
                        <p>You are receiving this email because you are member at <a href="http://dubaigot.com" target="_blank">http://dubaigot.com (GreenOasis)</a> and have agreed to receive email from us regarding your GreenOasis account.</p>
                        <p style="line-height:16px;font-size:10px;margin-bottom:30px;">GreenOasis.com, <a href="mailto:support@dubaigot.com">support@dubaigot.com</a> &middot; Reach Us at +971 554 36292</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>