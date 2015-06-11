<div class="head-line"> <h4> Event I Follow </h4></div>
 	
 <?php if(!empty($events)){
 			$num = ceil(count($events)/3); 
 			 $j=1;
			 
		foreach($events as $ev){ 
 			if($j==1){	 ?>
 				
 	<div class="events-box">
 		<?php } ?> 
 		
 		
 		<div class="gry-box">
 			<a href="<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>">
 			<div class="uppr-sec"> 
 				<img src="<?php echo $this->webroot.'files/events/'.$ev['Event']['id'].'/thumb_'.$ev['Event']['picture']; ?>" alt="">
 				<div class="right-section">
 					<h2> <?php  echo $ev['Event']['title']; ?></h2>
 					<span title="<?php echo $ev['Event']['location']; ?>"> <?php echo wraptext($ev['Event']['location'],20); ?></span>
 					<span class="red-text"> <?php echo formatDate($ev['Event']['start_date']); ?> </span>
 				</div>
 			</div>
 			<p><?php echo wraptext(strip_tags($ev['Event']['details']), 50); ?></p>
 			</a>
 		</div>
 		
 <?php $j++; 
 		if($j==4){
 			$j=1;
  ?>		
 	</div>
 	<?php }}}else{ ?>
 		<div class="events-box messages-secion-inner" style="height: 80px; text-align:center;">
 			<div style="margin-top:30px;">No events found</div>
 		</div>	
 	<?php } ?>
