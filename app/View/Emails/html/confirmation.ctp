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
         <strong style="color:#333333; font-size:15px;">Hi <?php echo $user['first_name'] . " " . $user['last_name']; ?>,</strong><br /><br />
        
        Congratulations on Crossfit!<br><br>
		<?php
		echo APPLICATION_NAME;
		?> 
        </div>
    </td>
  </tr>
</table>
</body>
</html>
