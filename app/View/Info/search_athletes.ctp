
						
		<?php if ( !empty($athletes) ){ ?>			
					<?php 
						
						$i=1;		
						foreach($athletes as $ev) { ?>
					
					<div class="list-tabing">
					
						<div class="tab-content">
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		
								
								<tr>
										
										<td width="100">
											<a href="<?php if(!empty($ev['User']['username'])) echo $this->webroot.'profile/'.$ev['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$ev['User']['id'].'/thumb_'.$ev['User']['photo']; ?>"  alt="" />
											</a>
										</td>
										<td style="vertical-align: top;">
											<div class="float-left text-left w100 h22">
												<h1><a href="<?php  if(!empty($ev['User']['username'])) echo $this->webroot.'profile/'.$ev['User']['username']; else echo '#'; ?>"><?php echo $ev['User']['first_name'].' '.$ev['User']['last_name']; ?></a></h1> 
											</div>
											<div class="float-left text-left w100 h44">
												<?php if(!empty($ev['User']['profile_description']))
												echo wraptext(strip_tags($ev['User']['profile_description']), 280);
												else echo '<i>Not Available</i>';  ?>				
											</div>
											<?php  if(!empty($ev['User']['username'])) { ?>
											<div class="float-right">
												<a href="<?php echo $this->webroot.'profile/'.$ev['User']['username']; ?>">View more..</a>
											</div>
											<?php } ?>
										</td>
									</tr>
										
									
								</table>
							</div>
						

						</div>
					
					</div>
					<?php $i++; } ?>
						
					<?php
						if(!isset($url)){
								$url=array('controller'=>$this->params['controller'],'action'=>'search_athlete');
								//$url=$this->passedArgs;
							}
						$this->Paginator->options(array(
									'url' => $url,
									'update' => '.athlete_listing',
									'data' => http_build_query($data),
									'evalScripts' => true,
									'method' => 'POST'
						));
						?>
				<div class="list_tabbing">
					<div class="tab-content">	
						<?php if(count($athletes) >= 5) {?>	
					<div class="pagination">
						<ul>
						<?php
							echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled','tag'=>'li','disabledTag' => 'a'));
							
							echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled','tag'=>'li','disabledTag' => 'a')); 
						?>
						</ul>
					</div>	
					<?php } ?>
				</div>
			</div>		
		<?php }else{ ?>
				<div class="list_tabbing">
					<div class="tab-content" style="height:100px; text-align: center;">
						<div style="margin-top: 50px;">No results found</div>
					</div>
				</div>	
			<?php } ?>		
			

<?php
	echo $this->Js->writeBuffer();
?>				