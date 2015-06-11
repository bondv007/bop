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
								<h3>Manage Athletes </h3>
								<div class="blue save-btn">								
                                  <div class="submit">																 
										<div class="blue">
												<button onclick="window.location.href='<?php echo $this->webroot.'affiliate/add_athlete'; ?>'" type="submit" style="float:right;">Add Athlete</button>
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
										<th scope="col"><?php echo $this->Paginator->sort('Athlete.photo','Photo'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Athlete.first_name','Name'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Athlete.email','Email'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Athlete.status','Status'); ?></th>										
									</tr>
									
								<?php 
									if ( !empty($athletes) ){
									$i=1;		
									foreach($athletes as $ev) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td>
											<?php	if(!empty($ev['Athlete']['photo'])){ ?>
												<img src="<?php echo $this->webroot.'files/athlete/'.$ev['Athlete']['id'].'/thumb_'.$ev['Athlete']['photo']; ?>" alt="Image Not Available" />
											<?php }else{ ?>	  
												<img src="<?php echo $this->webroot.'images/image_not_available.jpg'; ?>" height="80" width="80" alt="Image Not Available" />
											<?php } ?>
										</td>	
										<td><?php echo $ev['Athlete']['first_name'].' '.$ev['Athlete']['last_name']; ?></td>
										<td><?php echo $ev['Athlete']['email']; ?></td>
										<td><?php echo $ev['Athlete']['status']; ?></td>
												
									</tr>
									<?php $i++; }}else{ ?>
									
									<tr>
										<td colspan="5">No Athletes Connected</td>
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

