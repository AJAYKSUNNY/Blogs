<!DOCTYPE html>
<html lang="en">
<?php  
$url=config('api_urls.base_url');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <title>Set Password / Reset Password</title>
</head>
<body style="margin:0;">
<table width="900" align="center" cellpadding="0" cellspacing="0" style="background:#f4f4f4;font-family: 'Open Sans', sans-serif;">
    <tr>
        <td style="padding:30px 0;">
            <table width="600" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="padding:10px 0 20px;">
                        <img src="https://i.imgur.com/Ss0C2JV.png">
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" style="background:#fff;padding:90px 60px;" width="100%">
                            <tr>
                                <td>
                                    <span style="display:block;color:#444;margin-bottom:5px;">Hi {{$firstname}},</span>
                                    <span style="display:block;color:#444;margin-bottom:35px;">Your simreka account is almost active. 
                                    </span>
                                    <span style="display:block;color:#444;margin-bottom:5px;">Set Password and get started 
                                        <a target="_blank" href="http://127.0.0.1:8001/setpassword/{{$uuid}}">
                                          <button  class="btn" style="background-color: #663399; width: 25%; height: 40px; border-radius: 20px; color: white; ">Set Password</button>
                                        </a>
                                    </span>
                                    </span>
                                     <span style="display:block;color:#444;margin-bottom:35px;">For any further assistance please get in touch with support@simreka.com. 
                                    </span>


                                    <span style="display:block;color:#444;">Have an awesome day,</span>
                                    <span style="display:block;color:#444;margin-top:5px;">Team</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="display:block;margin-top:30px;">
                        <a href="https://www.linkedin.com" title=""><img src="https://i.imgur.com/RHQCPtm.png" href=""></a>
                        <a href="https://www.instagram.com" title=""><img src="https://i.imgur.com/Ss0C2JV.png" href=""></a>
                        <a href="https://www.facebook.com" title=""><img src="https://i.imgur.com/QrMMr7m.png" href=""></a>
                        <a href="https://twitter.com" title=""><img src="https://i.imgur.com/oKcoxwU.png" href=""></a>
                        <span style="display:block;color:#444;font-size:12px;margin-top:10px;">© Omega Technologies, </span>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>




</body>

</html>
