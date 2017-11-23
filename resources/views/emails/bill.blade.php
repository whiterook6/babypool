<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title></title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style type="text/css">
    #outlook a {
      padding: 0
    }

    .ReadMsgBody {
      width: 100%
    }

    .ExternalClass {
      width: 100%
    }

    .ExternalClass * {
      line-height: 100%
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%
    }

    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0;
      mso-table-rspace: 0
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: 0;
      text-decoration: none;
      -ms-interpolation-mode: bicubic
    }

    p {
      display: block;
      margin: 13px 0
    }
  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport {
        width: 320px
      }
      @viewport {
        width: 320px
      }
    }
  </style>
  <!--<![endif]-->
  <!--[if mso]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <!--[if lte mso 11]>
<style type="text/css">
  .outlook-group-fix {
    width:100% !important;
  }
</style>
<![endif]-->
  <!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);
    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);
  </style>
  <!--<![endif]-->
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-100 {
        width: 100%!important
      }
    }
  </style>
</head>

<body>
  <div class="mj-container">
    <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="margin:0 auto;max-width:600px">
      <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0;width:100%" align="center" border="0">
        <tbody>
          <tr>
            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0;padding:20px 0">
              <!--[if mso | IE]>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="vertical-align:top;width:600px;">
      <![endif]-->
              <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#ff3d7f;font-family:Source Sans Pro,Helvetica;font-size:36pt;line-height:22px;text-align:left">Baby Pool</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px">
                        <p style="font-size:1px;margin:0 auto;border-top:4px solid #ff3d7f;width:100%"></p>
                        <!--[if mso | IE]><table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0px auto;border-top:4px solid #FF3D7F;width:100%;" width="600"><tr><td style="height:0;line-height:0;"> </td></tr></table><![endif]-->
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#ff3d7f;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">{{$initials}}, you owe money to the Baby Pool!</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">Your bids: ${{$total_bid}}</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <table cellpadding="0" cellspacing="0" style="cellspacing:0;color:#000;font-family:Ubuntu,Helvetica,Arial,sans-serif;font-size:13px;line-height:22px;table-layout:auto" width="100%" border="0">
                          <tr style="border-bottom:1px solid #ecedee;text-align:left;padding:15px 0">
                            <th style="width:50%;color:#ff3d7f">Bidding date</th>
                            <th style="width:50%;color:#ff3d7f">Amount</th>
                          </tr>
@foreach($bids as $bid)
                          <tr>
                            <td style="width:50%">{{$bid['date_string']}}</td>
                            <td style="width:50%">${{$bid['amount']}}</td>
                          </tr>
@endforeach
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">Your payments: ${{$total_paid}}</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <table cellpadding="0" cellspacing="0" style="cellspacing:0;color:#000;font-family:Ubuntu,Helvetica,Arial,sans-serif;font-size:13px;line-height:22px;table-layout:auto" width="100%" border="0">
                          <tr style="border-bottom:1px solid #ecedee;text-align:left;padding:15px 0">
                            <th style="width:50%;color:#ff3d7f">Payment Date</th>
                            <th style="width:50%;color:#ff3d7f">Amount</th>
                          </tr>
@if($payments && count($payments) > 0)
  @foreach($payments as $payment)
                          <tr>
                            <td style="width:50%">{{$payment['date_string']}}</td>
                            <td style="width:50%">${{$payment['amount']}}</td>
                          </tr>
  @endforeach
@else
                          <tr>
                            <td style="width:50%">None</td>
                          </tr>
@endif
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">You can pay online with the Babypool.</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="center">
                        <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate" align="center" border="0">
                          <tbody>
                            <tr>
                              <td style="border:none;border-radius:3px;color:#fff;cursor:auto;padding:10px 25px" align="center" valign="middle" bgcolor="#FF3D7F"><a href="{{$me_url}}" style="text-decoration:none;background:#ff3d7f;color:#fff;font-family:Source Sans Pro,Helvetica;font-size:13px;font-weight:400;line-height:120%;text-transform:none;margin:0" target="_blank">View Your Bids and Make a Payment</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
      </td></tr></table>
      <![endif]-->
  </div>
</body>

</html>