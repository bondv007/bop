<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crossfit</title>
<style type="text/css">
body{ margin:0px;}
</style>
</head>

<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #eaeaea; margin-top:20px;">

  <tr>
    <td>
        <div style="padding:15px; font-family:Arial, Helvetica, sans-serif; display:inline-block; font-size:12px; color:#555555;">
         <strong style="color:#333333; font-size:15px;">Hi <?php echo $user['User']['first_name'] . " " . $user['User']['last_name']; ?>,</strong><br /><br />
        
        You're almost there, click on the link below to<br>
        verify your account and get started.<br><br>        
        
		<a href="<?php echo Router::url(array ('controller' => 'users', 'action' => 'update_password', $user['User']['verification_code']), true); ?>" style="color:#21759b;" >
			<?php echo Router::url(array ('controller' => 'users', 'action' => 'update_password', $user['User']['verification_code']), true); ?>
		</a>
		<br><br>
		<?php
		echo APPLICATION_NAME;
		?> 
        </div>
    </td>
  </tr>
</table>
</body>
</html>
