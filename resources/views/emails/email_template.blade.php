<?php $uri = "http://" . $_SERVER['SERVER_NAME'].'/';
$email=getcong('site_email');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin:0; padding:0;height:100% !important; margin:0; padding:0; width:100% !important;background:url('<?php echo $uri;?>bg.jpg') repeat #DEE0E2;">
    	<center>
        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse:collapse !important;height:100% !important;background:url('<?php echo $uri;?>bg.jpg') repeat #DEE0E2; margin:0; padding:0; width:100% !important;">
            	<tr>
                	<td align="center" valign="top" style="padding:20px;">
                    	<!-- BEGIN TEMPLATE // -->
                    	<table border="0" cellpadding="0" cellspacing="0" style="width:600px;background:url('<?php echo $uri;?>header.png') no-repeat top center / 100% auto;">
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN PREHEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templatePreheader" style="background:url('<?php echo $uri;?>main.png') repeat-y center / 100% auto ;
				margin-top:19px;">
                                        <tr>
                                            <td valign="top" class="preheaderContent" style="padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:20px;color:#808080;
				font-family:Arial;font-size:10px;line-height:125%;text-align:left;" mc:edit="preheader_content00">
                                                <em>1800-1377-890</em> Customer Support
                                            </td>
                                            <!-- *|IFNOT:ARCHIVE_PAGE|* -->
                                            <td valign="top" class="preheaderContent" style="padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:20px;color:#808080;
				font-family:Arial;font-size:10px;line-height:125%;text-align:left;" mc:edit="preheader_content01">
                                            </td>
                                            <!-- *|END:IF|* -->
                                        </tr>
                                    </table>
                                    <!-- // END PREHEADER -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN HEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader" style="background:url('<?php echo $uri;?>main.png') repeat-y center / 100% auto ;">
                                        <tr>
                                            <td valign="top" class="headerContent" style="text-align:center;vertical-align:middle;padding:30px 0;">
                                            	<img src="<?php echo $uri;?>upload/logo.png" style="max-width:300px; margin:0 auto;height:auto;" alt="" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END HEADER -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN BODY // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody" style="background:url('<?php echo $uri;?>main.png') repeat-y center / 100% auto ; width:100%; color:#8b8c8c;font-size:14px; border-spacing:0px; vertical-align:top;">
                                        <tr>
                                            <td valign="top" class="bodyContent" style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:left;" mc:edit="body_content">
                              <?php print_r($user_message); ?><br/>
                                        </tr>
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="middle">
                                	<!-- BEGIN FOOTER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter" style="background:url('<?php echo $uri;?>footer.png') no-repeat center / 102% auto ;">
                                        
                                        <tr>
                                            <td valign="bottom" class="footerContent" mc:edit="footer_content01" style="color:#808080;font-family:Arial;font-size:10px;line-height:150%;height:182px;text-align:center;padding-bottom:30px;">
                                                <em>Copyright &copy; {{date('Y')}} {{$uri}} ,<br /> All rights reserved.</em>
                                                
                                                <br/>
                                                <strong>Our mailing address is:</strong>
                                                <br />
                                                <a href="javasrcipt:;" style="color:#999;"><?php echo $email; ?></a>
												
												
												<br /><br />
												<small>To unsubscribe <a href="#" style="color:#999;">Click Here</a></small>
                                            </td>
                                       </tr>
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>