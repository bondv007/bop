<div class="head-line"> <h4> Athletes I Follow </h4></div>
<?php
 if(!empty($data)){

	$i=1;
	foreach($data as $dat){
		
		if($i==1){	
?>
<div class="athelete-box">
<?php } ?>

		<div class="mng-cnter wood mb20 following headings">
		 			<div class="black-heading"><img src="<?php echo $this->webroot.'files/'.$dat['User']['id'].'/thumb_'.$dat['User']['photo']; ?>" alt=""> 
		 				<h3><?php echo $dat['User']['first_name'].' '.$dat['User']['last_name']; ?></h3></div>
						<ul>
							<?php 
								if(!empty($dat['User']['EventRegistration'])){
									foreach($dat['User']['EventRegistration'] as $evr){	
							 ?> 
							<li>
								<?php if(!empty($evr['final_score'])) $evr['final_score'] = ' - '.$evr['final_score']; ?>
								<a href="<?php echo $this->webroot.'events/event_details/'.$evr['Event']['id']; ?>"><?php echo $evr['Event']['title'].$evr['final_score']; ?></a>
								 <span class="sensex-img <?php if($evr['is_top_position'] == '1') echo 'green_arrow'; ?>">
								 
								 </span>
							</li>
							<?php }}else{ ?>
							<li style="margin-top:20px; text-align:center; border-bottom:none;">
							 No events found
							</li>		
							<?php } ?>		
							
						</ul>
			</div>
<?php $i++; if($i==4){ 
			$i=1;
	?>			
</div>
<?php } ?>

<?php }}else{ ?>
 		<div class="events-box messages-secion-inner" style="height: 80px; text-align:center;">
 			<div style="margin-top:30px;">No athletes found</div>
 		</div>	
 	<?php } ?>


