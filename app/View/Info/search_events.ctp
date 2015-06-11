						
		<?php if ( !empty($events) ){ ?>			
					<?php 
						
						$i=1;		
						foreach($events as $ev) { ?>
					
					<div class="list-tabing">
					
						<div class="tab-content">
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">																	
								
									<tr>
										
										<td width="100">
											<a href="<?php  echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>">	
												<img src="<?php echo $this->webroot.'files/events/'.$ev['Event']['id'].'/thumb_'.$ev['Event']['picture']; ?>" alt="" />
											</a>
										</td>
										<td style="vertical-align: top;">
											<div class="float-left text-left w100 h22">
												<h1>
											<a href="<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>">		
												<?php echo $ev['Event']['title']; ?>
											</a>
											<?php 	
												
												if($ev['Event']['start_date'] < date('Y-m-d'))
												{
													$ev_duration_sec = $ev['Event']['duration']*60*60*24;
													$end_date = date('Y-m-d', strtotime($ev['Event']['start_date']) + $ev_duration_sec);
													 
													if(date('Y-m-d') > $ev['Event']['start_date'] && date('Y-m-d') < $end_date)
													{
														$event_status = '(<i>In progress</i>)';
													}else if(date('Y-m-d') > $ev['Event']['start_date'])
													{
														$event_status = '(<i>Complete</i>)';
													}else{
														$event_status = '(<i>'.formatDate($ev['Event']['start_date']).'</i>)';
													}
													
												}else{
													$event_status = '(<i>'.formatDate($ev['Event']['start_date']).'</i>)';
												}
												echo ' - '.ucfirst($ev['Event']['event_type'].' '.$event_status); ?></h1> 
											</div>
											<div class="float-left text-left w100 h44">
												<?php 
													echo '<i>'.$ev['Event']['location'].'</i><br>';
												if(!empty($ev['Event']['details']))
												echo wraptext(strip_tags($ev['Event']['details']), 260);
												else echo '<i>Not Available</i>';  ?>				
											</div>
											<div class="float-right">
												<a href="<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>">View more...</a>
											</div>
										</td>
								
								
															
								</table>
							</div>
						</div>
					
						</div>
					<?php $i++; } ?>
						
					<?php
						if(!isset($url)){
								$url=array('controller'=>$this->params['controller'],'action'=>'search_event');
								//$url=$this->passedArgs;
							}
						$this->Paginator->options(array(
									'url' => $url,
									'update' => '.event_listing',
									'data' => http_build_query($data),
									'evalScripts' => true,
									'method' => 'POST'
						));
						?>
				<div class="list_tabbing">
					<div class="tab-content">	
					<?php if(count($events) >= 5) {?>		
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