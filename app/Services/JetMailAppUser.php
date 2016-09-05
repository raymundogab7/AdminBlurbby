<?php
namespace Admin\Services;

use Mail;
use Mailjet\Client;
use Mailjet\Resources;

/**
 * A service class to send email via MailJet
 *
 * @author gab
 * @package Merchant\Services
 */
class JetMailAppUser
{
    /**
     * Send mail to guest for password reset
     *
     * @param array $data
     * @return void
     */
    public function send($data)
    {
        // use your saved credentials
        $mj = new Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'));
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];

        // Resources are all located in the Resources class
        $response = $mj->get(Resources::$Contact);
        $html = '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<title></title>

<style type="text/css">

div, p, a, li, td { -webkit-text-size-adjust:none; }

*{
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
}

.ReadMsgBody
{width: 100%; background-color: #ffffff;}
.ExternalClass
{width: 100%; background-color: #ffffff;}
body{width: 100%; height: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
html{width: 100%; background-color: #ffffff;}

p {padding: 0!important; margin-top: 0!important; margin-right: 0!important; margin-bottom: 0!important; margin-left: 0!important; }

.hover:hover {opacity:0.85;filter:alpha(opacity=85);}

.image77 img {width: 77px; height: auto;}
.avatar125 img {width: 125px; height: auto;}
.icon61 img {width: 61px; height: auto;}
.logo img {width: 251px; height: auto;}
.icon18 img {width: 18px; height: auto;}

</style>

<!-- @media only screen and (max-width: 640px)
           {*/
           -->
<style type="text/css"> @media only screen and (max-width: 640px){
        body{width:auto!important;}
        table[class=full2] {width: 100%!important; clear: both; }
        table[class=mobile2] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both; }
        table[class=fullCenter2] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=fullCenter2] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=pad15] {width: 100%!important; padding-left: 15px; padding-right: 15px; clear: both;}

} </style>
<!--

@media only screen and (max-width: 479px)
           {
           -->
<style type="text/css"> @media only screen and (max-width: 479px){
        body{width:auto!important;}
        table[class=full2] {width: 100%!important; clear: both; }
        table[class=mobile2] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both; }
        table[class=fullCenter2] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=fullCenter2] {width: 100%!important; text-align: center!important; clear: both; }
        table[class=full] {width: 100%!important; clear: both; }
        table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both; }
        table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=pad15] {width: 100%!important; padding-left: 15px; padding-right: 15px; clear: both;}
        .erase {display: none;}

        }
} </style>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full2" style="height: 100%;">
    <tr>
        <td align="center" style="background-color:#eee;" id="not6">

            <!-- Mobile Wrapper -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2">
                <tr>
                    <td width="100%" align="center">

                        <div class="sortable_inner ui-sortable">
                        <!-- Space -->
                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full2" object="drag-module-small">
                            <tr>
                                <td width="600" height="50"></td>
                            </tr>
                        </table><!-- End Space -->

                        <!-- Space -->
                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full2" object="drag-module-small">
                            <tr>
                                <td width="600" height="50"></td>
                            </tr>
                        </table><!-- End Space -->

                        <!-- Start Top -->
                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2" bgcolor="#00b0ed" style="border-top-left-radius: 5px; border-top-right-radius: 5px; background-color: rgb(0, 176, 237);" object="drag-module-small">
                            <tr>
                                <td width="600" valign="middle" align="center" class="logo">

                                    <!-- Header Text -->
                                    <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                        <tr>
                                            <td width="100%" height="30"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"><span ><img style="max-width: 251px;" src="http://www.blurbes.com/edm/logo.png" width="251" alt="" border="0" ></span></td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="30"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        </div>

                        <!-- Mobile Wrapper -->
                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full2" object="drag-module-small" style="-webkit-border-bottom-left-radius: 5px; -moz-border-bottom-left-radius: 5px; border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px; -moz-border-bottom-right-radius: 5px; border-bottom-right-radius: 5px;">
                            <tr>
                                <td width="600" align="center" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; background-color: rgb(255, 255, 255);" bgcolor="#ffffff">

                                    <div class="sortable_inner ui-sortable">

                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2" bgcolor="#ffffff"object="drag-module-small" style="background-color: rgb(255, 255, 255);">
                                        <tr>
                                            <td width="600" valign="middle" align="center">

                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="middle" width="100%" style="padding-top: 30px; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <span style="font-size: 20px;">Welcome to Blurbes, ' . $first_name . ' ' . $last_name . '!</span>
                                                            <br><br>
                                                            We can' . "'" . 't wait for you to enjoy all the great offers with Blurbes. But first, let us walk you through some of our key features.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="middle" width="100%" style="padding-top: 15px; padding-bottom: 30px; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <hr><br>
                                                            <span style="font-size: 18px;font-weight: bold;">Benefits of Blurbes</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="600" valign="middle" align="center">
                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="top" width="50%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 75px;" width="75" src="http://www.blurbes.com/edm/misc/discount-icon.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Discounts</strong><br>Enjoy up to 50% off in F&B.</p>
                                                        </td>
                                                        <td valign="top" width="50%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 75px;" width="75" src="http://www.blurbes.com/edm/misc/thumbsup.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Free & Easy</strong><br>No more paying for any coupons in advance.</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="600" valign="middle" align="center" style="padding: 40px 0;">
                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <span style="font-size: 18px;font-weight: bold;">How to use?</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="600" valign="middle" align="center" style="padding-bottom: 40px;">
                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="top" width="33%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 75px;" width="75" src="http://www.blurbes.com/edm/misc/list-icon.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Search</strong><br>Search through our blurbs or find out what' . "'" . 's near you.</p>
                                                        </td>
                                                        <td valign="top" width="33%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 75px;" width="75" src="http://www.blurbes.com/edm/misc/flash-screen-icon.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Flash</strong><br>Flash the blurb at the counter to redeem your discount.</p>
                                                        </td>
                                                        <td valign="top" width="33%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 75px;" width="75" src="http://www.blurbes.com/edm/misc/add-to-my-blurbs-icon.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Add</strong><br>Add your favourite eatery or Blurb to your wallet to stay informed.</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2" bgcolor="#e6f7fe" object="drag-module-small" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; background-color:#e6f7fe;">
                                        <tr>
                                            <td width="600" valign="middle" align="center" style="padding: 30px 0;">
                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <span style="font-size: 18px;font-weight: bold;">Need Help?</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="600" valign="middle" align="center" style="padding-bottom:35px;">
                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="top" width="50%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 50px;" width="50" src="http://www.blurbes.com/edm/misc/message.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Email</strong><br>(<a style="color:#00b0ed; text-decoration: none;" href="mailto:info@blurbes.com">info@Blurbes.com</a>)</p>
                                                        </td>
                                                        <td valign="top" width="50%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <img style="max-width: 50px;" width="50" src="http://www.blurbes.com/edm/misc/clock.png">
                                                            <br><p style="padding:0 15px!important;"><strong>Available</strong><br>(9am to 8pm)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>

                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2" bgcolor="#ffffff"object="drag-module-small" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; background-color: rgb(255, 255, 255);">
                                        <tr>
                                            <td width="600" valign="middle" align="center" style="-webkit-border-bottom-left-radius: 5px; -moz-border-bottom-left-radius: 5px; border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px; -moz-border-bottom-right-radius: 5px; border-bottom-right-radius: 5px;">

                                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter2">
                                                    <tr>
                                                        <td valign="middle" width="33%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: rgb(63, 67, 69); line-height: 24px;" >
                                                            <br>
                                                            <a style="color:#00b0ed; text-decoration: none;" href="http://www.blurbes.com">Website</a> | <a style="color:#00b0ed; text-decoration: none;" href="https://www.facebook.com/Blurbes-275110806191013/">Facebook</a>
                                                            <br>
                                                            Copyright Blurbes. All rights reserved.
                                                            <br>
                                                            You are receiving this email because you have registered with Blurbes.
                                                            <br><br>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                </td>
                            </tr>
                        </table>

                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full2" object="drag-module-small">
                            <tr>
                                <td width="600" height="30"></td>
                            </tr>
                        </table>


                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2" object="drag-module-small">
                            <tr>
                                <td width="600" height="30"></td>
                            </tr>
                        </table>

                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile2" object="drag-module-small">
                            <tr>
                                <td width="600" height="29"></td>
                            </tr>
                            <tr>
                                <td width="600" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div>
        </td>
    </tr>
</table>
</div>
</body> <style>body{ background: none !important; } </style>
';
        $body = [
            'FromEmail' => "gabriel@bilinear.ph",
            'FromName' => "Blurbes",
            'Subject' => "Welcome to Blurbes, " . $first_name . " " . $last_name . "!",
            'Html-part' => $html,
            'Recipients' => [['Email' => $data['email']]],
        ];

        $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && $response->getData();

    }
}
