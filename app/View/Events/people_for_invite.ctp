<?php 

	if(!empty($users)){ 
		foreach($users as $us) {
?>

  <div class="invitePeople"> 
  <label>
  <span class="checkBox"> 
	<input class="people_check" type="checkbox" name="people[]" title="<?php echo $us['User']['first_name'].' '.$us['User']['last_name']; ?>" value="<?php echo $us['User']['id']; ?>" />
   </span>
	<div class="msg-img" style="height:63px;"> <img src="<?php echo $this->webroot.'files/'.$us['User']['id'].'/thumb_'.$us['User']['photo']; ?>" alt=""></div>
	<span class="name"><?php echo $us['User']['first_name'].' '.$us['User']['last_name']; ?></span><br>
	<span class="type">Type: <?php echo ucfirst($us['User']['user_type']); ?></span>
  </label>
  </div>
  
  <?php }} ?>
   
