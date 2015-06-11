<?php ?>	
	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
		<!--	<div class="filter-search row">
				<h2>Search Filters</h2>
				<form action="#">
					<div class="colum">
						<select>
							<option>Date</option>
						</select>						
					</div>
					<div class="colum">
						<select>
							<option>Region</option>
						</select>						
					</div>
					<div class="colum">
						<select>
							<option>State</option>
						</select>						
					</div>
					<div class="colum">
						<select>
							<option>Affiliate</option>
						</select>						
					</div>
					<div class="colum">
						<select>
							<option>Athlete</option>
						</select>						
					</div>
				</form>
								
			</div>-->
		</div>
	</section>
	<!-- Slider End -->
	
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				
				<div class="row">
					<div class="list-tabing">
					
						<div class="tab-content">
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>		
										<th scope="col" width="50">S.No.</th>
										
										<th scope="col"><?php echo $this->Paginator->sort('Event.title','Title'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Event.event_type','Type'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Event.start_date','Start Date'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Event.number_of_registrations','No. of Athletes'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Event.location','Location'); ?></th>
										<th scope="col">Status</th>
										<th scope="col">Actions</th>
										
									</tr>
									
								<?php 
									if ( !empty($events) ){
									$i=1;		
									foreach($events as $ev) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $ev['Event']['title']; ?></td>
										<td><?php echo ucwords($ev['Event']['event_type']); ?></td>
										<td><?php echo formatDate($ev['Event']['start_date']); ?></td>
										<td><?php echo $ev['Event']['number_of_registrations']; ?></td>
										<td><?php echo $ev['Event']['location']; ?></td>
										<td><?php if ( $ev['Event']['start_date'] < date('Y-m-d') ) echo 'Started'; 
													else if ( $ev['Event']['status'] == '1') echo 'active'; 
													else if ( $ev['Event']['status']  == '0') echo 'Inactive';	?></td>
										<td>
											<?php if ( $ev['Event']['start_date'] > date('Y-m-d') ) { ?>
											
											<a href="<?php echo $this->webroot.'events/edit_event/'.$ev['Event']['id']; ?>">Edit</a>
											<!--<?php 
												
												if ( $ev['Event']['status'] == '0' ){ ?>		
												
												<a href="javascript://" onclick="update_event_status('<?php echo $ev['Event']['id']; ?>',0);">Activate</a>
											
											<?php } else { ?>											
											
												<a href="javascript://" onclick="update_event_status('<?php echo $ev['Event']['id']; ?>',1);">Deactivate</a>
											
											<?php } ?>-->
												
											<?php } else { echo '-'; } ?>	
										</td>			
									</tr>
									<?php $i++; }} ?>
									
								</table>
							</div>

						</div>
					
					</div>
					
			</div>
		</div>
	</section>
	<!-- MId Section End -->

