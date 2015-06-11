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
								<h3>CHALLENGE REQUESTS</h3>								
							</div>														
						</div><!--.left-column-->
					</div>	
					<div class="list-tabing">
					
						<div class="tab-content">
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>		
										<th scope="col" width="50"><a href="javascript://">S.No.</a></th>
										
										<th scope="col"><?php echo $this->Paginator->sort('User.first_name','From'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Wod.title','Wod'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Challenge.date','Challenge Date'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Challenge.time','Time'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Challenge.require_verification','Verification Required'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('Challenge.created','Request Date'); ?></th>
										<th scope="col"><a href="javascript://">Status</a></th>
										<th scope="col"><a href="javascript://">Actions</a></th>										
									</tr>									
								<?php 
									if ( !empty($requests) ){
									$i=1;		
									foreach($requests as $ev) {
										if($ev['Challenge']['from_id'] != $this->Session->read('Auth.User.id')){ 
										 ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $ev['User']['first_name'].' '.$ev['User']['last_name']; ?></td>
										<td>
											<a href="javascript://" onclick="open_lightbox('<?php echo $this->webroot.'challenges/get_wod_info/'.$ev['Challenge']['id']; ?>','600px', '400px');">
												<?php echo $ev['Wod']['title']; ?>
											</a>
										</td>
										
										<td><?php echo formatDate($ev['Challenge']['date']); ?></td>
										<td><?php echo $ev['Challenge']['time']; ?></td>
										<td><?php echo $ev['Challenge']['require_verification']; ?></td>
										<td><?php echo formatDateTime($ev['ChallengePeople']['created']); ?></td>
										<td><?php 
											if($ev['ChallengePeople']['status'] == 'Accepted'){												
												echo $ev['ChallengePeople']['status']; 												
											}else{
												
												if($ev['Challenge']['date'] < date('Y-m-d') && $ev['ChallengePeople']['status'] != 'Contested'){
													echo 'Expired';	
												}else{
													if($ev['ChallengePeople']['status'] == 'Pending')
														echo 'Challenged';
													else 
														echo $ev['ChallengePeople']['status']; 
												}
											}
											?></td>
										<td>
											<a href="javascript://" onclick="open_lightbox('<?php echo $this->webroot.'challenges/view/'.$ev['Challenge']['id']; ?>','500px','400px');">View</a>
												
											<?php if($ev['ChallengePeople']['status'] == 'Accepted'){
														
													$challenge_time = $ev['Challenge']['date'].' '.$ev['Challenge']['time'];
													if(strtotime($challenge_time) < strtotime(date('Y-m-d H:i:s'))){												
												 ?>
												<br>
												 <a href="javascript://" onclick="open_lightbox('<?php echo $this->webroot.'challenges/submit_score/'.$ev['ChallengePeople']['id']; ?>','600px','400px');">Submit</a>
											
											<?php }}else if($ev['ChallengePeople']['status'] == 'Contested'){  ?>
												<br>
												 <a href="javascript://" onclick="open_lightbox('<?php echo $this->webroot.'challenges/view_participants/'.$ev['Challenge']['id']; ?>','600px','400px');">Submitted</a>
											
											<?php }?>
													
										</td>			
									</tr>
									<?php $i++; }}}else{ ?>
										
										<tr style="height: 120px;">
											<td colspan="8" style="text-align: center; margin-top: 50px;">No requests found</td>
										</tr>
									<?php } ?>									
								</table>
							</div>
							<?php if(count($requests) > 15){ ?>
							<div class="pagination addAthleat">
								<?php echo $this->Paginator->prev('Prev'); ?><?php echo $this->Paginator->numbers(); ?><?php echo $this->Paginator->next('Next'); ?>
							</div>
							<?php } ?>

						</div>
					
					</div>
					
			</div>
		</div>
		</div>
	</section>
	<!-- MId Section End -->

