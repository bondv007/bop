<?php 

	if(!empty($users)) { 
	$i=0;
	foreach($users as $us){	
?>
	<li class="<?php if($i%2 == 0) echo 'evn'; ?>">  
			<label> New Athlete Signed up</label>
		<span><a href="<?php echo $this->webroot.'profile/'. $us['User']['username']; ?>" target="_blank"><?php echo $us['User']['first_name'].' '.$us['User']['last_name']; ?></a></span> 
	
	</li>
		
<?php }}else{ ?>
	<li style="height: 127px; text-align: center; margin-top:90px;">
		<span style="float:none;">No updates found</span>
	</li>
<?php } ?>		
