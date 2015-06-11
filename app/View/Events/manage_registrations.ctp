<?php ?>	
	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
		
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
										
										<th scope="col"><?php echo $this->Paginator->sort('User.first_name','First Name'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('User.last_name','Last Name'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('User.email','Email'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('EventRegistration.payment_status','Payment Status'); ?></th>		
										
									</tr>
									
								<?php 
									if ( !empty($users) ){
									$i=1;		
									foreach($users as $us) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $us['User']['first_name']; ?></td>
										<td><?php echo $us['User']['last_name']; ?></td>
										<td><?php echo $us['User']['email']; ?></td>
										<td><?php echo $us['EventRegistration']['payment_status']; ?></td>
												
									</tr>
									<?php $i++; 
									
									}}else{ ?>
 									
									<tr>
										<td colspan="5">No users registered</td>
									</tr>
								<?php	} ?>
									
								</table>
							</div>

						</div>
					
					</div>
					
			</div>
		</div>
	</section>
	<!-- MId Section End -->

