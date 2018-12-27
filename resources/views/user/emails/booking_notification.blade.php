<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="format-detection" content="telephone=no" />
        <title>Booking Email Notification</title>
        <style type="text/css">
        
            *{box-sizing: border-box; margin:0;}
          	body{
          		max-width: 100%; width: 100%; font-family: Geomanist-Regular;   font-size: 15px; line-height: 1.5;
              color: #5d5b5b; letter-spacing: 0.2px; 
          	}
            h1 , h2 , h3 , h4 , h5 , h6{
              margin:5px 0; 
            }
            img{
              max-width: 100%;
            }
            @font-face{
              font-family: Geomanist-Regular;
              src: url(fonts/Geomanist-Regular.otf);
            }
             @font-face{
              font-family: Geomanist-Light;
              src: url(fonts/Geomanist-Light.ttf);
            }
            @font-face{
              font-family: geomanist-regular-italic-webfont;
              src: url(fonts/geomanist-regular-italic-webfont.ttf);
            }
            
            .container-box {
                max-width: 600px;
                margin: auto;
            }
            
            .header{
              text-align: center;
            }
            a{       
               color: #5d5b5b;
               text-decoration: none;
            }
        
            .txt-box{
              text-align: center;
            }
            .txt-box h3 {
                font-size: 20px;
                margin: 0 0 30px;
                color: #5d5b5b;
                font-weight: normal;
                letter-spacing: 1px;
            }
            ul{
              list-style: none;
              color: #5d5b5b;
            }
        
             .row-bx:after{
              display: block;
              clear: both;
              content: "";
             }
            .row-bx .col-6{
              width: 45%;
              float: left;
              padding: 0;
              margin-right: 4%;      
            }
            .row-bx .col-6:last-child{
              margin-right: 0;
            }
            .sections.bg-gray {
                background: #f5f5f5;
                  padding: 30px 0;
            }
            .img-box {
                height: 300px;
                color: #fff;
                background: url(http://staging.emporium-voyage.com/images/bg-map.png) no-repeat center bottom;
                background-size: cover;
                padding: 30px;
                position: relative;
            }
        
          .bg-city.img-box {
             background: url(http://staging.emporium-voyage.com/images/bg-city.png) no-repeat center bottom;
            background-size: cover;
          }
          .rounds {
            width: 50px;
            height: 50px;
            background: #fff;
            border-radius: 100%;
            position: absolute;
            bottom: -25px;
            right: 15px;
            box-shadow: 0 5px 12px #dedddd;
        }
          .bg-white{
            background: #fff;
          }
          .pad-box {
            padding: 20px;
        }
        .bg-shadow{
            box-shadow: 0 5px 10px #e4e4e2;
            z-index: 5;
            position: relative;
        }
        span.sub-txt {
            font-size: 13px;
            color: #bbb8b8;
        }
         h4 {
            font-size: 17px;     
            margin:0; 
        }
        .invite-box {
            display: inline-block;
            padding: 0 20px 10px 15px;
            margin: 0 -15px;
            box-shadow: 0 2px 5px #eaeaea;   
        }
        .invite-box a {
            text-decoration: none;    
        }
        .msg-box {
            margin-top: 0;
            padding-top: 15px;
            position: relative;
        }
        .invite-box.invite-person {
            padding: 0;
            margin: 0 0 20px;
            box-shadow: none;
        }
        .dates-n-valid:after{
          content: "";
          display: block;
          clear: both;
        }
        .col-8 , .col-4 {
            width: 70%;
            float: left;
        }
        .col-4{
          width: 30%;
        }
        .dates-n-valid {
            padding-bottom: 15px;
        }
        .dates-n-valid p {
           
        }
        .img-box h4 {
            color: #fff;
            font-size: 17px;
            line-height: 1.2;
            margin-top: 15%;
            font-weight: normal;
        }
        .msg-box h4 {
            margin: 10px 0;
        }
        .box-barcode {
            text-align: center;
            padding: 20px;
            margin-top: 10px;
        }
        .col-6.bg-white {
            min-height: 594px;
            background: #ffffff;
        }
        .text-cnter-box {
            padding: 100px 0;
            text-align: center;
        }
        .tag-line {
            padding: 60px 0;
            text-align: center;
            font-family: Geomanist-Light;
        }
        .tag-line h3 {
            font-weight: normal;
            letter-spacing: 3px;
            font-size: 25px;
            color: #000;
            margin-bottom: 20px;
        }
        .tag-line p{
          font-family: geomanist-regular-italic-webfont;
        }
        .social-sec ul {
            text-align: center;
            padding: 20px 0;
            margin-bottom: 30px;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
        }
        .social-sec ul li{
          display: inline-block;
        }
        ul.pul-ri8 {
            float: right;
        }
        ul.pul-ri8 li{
          float: left;
          margin-left: 30px;
        }
        ul.pul-ri8 li:first-child{
          margin-left: 0;
        }
        p.gray-tx {
            color: #bfbebe;
        }
        .sections.bg-gray.pad-60 {
            padding: 60px 0;
        }
        .txt-box {
            padding: 100px 0 120px;
            text-align: center;
        }
        
        @media (max-width: 559px){
          .container-box {
            max-width: 320px;
            margin: auto;
          }
          .row-bx .col-6 {
            width: 100%;
            float: none;
            padding: 0;
            margin-right: 0;
            margin-bottom: 30px;
          }
          br{
            display: none;
          }
          .img-box h4 br{
            display: block;
          }
          ul.pul-ri8 {
              float: none;
          }
          ul.pul-ri8 li{
            float: none;
            display: inline-block;
          }
          p.gray-tx {
              text-align: center;
          }
        }
        
            a {
                text-decoration: none !important;
            }
            .AnnouncementTD {
                color: #425065;
                font-family: sans-serif;
                font-size: 18px;
                text-align: right;
                line-height: 150%;
                font-weight: bold;
                letter-spacing: 2px;
            }
            .AnnouncementTD a {
                color: #425065 !important;
            }
            .wz {
                padding: 0 4px;
            }
            .header2TD,
            .header5TD {
                color: #333;
                font-family: ACaslonPro-Regular;
                font-size: 18px;
                text-align: center;
                line-height: 27px;
                font-weight: bold;
                text-transform: uppercase;
            }
            .header2TD {
                font-size: 14px;
                font-weight: lighter;
                text-align: left;
                line-height: 19px;
            }
            .header5TD {
                color: #eeeeee;
                font-size: 15px;
                font-weight: bold;
                text-align: center;
            }
            .header2TD a {
                color: #425065 !important;
                font-weight: bold !important;
            }
            .header5TD a {
                color: #eeeeee !important;
            }
            .RegularTextTD,
            .RegularText4TD,
            .RegularText5TD {
                color: #333;
                font-family: ACaslonPro-Regular;
                font-size: 13px;
                font-weight: lighter;
                text-align: left;
                line-height: 23px;
            }
            .RegularTextTD a {
                color: #4B4743 !important;
                font-weight: bold !important;
            }
            .RegularText4TD {
                color: #333;
                font-size: 14px;
                font-weight: bold;
                text-align: left;
            }
            .RegularText4TD a {
                color: #4B4743 !important;
            }
            .RegularText5TD {
                color: #333;
                font-size: 14px;
                text-align: center;
            }
            .RegularText5TD a {
                color: #333 !important;
                font-weight: bold !important;
            }
            td a img {
                text-decoration: none;
                border: none;
            }
            .thankYouMessageTD {
                color: #4B4743;
                font-family: sans-serif;
                font-size: 13px;
                text-align: center;
                font-weight: bold;
                line-height: 190%;
            }
            .thankYouMessageTD a {
                color: #4B4743 !important;
                font-weight: bold !important;
            }
            .mailingOptionsTD {
                color: #aab1bd;
                font-family: sans-serif;
                font-size: 12px;
                text-align: center;
                line-height: 170%;
            }
            .mailingOptionsTD a {
                color: #ffffff !important;
                font-weight: bold !important;
            }
            .ReadMsgBody {
                width: 100%;
            }
            .ExternalClass {
                width: 100%;
            }
            body {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-font-smoothing: antialiased;
                margin: 0 !important;
                padding: 0 !important;
                min-width: 100% !important;
            }
            @media only screen and (max-width: 479px) {
                body {
                    min-width: 100% !important;
                }
                th[class=stack] {
                    display: block !important;
                    width: 300px !important;
                    border: 0 !important;
                    height: auto !important;
                }
                table[class=table600Logo] {
                    width: 300px !important;
                }
                table[class=centerize] {
                    margin: 0 auto 0 auto !important;
                    border-bottom-width: 2px !important;
                    border-bottom-style: solid !important;
                }
                table[class=table600Menu] {
                    width: 300px !important;
                }
                table[class=table600Menu] td {
                    height: 20px !important;
                }
                td[class=AnnouncementTD] {
                    width: 300px !important;
                    text-align: center !important;
                    font-size: 17px !important;
                }
                td[class=table600st] {
                    width: 300px !important;
                    min-width: 300px !important;
                    height: 20px !important;
                }
                td[class=header2TD] {
                    height: 0 !important;
                    font-size: 12px !important;
                }
                td[class=header5TD] {
                    font-size: 12px !important;
                    font-weight: lighter !important;
                }
                table[class=table600] {
                    width: 300px !important;
                }
                table[class=table6003] {
                    width: 300px !important;
                    border-bottom-style: solid !important;
                    border-bottom-width: 1px !important;
                }
                table[class=table600Min] {
                    width: 300px !important;
                    min-width: 300px !important;
                }
                td[class=wz] {
                    height: 10px !important;
                }
                td[class=wz2] {
                    width: 10px !important;
                    height: 10px !important;
                }
                td[class=RegularTextTD] {
                    width: 240px !important;
                    height: 0 !important;
                }
                td[class=RegularText5TD] {
                    font-size: 13px !important;
                }
                td[class=esFrMb] {
                    width: 0 !important;
                    height: 0 !important;
                    display: none !important;
                }
                table[class=tableTxt] {
                    width: 240px !important;
                }
                td[class=vrtclAlgn] {
                    height: 30px !important;
                }
                td[class=va2] {
                    height: 20px !important;
                }
                th[class=stack2] {
                    width: 100px !important;
                }
                table[class=table60032] {
                    width: 98px !important;
                }
                th[class=stack3] {
                    width: 66px !important;
                }
                table[class=table60033] {
                    width: 64px !important;
                }
                th[class=stack4] {
                    width: 166px !important;
                }
                table[class=table60034] {
                    width: 164px !important;
                }
                td[class=TDtable60034] {
                    width: 162px !important;
                }
                td[class=RegularText4TD] {
                    font-size: 13px !important;
                    font-weight: lighter !important;
                }
            }
        </style>
    </head>

    <body style="margin: 0 auto;padding: 0 !important;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;-webkit-font-smoothing: antialiased;min-width: 100% !important;">
    
        <div class="invitation-box">
     		<div class="container-box">
         		<div class="header"> 			
        			<div style="border-bottom: 1px solid #ddd; padding: 100px 0; text-align: center;">
        			     <a href="#"><img src="http://staging.emporium-voyage.com/images/emporium-voyage-logo.png" alt="" style="width: 250px;" /></a>
        			</div>
        			<div class="sections">
                        <div class="container-box">
                          <div class="txt-box">
    
        <center>
        
            
            <div mc:repeatable>
                <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tbody>
                        <tr>
                            <td align="center" style="border-collapse: collapse;">
                                <table width="668"  align="center" cellspacing="0" cellpadding="0" border="0" class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tbody>
                                        <tr>
                                            <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                <table width="629" align="center" cellspacing="0" cellpadding="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                <table width="629" bgcolor="#4B4743" align="left" cellspacing="0" cellpadding="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" style="border-collapse: collapse;">
                                                                                <table align="center" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <th width="400" class="stack2" style="margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                                                <table width="400" align="center" cellspacing="0" cellpadding="0" border="0" class="table60032" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td height="20" colspan="3" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                            <!-- DESCRIPTION TEXT -->
                                                                                                            <td class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-21">BOOKING REF #{reservation_id}</td>
                                                                                                            <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td height="20" colspan="3" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </th>

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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div mc:repeatable>
                <!-- 1 COLUMN MODULE === YOUR PAYMENT IS PROCESSING TEXT -->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tr>
                        <td align="center" style="border-collapse: collapse;">
                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                        <table width="629" bgcolor="#D8D8D4" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                            <tr>
                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                    <table width="629" align="left" cellpadding="0" cellspacing="0" border="0" class="table600" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                        <tr>
                                                            <td align="center" style="border-collapse: collapse;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td align="center" style="border-collapse: collapse;">
                                                                            <table width="629" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="vrtclAlgn2">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">Dear {full_user_name},
                                                                                        <br/>We are delighted that you have chosen "{property_name}" and we are pleased to confirm your reservation as follows:</td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="vrtclAlgn">&nbsp;</td>
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
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--END OF THE MODULE-->
            </div>

            <div mc:repeatable>
                <!-- 1 COLUMN MODULE === YOUR PAYMENT IS PROCESSING TEXT -->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tr>
                        <td align="center" style="border-collapse: collapse;">
                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                        <table width="629" bgcolor="#D8D8D4" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                            <tr>
                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                    <table width="629" align="left" cellpadding="0" cellspacing="0" border="0" class="table600" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                        <tr>
                                                            <td align="center" style="border-collapse: collapse;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td align="center" style="border-collapse: collapse;">
                                                                            <table width="629" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="vrtclAlgn2">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        <p style="float: left; background: rgb(77, 74, 69) none repeat scroll 0% 0%; color: rgb(255, 255, 255); padding: 10px; width: 97%; text-align: center; text-transform: uppercase;" class="RegularText4TD">{category_name}</p>
                                                                                        <img src="{category_image}" style="width: 600px;" />
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="vrtclAlgn">&nbsp;</td>
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
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--END OF THE MODULE-->
            </div>
            <div mc:repeatable>
                <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tbody>
                        <tr>
                            <td align="center" style="border-collapse: collapse;">
                                <table width="668"  align="center" cellspacing="0" cellpadding="0" border="0" class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tbody>
                                        <tr>
                                            <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                <table width="629" align="center" cellspacing="0" cellpadding="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                <table width="629" bgcolor="#4B4743" align="left" cellspacing="0" cellpadding="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" style="border-collapse: collapse;">
                                                                                <table align="center" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <th width="400" class="stack2" style="margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                                                <table width="400" align="center" cellspacing="0" cellpadding="0" border="0" class="table60032" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td height="20" colspan="3" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                            <!-- DESCRIPTION TEXT -->
                                                                                                            <td class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-21">Suite Booked</td>
                                                                                                            <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td height="20" colspan="3" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </th>

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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div mc:repeatable>
                <!--2 COLUMNS MODULE == INVOICE CREDENTIALS == 2 (20 x 20)  ICONS ==-->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tr>
                        <td align="center" style="border-collapse: collapse;">
                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                        <table width="629" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 628px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                            <tr>
                                                <td class="table600st" style="min-width: 628px;border-collapse: collapse;">
                                                    <table width="629" bgcolor="#D8D8D4" align="left" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                        <tr>
                                                            <td style="border-collapse: collapse;">
                                                                <table align="center" cellpadding="0" cellspacing="0" bgcolor="#D8D8D4" border="0" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <th width="314" class="stack" style="margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                            <table width="314" align="center" cellpadding="0" cellspacing="0" border="0" class="table6003" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <td valign="top" align="center" style="border-collapse: collapse;">
                                                                                        <table width="252" align="left" cellpadding="0" cellspacing="0" border="0" class="tableTxt" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                            <tr>
                                                                                                <!--ICON image at left here 20 x 20-->
                                                                                                <td rowspan="2" width="25" align="center" valign="top" style="line-height: 1px;border-collapse: collapse;"><img mc:edit="mcsec-4" src="http://staging.emporium-voyage.com/sximo/assets/images/invoice-icon-20x20.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0" />
                                                                                                </td>
                                                                                                <td rowspan="2" width="14" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                                <!--Invoice Sent To SECTION-->
                                                                                                <td width="211" valign="top" class="header2TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-5">{title}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--NAME SECTION-->
                                                                                                <td width="179" valign="top" class="RegularText4TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-6">{full_user_name}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="10" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--ADDRESS ETC. SECTION-->
                                                                                                <td colspan="3" class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-7">Birthday: {birthday}
                                                                                                    <br/>Landline: {landline_number}
                                                                                                    <br/>Mobile: {mobile_number}
                                                                                                    <br/>Preferred communication: {prefer_communication_with}
                                                                                                    <br/><a href="mailto:{email}">{email}</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                        <th width="314" class="stack" valign="top" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                            <table width="314" align="center" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <td valign="top" align="center" style="border-collapse: collapse;">
                                                                                        <table width="252" align="left" cellpadding="0" cellspacing="0" border="0" class="tableTxt" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                            <tr>
                                                                                                <!--ICON image at left here 20 x 20-->
                                                                                                <td rowspan="2" width="25" align="center" valign="top" style="line-height: 1px;border-collapse: collapse;"><img mc:edit="mcsec-8" src="http://staging.emporium-voyage.com/sximo/assets/images/home-icon-20x20.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0" />
                                                                                                </td>
                                                                                                <td rowspan="2" width="14" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                                <!--Invoice Sent From SECTION-->
                                                                                                <td width="211" valign="top" class="header2TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-9">Hotel Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--NAME SECTION-->
                                                                                                <td width="179" valign="top" class="RegularText4TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-10">{property_name}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="10" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--ADDRESS ETC. SECTION-->
                                                                                                <td colspan="3" class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-11">City: {property_city}
                                                                                                    <br/>Country: {property_country}
                                                                                                    <br/>Website: <a href="{property_website}">{property_website}</a>
                                                                                                    <br/>Phone: <a href="tel:{property_phone}">{property_phone}</a>
                                                                                                    <br/><a href="mailto:{property_email}">{property_email}</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
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
                        </td>
                    </tr>
                </table>
                <!--END OF THE MODULE-->
            </div>


            <div mc:repeatable>
                <!--== 3 COLUMNS MODULE = INVOICE NO == INVOICE DATE == INVOICE TOTAL ==-->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tr>
                        <td align="center" style="border-collapse: collapse;">
                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                        <table width="629" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                            <tr>
                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                    <table width="629" bgcolor="#D8D8D4" align="left" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                        <tr>
                                                            <td align="left" style="border-collapse: collapse;">
                                                                <table align="center" bgcolor="#D8D8D4" cellpadding="0" cellspacing="0" border="0" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <th width="209" class="stack" style="margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                            <table width="209" align="center" cellpadding="0" cellspacing="0" border="0" class="table6003" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <td valign="top" align="center" style="border-collapse: collapse;">
                                                                                        <table width="145" align="left" cellpadding="0" cellspacing="0" border="0" class="tableTxt" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                            <tr>
                                                                                                <!--ICON image here 20 x 20-->
                                                                                                <td rowspan="2" width="25" align="center" valign="top" style="line-height: 1px;border-collapse: collapse;"><img mc:edit="mcsec-12" src="http://staging.emporium-voyage.com/sximo/assets/images/date-icon-20x20.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0" />
                                                                                                </td>
                                                                                                <td rowspan="2" width="14" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                                <!--Invoice No-->
                                                                                                <td valign="top" class="header2TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-13">Arrival</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--Number-->
                                                                                                <td valign="top" class="RegularText4TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-17">{checkin_date}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                        <th width="209" class="stack" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                            <table width="209" align="center" cellpadding="0" cellspacing="0" border="0" class="table6003" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <td valign="top" align="center" style="border-collapse: collapse;">
                                                                                        <table width="145" align="left" cellpadding="0" cellspacing="0" border="0" class="tableTxt" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                            <tr>
                                                                                                <!--ICON image here 20 x 20-->
                                                                                                <td rowspan="2" width="25" align="center" valign="top" style="line-height: 1px;border-collapse: collapse;"><img mc:edit="mcsec-15" src="http://staging.emporium-voyage.com/sximo/assets/images/date-icon-20x20.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0" />
                                                                                                </td>
                                                                                                <td rowspan="2" width="14" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                                <!--Invoice Date-->
                                                                                                <td valign="top" class="header2TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-16">Departure</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--Date-->
                                                                                                <td valign="top" class="RegularText4TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-17">{checkout_date}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                        <th width="209" class="stack" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                            <table width="209" align="center" cellpadding="0" cellspacing="0" border="0" class="table600" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <td valign="top" align="center" style="border-collapse: collapse;">
                                                                                        <table width="145" align="left" cellpadding="0" cellspacing="0" border="0" class="tableTxt" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                            <tr>
                                                                                                <!--ICON image 20 x 20-->
                                                                                                <td rowspan="2" width="25" align="center" valign="top" style="line-height: 1px;border-collapse: collapse;"><img mc:edit="mcsec-18" src="http://staging.emporium-voyage.com/sximo/assets/images/eur.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0" />
                                                                                                </td>
                                                                                                <td rowspan="2" width="14" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                                <!--Invoice Total-->
                                                                                                <td valign="top" class="header2TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-19">Total</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!--Invoice Total-->
                                                                                                <td valign="top" class="RegularText4TD" align="left" style="border-collapse: collapse;" mc:edit="mcsec-20">{grand_total}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
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
                        </td>
                    </tr>
                </table>
                <!--END OF THE MODULE-->
            </div>
            <div mc:repeatable="">
                <!--== 4 COLUMNS MODULE == MAIN INVOICE CAPTIONS == DESCRIPTION == QUANTITY == PRICE == TEXT ==-->
                <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tbody>
                        <tr>
                            <td align="center" style="border-collapse: collapse;">
                                <table width="668"  align="center" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="table600Min">
                                    <tbody>
                                        <tr>
                                            <td align="center" style="min-width: 668px;border-collapse: collapse;" class="table600st">
                                                <table width="629" align="center" cellspacing="0" cellpadding="0" border="0" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="table600Min">
                                                    <tbody>
                                                        <tr>
                                                            <td style="min-width: 629px;border-collapse: collapse;" class="table600st">
                                                                <table width="629" bgcolor="#4B4743" align="left" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="table600">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" style="border-collapse: collapse;">
                                                                                <table align="center" cellspacing="0" cellpadding="0" border="0" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <th width="400" style="margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;" class="stack2">
                                                                                                <table width="400" align="center" cellspacing="0" cellpadding="0" border="0" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" class="table60032">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td height="20" class="va2" style="font-size: 0;line-height:1;border-collapse: collapse;" colspan="3">&nbsp;</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td width="30" style="border-collapse: collapse;" class="wz2"></td>
                                                                                                            <!-- DESCRIPTION TEXT -->
                                                                                                            <td mc:edit="mcsec-21" style="border-collapse: collapse;" class="header5TD">Your Selected Preferences</td>
                                                                                                            <td width="30" style="border-collapse: collapse;" class="wz2"></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td height="20" class="va2" style="font-size: 0;line-height:1;border-collapse: collapse;" colspan="3">&nbsp;</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </th>

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
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--END OF THE MODULE-->
            </div>
            <div mc:repeatable>
                <!-- 1 COLUMN MODULE === YOUR PAYMENT IS PROCESSING TEXT -->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <tr>
                        <td align="center" style="border-collapse: collapse;">
                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tr>
                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                        <table width="629" bgcolor="#D8D8D4" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                            <tr>
                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                    <table width="629" align="left" cellpadding="0" cellspacing="0" border="0" class="table600" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                        <tr>
                                                            <td align="center" style="border-collapse: collapse;">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td align="center" style="border-collapse: collapse;">
                                                                            <table width="629" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="vrtclAlgn2">&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        Have you already stayed in one of our suites?: {already_stayed}
                                                                                        <br/> Family Name: {family_name}
                                                                                        <br/>
                                                                                    </td>

                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td mc:edit="mcsec-3" style="border-collapse: collapse; border-top: 1px solid rgb(221, 229, 241); float: left; width: 100%; margin: 6px 0 0; padding: 10px 0 3px;" class="header2TD">
                                                                                        <span class="roomTypeName">Relationship: {relationship}</span>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td mc:edit="mcsec-3" style="border-collapse: collapse; border-top: 1px solid rgb(221, 229, 241); float: left; width: 100%; margin: 6px 0 0; padding: 10px 0 3px;" class="header2TD">
                                                                                        <span class="roomTypeName">Purpose of stay</span>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        Purpose of your stay: {purpose_of_stay}
                                                                                        <br/> Do you want to provide us with further details regarding your stay?: {stay_details}
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td mc:edit="mcsec-3" style="border-collapse: collapse; border-top: 1px solid rgb(221, 229, 241); float: left; width: 100%; margin: 6px 0 0; padding: 10px 0 3px;" class="header2TD">
                                                                                        <span class="roomTypeName">{category_name} preferences</span>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        Desired suite temperature: {desired_room_temperature}
                                                                                        <br/> Smoking preference: {smoking_preference}
                                                                                        <br/> Rollaway bed: {rollaway_bed}
                                                                                        <br/> Crib: {crib}
                                                                                        <br/> Wheelchair accessible: {wheelchair_accessible}
                                                                                        <br/> Generally I am size: {generally_am_size}
                                                                                        <br/>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td mc:edit="mcsec-3" style="border-collapse: collapse; border-top: 1px solid rgb(221, 229, 241); float: left; width: 100%; margin: 6px 0 0; padding: 10px 0 3px;" class="header2TD">
                                                                                        <span class="roomTypeName">Bedding preferences</span>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        Pillow firmness: {pillow_firmness}
                                                                                        <br/> Pillow type: {pillow_type}
                                                                                        <br/> Bed style: {bed_style}
                                                                                        <br/> Generally I sleep on the: {generally_sleep_on}
                                                                                        <br/>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td mc:edit="mcsec-3" style="border-collapse: collapse; border-top: 1px solid rgb(221, 229, 241); float: left; width: 100%; margin: 6px 0 0; padding: 10px 0 3px;" class="header2TD">
                                                                                        <span class="roomTypeName">Lifestyle preferences</span>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Cultural Interests</p>
                                                                                        {cultural_interests_list}
                                                                                        <div style="float: left; width: 100%;">
                                                                                            Other, please specify : {other_interests}
                                                                                        </div>
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Sports</p>
                                                                                        {sports_preferences_list}
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Wellbeing</p>
                                                                                        {wellbeing_preferences_list}
                                                                                        <div style="float: left; width: 100%;">
                                                                                            I would prefer my in-suite language settings to be: {prefer_language}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td mc:edit="mcsec-3" style="border-collapse: collapse; border-top: 1px solid rgb(221, 229, 241); float: left; width: 100%; margin: 6px 0 0; padding: 10px 0 3px;" class="header2TD">
                                                                                        <span class="roomTypeName">Eating & Drinking preferences</span>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    <!--TEXT SECTION-->
                                                                                    <td class="RegularTextTD" style="border-collapse: collapse;" mc:edit="mcsec-3">
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Dietary regime</p>
                                                                                        {dietary_preferences_list}
                                                                                        <div style="float: left; width: 100%;">
                                                                                            Favourite dishes: {favourite_dishes}
                                                                                            <br/> Food allergies: {food_allergies}
                                                                                            <br/> Known allergies: {known_allergies}
                                                                                            <br/>
                                                                                        </div>
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Snacks</p>
                                                                                        {snacks_preferences_list}
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Fruits</p>
                                                                                        {fruits_preferences_list}
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Hot beverages</p>
                                                                                        {beverages_preferences_list}
                                                                                        <p class="RegularText4TD" style="float: left; width: 100%;">Sodas</p>
                                                                                        {sodas_preferences_list}
                                                                                        <div style="float: left; width: 100%;">
                                                                                            Preferred aperitif: {preferred_aperitif} Other remarks for our upcoming visit: {preferred_aperitif}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                </tr>


                                                                                <tr>
                                                                                    <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="vrtclAlgn">&nbsp;</td>
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
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--END OF THE MODULE-->
                </div>


                            <div mc:repeatable>
                                <!--== 4 COLUMNS MODULE == MAIN INVOICE CAPTIONS == DESCRIPTION == QUANTITY == PRICE == TEXT ==-->
                                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"  style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td align="center" style="border-collapse: collapse;">
                                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tr>
                                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                        <table width="629" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                            <tr>
                                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                    <table width="629" align="left" cellpadding="0" cellspacing="0" bgcolor="#4B4743" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                        <tr>
                                                                            <td align="left" style="border-collapse: collapse;">
                                                                                <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <th width="209" class="stack2" style="margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                                            <table width="209" align="center" cellpadding="0" cellspacing="0" border="0" class="table60032" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- DESCRIPTION TEXT -->
                                                                                                    <td class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-21">Suite Details</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="border-bottom-color: #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- PRICE TEXT -->
                                                                                                    <td class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-22">Price</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- QUANTITY TEXT -->
                                                                                                    <td class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-23">Nights</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- TOTAL TEXT -->
                                                                                                    <td class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-24">Total</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
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
                                        </td>
                                    </tr>
                                </table>
                                <!--END OF THE MODULE-->
                            </div>





                            <div mc:repeatable>
                                <!-- 4 COLUMN MODULE == ITEMS  DETAILS == NAME, PRICE, QUANTITY, TOTAL -->
                                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"  style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td align="center" style="border-collapse: collapse;">
                                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tr>
                                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                        <table width="629" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                            <tr>
                                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                    <table width="629" align="left" cellpadding="0" cellspacing="0" bgcolor="#D8D8D4" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                        <tr>
                                                                            <td align="left" style="border-collapse: collapse;">
                                                                                <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-bottom: 1px solid #C7AB84;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    {reserved_rooms}
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
                                        </td>
                                    </tr>
                                </table>
                                <!--END OF THE MODULE-->
                            </div>

                            <div mc:repeatable>
                                <!-- 4 COLUMNS MODULE == FINAL INVOICE CALCULATIONS (SUBTOTAL, VAT, SHIPPING, TOTAL) + SIGNATURE ==  -->
                                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"  style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td align="center" style="border-collapse: collapse;">
                                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tr>
                                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                        <table width="629" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                            <tr>
                                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                    <table width="629" align="left" cellpadding="0" cellspacing="0" bgcolor="#D8D8D4" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                        <tr>
                                                                            <td align="left" style="border-collapse: collapse;">
                                                                                <table align="center" cellpadding="0" cellspacing="0" border="0" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <th width="349" height="100" rowspan="4" class="stack4" bgcolor="#D8D8D4" style="margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="349" align="center" cellpadding="0" cellspacing="0" border="0" class="table60034" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="347" align="center" style="line-height: 1px;border-collapse: collapse;" class="TDtable60034"><img mc:edit="mcsec-41" src="http://staging.emporium-voyage.com/sximo/assets/images/signature-150x80.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0" />
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-42">Riaan Kieynhans
                                                                                                        <br/>Accounts Manager
                                                                                                        <br/>(or any JPG/PNG)
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" valign="top" bgcolor="#D8D8D4" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- TOTAL -->
                                                                                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-43">Sub Total</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" valign="top" bgcolor="#D8D8D4" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- INVOICE TOTAL -->
                                                                                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-44">{total_price}</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th width="139" class="stack3" valign="top" bgcolor="#D8D8D4" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- SHIPPING -->
                                                                                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-47">Commission Due</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" valign="top" bgcolor="#D8D8D4" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- INVOICE TOTAL -->
                                                                                                    <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-48">{commission_due}</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th width="139" class="stack3" bgcolor="#4B4743" valign="top" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- TOTAL -->
                                                                                                    <td bgcolor="#4B4743" class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-49">Total</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                        <th width="139" class="stack3" bgcolor="#4B4743" valign="top" style="border-left: 1px solid #C7AB84;margin: 0;padding: 0;vertical-align: top;border-bottom: 1px solid #C7AB84;border-collapse: collapse;">
                                                                                            <table width="139" align="center" cellpadding="0" cellspacing="0" border="0" class="table60033" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                    <!-- INVOICE TOTAL -->
                                                                                                    <td bgcolor="#4B4743" class="header5TD" style="border-collapse: collapse;" mc:edit="mcsec-50">{grand_total}</td>
                                                                                                    <td width="30" class="wz2" style="border-collapse: collapse;"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3" height="20" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
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
                                        </td>
                                    </tr>
                                </table>
                                <!--END OF THE MODULE-->
                            </div>



                            <div mc:repeatable>
                                <!-- 1 COLUMN MODULE === FINAL NOTES, ACCEPTED PAYMENT OPTIONS ETC. -->
                                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td align="center" style="border-collapse: collapse;">
                                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tr>
                                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                        <table width="629" align="center" cellpadding="0" cellspacing="0" border="0" class="table600Min" style="min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                            <tr>
                                                                <td class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                    <table width="629" bgcolor="#D8D8D4" align="left" cellpadding="0" cellspacing="0" border="0" class="table600" style="border-radius: 0 0 6px 6px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                        <tr>
                                                                            <td style="border-collapse: collapse;">
                                                                                <table width="627" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td colspan="3" height="25" style="font-size: 0;line-height:1;border-collapse: collapse;" class="va2">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                        <!--REGULAR TEXT SECTION-->
                                                                                        <td class="RegularText5TD" style="border-collapse: collapse;" mc:edit="mcsec-51">
                                                                                            <b>{property_name} Terms And Conditions</b>
                                                                                            <br/>{hotel_terms_n_conditions}
                                                                                            <br/>
                                                                                            <br/><a href="https://emporium-voyage.com/">emporium-voyage.com/</a>
                                                                                            <br/><a href="mailto:reservations@emporium-voyage.com">reservations@emporium-voyage.com</a>
                                                                                        </td>
                                                                                        <td width="30" class="wz" style="border-collapse: collapse;"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3" height="30" class="va2" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
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
                                        </td>
                                    </tr>
                                </table>
                                <!--END OF THE MODULE-->
                            </div>



                            <div mc:repeatable>
                                <!-- == FOOTER MODULE = MAILING OPTIONS == -->
                                <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="table-layout: fixed;margin: 0 auto;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                    <tr>
                                        <td align="center" style="border-collapse: collapse;">
                                            <table width="668" align="center" cellpadding="0" cellspacing="0" border="0"  class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 668px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tr>
                                                    <td align="center" class="table600st" style="min-width: 668px;border-collapse: collapse;">
                                                        <table width="629" align="center" cellpadding="0" cellspacing="0"  border="0" class="table600Min" style="table-layout: fixed;margin: 0 auto;min-width: 629px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                            <tr>
                                                                <td align="center" class="table600st" style="min-width: 629px;border-collapse: collapse;">
                                                                    <table width="610" align="center" cellpadding="0" cellspacing="0" border="0" class="table600" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                        <tr>
                                                                            <td height="25" style="border-collapse: collapse;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <!--NOTES -->
                                                                            <td mc:edit="mcsec-52" style="border-collapse: collapse; color: #333;" class="thankYouMessageTD">THANK YOU VERY MUCH FOR CHOOSING emporium-voyage</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="25" style="font-size: 0;line-height:1;border-collapse: collapse;">&nbsp;</td>
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
                            </div>
                            <!--END OF THE MODULE-->
                            <div mc:repeatable></div>
                            </center>
                                                                                            

                        </div>
                   </div>
    			</div> 				
     		</div>		 		
     	</div>
        <div style="clear: both;"></div>
        <div class="sections">
            <div style="max-width: 600px; margin: auto;">
              <div style="padding: 100px 0; text-align: center;">
                 <p>emporium-voyage is your ideal, vogue vacation planner! With it's ultra-exclusive spaces<br> and elite spas huddled in its cocoon, emporium-voyage ensure the ultimate ultra luxury <br>experience. Our expertise lies in our utmost diligence to provide our beau monde<br> customers with an exotic experience they will relish forever.</p>
              </div>
            </div>
        </div>
        <div style="clear: both;"></div>

        <!-- start footer -->
        <div class="sections" style="background: #f5f5f5; padding: 30px 0;">
            <div style="max-width: 600px; margin: auto;">
                <div class="row-bx">
                    <div class="col-12" style="">
                      <div style="padding: 60px 0; text-align: center; font-family: Geomanist-Light;">
                        <h3 style="font-weight: normal; letter-spacing: 3px; font-size: 25px; color: #000; margin-bottom: 20px;">emporium - voyage</h3>
                        <p>Ultra luxury suites from the worlds leading hotels from selected destinations worldwide</p>
                      </div>
                    
                      <div class="social-sec">
                         <ul style="list-style: none; color: #5d5b5b; text-align: center; padding: 20px 0; margin-bottom: 30px; border-top: 1px solid #fff; border-bottom: 1px solid #fff;">
                           <li style="display: inline-block;"><a href="#" target="blank"><img src="http://staging.emporium-voyage.com/images/link-in.png" alt="" /></a></li>
                           <li style="display: inline-block;"><a href="#" target="blank"><img src="http://staging.emporium-voyage.com/images/face-book.png" alt="" /></a></li>
                           <li style="display: inline-block;"><a href="#" target="blank"><img src="http://staging.emporium-voyage.com/images/twitter.png" alt="" /></a></li>
                           <li style="display: inline-block;"><a href="#" target="blank"><img src="http://staging.emporium-voyage.com/images/google-png.png" alt="" /></a></li>
                         </ul>
                      </div>
                    </div>
                </div>
                <!-- end of sections -->
                <div class="row-bx">
                  <div style="width: 45%; float: left; padding: 0; margin-right: 4%;">
                    <p style="color: #bfbebe;">&copy; emporium-voyage</p>
                  </div>
                  <div  style="width: 45%; float: left; padding: 0; margin-right: 4%;">
                    <ul style="float: right;">
                      <li style="float: left; margin-left: 0px;"><a href="#">Join</a></li>
                      <li style="float: left; margin-left: 30px;"><a href="#">Magazine</a></li>
                      <li style="float: left; margin-left: 30px;"><a href="#">Contact</a></li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>  
    </div>
                                                                                              
</body>

</html>
