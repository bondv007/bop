<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
			<div class="filter-search row">
				<?php if($this->Session->check('Auth.User')){ ?>
				 <div class="blue fRight">
                	<button type="submit" onclick="window.location.href='<?php echo $this->webroot.'users'; ?>'">Back to Dashboard</button>
                </div>
                <?php } ?>
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
								<h3>PAST EVENTS</h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="affiliate_listing">
						<div class="list-tabing">
					
							<div class="tab-content">
								<?php if(!empty($past_ev)){ ?>
								
								<?php if(isset($past_ev['competition'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" class="events_table" border="0" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Competitions</th>
											
										</tr>
										
										<?php 
											if ( !empty($past_ev['competition']) ){
											
											foreach($past_ev['competition'] as $ev) { ?>	
										<tr>	
											
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
											
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>
								
						<?php if(isset($past_ev['throwdown'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Throwdowns</th>
											
										</tr>
										
									<?php 
										if ( !empty($past_ev['throwdown']) ){
											
											foreach($past_ev['throwdown'] as $ev) { ?>	
										<tr>	
											
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
											
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>
								
							<?php if(isset($past_ev['challenge'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Challenge</th>
											
										</tr>
										
									<?php 
										if ( !empty($past_ev['challenge']) ){											
											foreach($past_ev['challenge'] as $ev) { ?>	
										<tr>										
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>												
										</tr>
										<?php }} ?>								
									</table>
								</div>
								<?php } ?>	
							</div>	
							
							<?php }else{ ?>
								<div style="height: 50px; text-align: center;">
									<span style="margin-top: 30px; display: block;">No events found</span>
								</div>
							<?php } ?>							
						</div>
					</div>	
			</div>		
			
			<div class="row">	
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3>ACTIVE EVENTS</h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="athlete_listing">
						<div class="list-tabing">
					
							<div class="tab-content">
								<?php if(!empty($active_ev)){ ?>
								
								<?php if(isset($active_ev['competition'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Competitions</th>
											
										</tr>
										
										<?php 
											if ( !empty($active_ev['competition']) ){
											
											foreach($active_ev['competition'] as $ev) { ?>	
										<tr>	
											
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
											
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>
								
						<?php if(isset($active_ev['throwdown'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Throwdowns</th>
											
										</tr>
										
										<?php 
											if ( !empty($active_ev['throwdown']) ){
											
											foreach($active_ev['throwdown'] as $ev) { ?>	
										<tr>	
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>
								
							<?php if(isset($active_ev['challenge'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Challenge</th>
											
										</tr>
										
										<?php 
											if ( !empty($active_ev['challenge']) ){
											
											foreach($active_ev['challenge'] as $ev) { ?>	
										<tr>	
											
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
											
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>	
							<?php }else{ ?>
								<div style="height: 50px; text-align: center;">
									<span style="margin-top: 30px; display: block;">No events found</span>
								</div>
							<?php } ?>		
							</div>
						
						</div>
					</div>	
			</div>	
			
			<div class="row">	
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3 id="future_events">FUTURE EVENTS</h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="event_listing">
						<div class="list-tabing">
					
							<div class="tab-content">
								
								<?php if(!empty($future_ev)){ ?>
								
								<?php if(isset($future_ev['competition'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Competitions</th>
											
										</tr>
										
										<?php 
											if ( !empty($future_ev['competition']) ){
											
											foreach($future_ev['competition'] as $ev) { ?>	
										<tr>	
											
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
											
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>
								
						<?php if(isset($future_ev['throwdown'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Throwdowns</th>
											
										</tr>
										
										<?php 
											if ( !empty($future_ev['throwdown']) ){
											
											foreach($future_ev['throwdown'] as $ev) { ?>	
										<tr>	
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>	
											
										</tr>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>
								
							<?php if(isset($future_ev['challenge'])){ ?>
								<div id="competitions" class="tab-content-list">
									<table width="100%" border="0" class="events_table" cellspacing="0" cellpadding="0">
										
										<tr class="highlight">
											<th scope="col">Challenge</th>
											
										</tr>
										
										<?php 
											if ( !empty($future_ev['challenge']) ){
											
											foreach($future_ev['challenge'] as $ev) { ?>	
												
										<tr>	
											
											<th scope="col">
												<a class="arrow-right" href="<?php echo $this->webroot.'events/event_scores/'.$ev['Event']['id']; ?>">
												<span class="title">
													<?php echo '<strong>'.$ev['Event']['title'].'</strong> ('.formatDate($ev['Event']['start_date']).') - '.$ev['Event']['location']; ?>
												</span>
												<span class="right">
													<img src="<?php echo $this->webroot.'images/arrow-right.png'; ?>" alt="">
												</span>
												</a>
											</th>		
																						
										</tr>
										</a>
										<?php }} ?>						
									
									</table>
								</div>
								<?php } ?>	
								
							<?php }else{ ?>
								<div style="height: 50px; text-align: center;">
									<span style="margin-top: 30px; display: block;">No events found</span>
								</div>
							<?php } ?>	
							</div>
						
						</div>
					</div>	
			</div>			
				
			
			
			
				
		</div>
	</section>
	<!-- MId Section End -->