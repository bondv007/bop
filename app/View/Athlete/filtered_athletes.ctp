<?php if(!empty($athletes)){ 
							$k=1;
							foreach($athletes as $region => $aff_data){ ?>
						
						<div class=""> <h3 class="blue-text"> <?php echo $region; ?> </h3></div>		
						 <div class="slider_container_<?php echo $k; ?> region_box">				 
						<?php  	$j=0;		 
								for($i=0; $i<ceil(count($aff_data)/3); $i++){   ?>						
								
							<ul class="compition-sBox mt10">
									
								<?php if(isset($aff_data[$j])){ ?>
								<li>	
									<div class="colum <?php if($j%3 == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo ''; ?>'">
										<div class="image">
		                                	<div class="black-strip"><?php echo $aff_data[$j]['User']['first_name'].' '.$aff_data[$j]['User']['last_name']; ?> </div>
											<a href="<?php if(!empty($aff_data[$j]['User']['username'])) echo $this->webroot.'profile/'.$aff_data[$j]['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$aff_data[$j]['User']['id'].'/'.$aff_data[$j]['User']['photo']; ?>" alt=""  />
											</a>
											
										</div>
										
									</div>
								</li>
								<?php } ?>
								
								<?php if(isset($aff_data[$j+1])){ ?>
								<li>	
									<div class="colum <?php if(($j+1)%3 == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo ''; ?>'">
										<div class="image">
		                                	<div class="black-strip"><?php echo $aff_data[$j+1]['User']['first_name'].' '.$aff_data[$j+1]['User']['last_name']; ?> </div>
											<a href="<?php if(!empty($aff_data[$j+1]['User']['username'])) echo $this->webroot.'profile/'.$aff_data[$j+1]['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$aff_data[$j+1]['User']['id'].'/'.$aff_data[$j+1]['User']['photo']; ?>" alt="" />
											</a>
											
										</div>
										
									</div>
								</li>
								<?php } ?>
								
								
								<?php if(isset($aff_data[$j+2])){ ?>
								<li>	
									<div class="colum <?php if(($j+2)%3 == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo ''; ?>'">
										<div class="image">
		                                	<div class="black-strip"><?php echo $aff_data[$j+2]['User']['first_name'].' '.$aff_data[$j+2]['User']['last_name']; ?> </div>
											<a href="<?php if(!empty($aff_data[$j+2]['User']['username'])) echo $this->webroot.'profile/'.$aff_data[$j+2]['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$aff_data[$j+2]['User']['id'].'/'.$aff_data[$j+2]['User']['photo']; ?>" alt="" />
											</a>
											
										</div>
										
									</div>
								</li>
								<?php } 								
									$j+=3; 	?>						
									
								</ul>		
								
							<?php 	} ?>
							</div>
							<ul class="row tCenter step_paging step_tabs_<?php echo $k; ?>">
								
							</ul>
							<script type="text/javascript">
							 $(document).ready(function(){	
	
								 $('.slider_container_<?php echo $k; ?>').cycle({
										speed: 1000,
										timeout:3000,
										fx: 'fade',
										pager: '.step_tabs_<?php echo $k; ?>',
										activePagerClass: 'active',
										pagerAnchorBuilder: function(idx, slide) {
											return '<li><a href="javascript://"></a></li>';
										}
									});
							});
							</script>
							<div class="clear"></div>
							<?php  $k++;  } }else{ ?>
							
								
							<div style="height: 150px; text-align:center;">
							<p style="margin-top:70px;">No athletes found.</p>
							</div>
							
							<?php } ?>