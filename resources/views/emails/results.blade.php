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
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
  <style type="text/css">
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
                        <div style="cursor:auto;color:#ff3d7f;font-family:Source Sans Pro,Helvetica;font-size:36pt;line-height:22px;text-align:left">Baby Pool Results</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px">
                        <p style="font-size:1px;margin:0 auto;border-top:4px solid #ff3d7f;width:100%"></p>
                        <!--[if mso | IE]><table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0px auto;border-top:4px solid #FF3D7F;width:100%;" width="600"><tr><td style="height:0;line-height:0;"> </td></tr></table><![endif]-->
                      </td>
                    </tr>
@if ($is_winner)
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#ff3d7f;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">{$your_intials}, your bid for ${$left_bid['value']} on {$left_bid['date_string']} was the winning bid!</div>
                      </td>
                    </tr>
  @if ($sharing)
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">The total pool size was ${$total_pot}. The parents will take their half, ${$parent_pot}. You will split the pool with ${$right_bid['initials'], who bid ${$right_bid['value']} for {$right_bid['date_string']}. <span style="color:#ff3d7f">You will both take home ${$winner_pot}.</span>                          Congratulations!</div>
                      </td>
                    </tr>
  @else
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">The total pool size was ${$total_pot}. The parents will take their half, ${$parent_pot}. <span style="color:#ff3d7f">You will take home the remaining ${$winner_pot}.</span> Congratulations!</div>
                      </td>
                    </tr>
  @endif
@elseif ($sharing)
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">Sorry, {$your_intials}, but you did not win the baby pool. The winners were <span style="color:#ff3d7f">{$left_bid['initials]}</span>, with a bid of ${$left_bid['value']} on {$left_bid['date_string']}, and <span style="color:#ff3d7f">{$right_bid['initials]}</span>,
                          with a bid of ${$right_bid['value']} on {$right_bid['date_string']}. Since the parents will take their half, ${$parent_pot}, this means {$left_bid['initials]} and {$right_bid['initials]} will split the remaining <span style="color:#ff3d7f">$95!</span></div>
                      </td>
                    </tr>
@else
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">Sorry, {$your_intials}, but you did not win the baby pool. The winner was <span style="color:#ff3d7f">{$left_bid['initials]}</span>, with a bid of ${$left_bid['value']} on {$left_bid['date_string']}. Since the parents will take
                          their half, ${$parent_pot}, this means {$left_bid['initials]} will take home the remaining ${$winner_pot}!</div>
                      </td>
                    </tr>
@endif
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px">
                        <p style="font-size:1px;margin:0 auto;border-top:4px solid #ff3d7f;width:100%"></p>
                        <!--[if mso | IE]><table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0px auto;border-top:4px solid #FF3D7F;width:100%;" width="600"><tr><td style="height:0;line-height:0;"> </td></tr></table><![endif]-->
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:12pt;line-height:22px;text-align:left">A huge thank you to all the participants. And congratulations to the proud parents.</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0;padding:10px 25px" align="left">
                        <div style="cursor:auto;color:#000;font-family:Source Sans Pro,Helvetica;font-size:10pt;line-height:22px;text-align:left">Questions? You can reply to this email.</div>
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