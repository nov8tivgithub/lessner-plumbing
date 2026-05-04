<html><head><title><?php  echo TITLE; ?></title></head><body style='margin:0px; padding:0px;' bgcolor='#E9E9E9'>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'  bgcolor='#E9E9E9'><tr><td valign='top'>

    <table width='700' border='0' cellspacing='0' cellpadding='5' align='center'>
        <tr><td height='15' align='center' style='font-family:Helvetica, Arial, sans-serif; font-size:13px; line-height:28px; color:#3e3d3d; text-decoration:none;'>
        Please do not reply to this email. This mailbox is not monitored and you will not receive a response.
        </td></tr>
   		<tr><td align='center'><img src='<?php  echo base_url(); ?>images/logo.png'/></td></tr>
        <tr><td valign='top'>
        <table width='700' border='0' cellspacing='10' cellpadding='0' style='border:1px solid #D2D2D2;-moz-border-radius:5px;-webkit-border-radius:10px;border-radius:10px;'  bgcolor='#FFFFFF'>
              <tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#464646; border-bottom:1px solid #D2D2D2; line-height:25px;'>
              <strong>Hello Administrator,</strong><br /><br>
              You have received an inquiry in your website. Please see the details below.</td></tr>
              
              <tr><td valign='top' align='left'>
              
            
              
              <table width='50%' border='0' cellspacing='4' cellpadding='6'>


<tr>
    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='30%'>Name</td>
    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='70%'> : <?php  echo ($this->input->post( 'firstname' )." ".$this->input->post( 'lastname' ));?></td>
  	</tr>
  	
  	

    
  	<tr>
    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='30%'>Email</td>
    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='70%'>: <?php  echo $this->input->post( 'email' ); ?></td>
  	</tr>
    
  	<tr>
    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='30%'>Phone</td>
    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='70%'>: <?php  echo $this->input->post( 'phone' ); ?></td>
 	</tr>
    
  	
    
</table></td></tr>

<tr><td valign='top' align='left'>

<table width='100%' border='0' cellspacing='4' cellpadding='6'>
  <tr>
  <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#464646;' width='10%'>Inquiry</td>
  <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666666;'><?php  echo nl2br ($this->input->post( 'message' )); ?></td></tr>
</table>
              </td></tr>
              <tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#464646; border-top:1px solid #D2D2D2;'>
              Thank you,<br>
              <strong>Lessner Plumbing</strong>
              </td></tr>
              </table>        
        </td></tr>
        
        <tr>
        		<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666666;' align='center'>
        Copyright &copy; <?php  echo date('Y'); ?><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;"><a href='http://demo.icwares.com/clients/dev/lp/599/v1/' style='text-decoration:none; color:#11378b;'> lessnerplumbing.com.</a></span>, All Rights Reserved.<br />
        Designed and Developed by <a style='font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:19px; cursor:pointer; color:#000000; text-decoration:underline;font-weight:bold;'
        target='_blank' href='http://consult-ic.com/'>innovative consultants, LLC</a>
         
         </td></tr>
	</table>
    
</td></tr></table></body></html>