<?php
	 if(!empty($messages)){  
			foreach($messages as $msg){ 		

				if(isset($msg['User'])) {
	?>

<li onclick="open_lightbox('/crossfit/website/messages/reply_popup/<?php echo $msg['Message']['id']; ?>', '600px', '500px');" id="msg_id_<?php echo $msg['Message']['id']; ?>"> 
	<span title="asd asd"><?php echo $msg['User']['first_name'].' '.$msg['User']['last_name']; ?></span> 
	<p title="sasd"><?php echo wraptext($msg['Message']['subject'], 50); ?></p> 							
	<label><?php echo formatDateTime($msg['Message']['created']); ?></label> 
</li>	

	<?php }else{ ?>
		
<li> 
	<span title="asd asd"><?php echo 'Status Update'; ?></span> 
	<p title="sasd"><?php echo wraptext($msg['Message']['message'], 50); ?></p> 							
	<label><?php echo formatDateTime($msg['Message']['created']); ?></label> 
</li>		
		

<?php }}} ?>	
