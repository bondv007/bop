<?php ?>	
<style>
#successMessage{ margin-bottom: 0 !important;}    

</style>
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
				<?php 
					echo $this->Session->flash('success');
					echo $this->Session->flash('error');
					echo $this->Session->flash();
				?>
				<div class="row">
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3>FUTURE EVENTS</h3>								
							</div>														
						</div><!--.left-column-->
					</div>	
					<div class="list-tabing">
					
						<div class="tab-content">
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>		
										<th scope="col" width="50"><a href="javascript://">S.No.</a></th>
										
										
										<th scope="col"><?php echo 'Wod'; ?></th>
										<th scope="col"><?php echo 'Challenge Date'; ?></th>
										<th scope="col"><?php echo 'Time'; ?></th>
										<th scope="col"><?php echo 'Verification Required'; ?></th>
										
									</tr>
									
								<?php 
									if ( !empty($pending_list) ){
									$i=1;		
									foreach($pending_list as $ev) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										
										<td>
												<?php echo $ev['ChallengeWod']['Wod']['title']; ?>
											
										</td>
										
										<td><?php echo formatDate($ev['Challenge']['date']); ?></td>
										<td><?php echo $ev['Challenge']['time']; ?></td>
										<td><?php echo $ev['Challenge']['require_verification']; ?></td>
										
										
									</tr>
									<?php $i++; }}else{ ?>
										
										<tr style="height: 120px;">
											<td colspan="8" style="text-align: center; margin-top: 50px;">No challenges found</td>
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

