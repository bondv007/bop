	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
			
			<div class="filter-search row">
             <div class="blue fRight">
                	<button type="submit" onclick="window.location.href='<?php echo $this->webroot.'users'; ?>'">Back to Dashboard</button>
                </div>
            </div>
		</div>
	</section>
	<!-- Slider End -->
	
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				
				<div class="row">
					<div class="register-columns">
						<div class="column">
							<div class="header">
								<h3>Manage Coaches </h3>
								<div class="blue save-btn">								
                                  <div class="submit">																 
										<div class="blue">
												<button onclick="window.location.href='<?php echo $this->webroot.'affiliate/add_coach'; ?>'" type="submit" style="float:right;">Add Coach</button>
										 </div>
									</div>  
								</div>								  
								
							</div>
						</div>		
					</div>	
					<div class="list-tabing">						
						
						<div class="tab-content minhgt_300">
							<div id="competitions" class="tab-content-list">
								<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>		
										<th scope="col" width="50">S.No.</th>
										<th scope="col"><?php echo $this->Paginator->sort('Coach.photo','Image'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Coach.first_name','Name'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Coach.email','Email'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Coach.status','Status'); ?></th>										
									</tr>
									
								<?php 
									if ( !empty($coaches) ){
									$i=1;		
									foreach($coaches as $ev) { ?>
									<tr>
										<td valign="center"><?php echo $i; ?></td>
										<td><?php if(!empty($ev['Coach']['photo'])){ ?>
												<img src="<?php echo $this->webroot.'files/coach/'.$ev['Coach']['id'].'/thumb_'.$ev['Coach']['photo']; ?>" alt="Image not available" />	
											<?php	}else{  ?> 
												<img src="<?php echo $this->webroot.'images/image_not_available.jpg'; ?>" height="80" width="80" alt="Image Not Available" />
											<?php } ?>
										
										</td>
										<td valign="center"><?php echo $ev['Coach']['first_name'].' '.$ev['Coach']['last_name']; ?></td>
										<td valign="center"><?php echo $ev['Coach']['email']; ?></td>
										<td valign="center"><?php echo $ev['Coach']['status']; ?></td>
												
									</tr>
									<?php $i++; }}else{ ?>
									
									<tr>
										<td colspan="5">No Coach Found</td>
									</tr>
									
									<?php } ?>
								</table>
							</div>

						</div>
					
					</div>
					
			</div>
		</div>
	</section>
	<!-- MId Section End -->

