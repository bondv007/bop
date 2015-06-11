<?php
	echo $this->Html->script('jquery-ui.custom'); 
	echo $this->Html->css(array('jquery-ui.custom')); 
 ?>
 	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<div class="left-column column">
							<div class="header">
								<h3>Individual Registration</h3>
								<a href="<?php echo $this->webroot.'events/event_details/'.$event['Event']['id']; ?>" class="back">BACK</a>
								<div class="clear"></div>
								
							</div>

							<div class="column-body">
								<?php 
									echo $this->Session->flash('success');
									echo $this->Session->flash('error');
									echo $this->Session->flash();
								?>
								<div class="event-box">
									<div class="image">
										<img src="<?php echo $this->webroot.'files/events/'.$event['Event']['id'].'/'.$event['Event']['picture']; ?>" alt="">
										<span class="black-trans"><?php echo $event['Event']['title']; ?></span>
									</div>

									<div class="event-data">
										<h4>Event Description</h4>
										<dl>
											<dt>Date</dt>
											<dd><?php echo formatDate($event['Event']['start_date']).'<br><span style=" margin-left: 34px;">to<span><br>'.formatDate(date('Y-m-d', strtotime($event['Event']['start_date']) + ($event['Event']['duration'] * 24 * 60 * 60))); ?></dd>
										</dl>
										<dl>
											<dt>Cost</dt>
											<dd><?php 
												if(!empty($event['Eventprice']))
												{
													$count_price = count($event['Eventprice']);
													$i=1;
													foreach($event['Eventprice'] as $price)
													{
														echo '$'.$price['price'];
														if($i != $count_price)
														{
															echo '<br>';	
														}
														$i++;	
													}	
												}
											?></dd>
										</dl>
										<dl>
											<dt>Divisions</dt>
											<dd><?php
													if(!empty($event['EventWod']))
													{
														$count_wod = count($event['EventWod']);
														$i=1;
														foreach($event['EventWod'] as $wod) 
														{	
															echo $wod['division_type'];
															if($i != $count_wod)
															{
																echo ',';	
															}
															$i++;
														}
													} else { echo '-'; } ?>
												</dd>
										</dl>
										<!--<dl>
											<dt>Male</dt>
											<dd>-</dd>
										</dl>
										<dl>
											<dt>Female</dt>
											<dd>-</dd>
										</dl>
										<dl>
											<dt>Prizes</dt>
											<dd>-</dd>
										</dl>-->
									</div>
								</div>

								<div class="form-container">
									<?php echo $this->Form->create('EventRegistration',array('id' => 'EventRegistrationForm')); ?>
									
									<?php echo $this->Form->input('event_id',array('type' => 'hidden', 'value' => $event['Event']['id'])); ?>
										<ul class="two-columns">
											<li>
												
											  <?php echo $this->Form->label('User.first_name','First Name'); 
													echo $this->Form->input('User.first_name',array('type'=>'text','class'=>'required','label'=>false,'div'=>false, 'required' => false)); 
												?>	
												
											</li>
											<li>
											  <?php echo $this->Form->label('User.last_name','Last Name'); 
													echo $this->Form->input('User.last_name',array('type'=>'text','class'=>'required','label'=>false,'div'=>false, 'required' => false)); 
												?>	
											</li>
										</ul>
										<ul class="two-columns">
											<li>
										 
												
												 <?php 
												 	echo $this->Form->label('EventRegistration.team','Team (Optional)'); 
													echo $this->Form->input('EventRegistration.team',array('type'=>'text','class'=>'','label'=>false,'div'=>false, 'required' => false)); 
												?>
											</li>
											<li>
											<?php echo $this->Form->label('User.gender','Gender'); 
												  echo $this->Form->input('User.gender',array('type'=>'select','options'=>array('Male'=>'Male','Female'=>'Female'),'class'=>'required','div'=>false,'label'=>false));	
												?>	
												
											</li>
										</ul>
										<ul class="two-columns">
											<li>
											<?php echo $this->Form->label('EventRegistration.division','Division'); 
												  echo $this->Form->input('EventRegistration.division',array('type'=>'select','options'=>$divisions,'class'=>'required','div'=>false,'label'=>false));	
												?>	
												
											</li>
											<li class="with-calendar">
												<?php echo $this->Form->label('User.date_of_birth','Date of Birth'); 
													echo $this->Form->input('User.date_of_birth',array('type'=>'text','class'=>'required datepick','label'=>false,'div'=>false)); 
												?>	
												<a href="javascript:void(0)" class="calendar" style="background:no-repeat"><img src="<?php echo $this->webroot; ?>images/calendar.png" alt="" style="margin-left: -29px;margin-top: -4px;"></a>
											</li>
										</ul>
										<ul>
											<li>
											<?php echo $this->Form->label('EventRegistration.affiliate','CrossFit Affiliate'); 
													echo $this->Form->input('EventRegistration.affiliate',array('type'=>'text','class'=>'required','label'=>false,'div'=>false)); 
												?>	
												
											</li>
										</ul>
										
										<ul>
											<li>
											<?php echo $this->Form->label('User.email','Email Address'); 
													echo $this->Form->input('User.email',array('type'=>'text','class'=>'required email','label'=>false,'div'=>false, 'value' => $this->Session->read('Auth.User.email'), 'required' => false)); 
												?>	
											</li>
										</ul>
										<ul class="checkbox_ul">
											<li>
												<label class="check"><input type="checkbox" class="" value="1" name="is_new_register" /> Register account on GameOn</label>
											</li>
										</ul>
										<ul class="checkbox_ul">
											<li>
												<label class="check"><input type="checkbox" class="required" value="1" name="terms" /> I accept to abide by all terms & conditions.</label>
											</li>
										</ul>
										
										<div class="buttons-section">
											
											<?php echo $this->Form->button('Register',array('type' => 'submit', 'id' =>'register_submit', 'class' => 'blue_btn')); ?>
											
										</div>
										
									<?php echo $this->Form->end(); ?>
								</div>
								<div class="clear"></div>
							</div>
						</div><!--.left-column-->

						<div class="right-column column sponcers">
							<div class="inlineRow">
								<div class="header">
									<h3>Sponsers</h3>
								</div>

								<div class="column-body">
									<div class="image"><a href="javascript:void(0)"><img src="<?php echo $this->webroot; ?>images/sponcer.jpg" alt=""></a></div>
									<div class="image"><a href="javascript:void(0)"><img src="<?php echo $this->webroot; ?>images/sponcer.jpg" alt=""></a></div>
									<div class="image"><a href="javascript:void(0)"><img src="<?php echo $this->webroot; ?>images/sponcer.jpg" alt=""></a></div>
									<div class="image"><a href="javascript:void(0)"><img src="<?php echo $this->webroot; ?>images/sponcer.jpg" alt=""></a></div>
									<div class="image"><a href="javascript:void(0)"><img src="<?php echo $this->webroot; ?>images/sponcer.jpg" alt=""></a></div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->
	
<script type = "text/javascript">

$(document).ready(function(){
	
	$('.datepick').datepicker({ maxDate: 0 , dateFormat:"yy-mm-dd", changeMonth: true, changeYear: true, yearRange: "-70:+0",  });
	
	var availableTags = <?php echo $affiliates; ?>;
		
	$( "#EventRegistrationAffiliate" ).autocomplete({
			source: availableTags,
			focus: function( event, ui ) {
					$( "#EventRegistrationAffiliate" ).val( ui.item.label );
				return false;
			}
	});	
		
});


</script>	