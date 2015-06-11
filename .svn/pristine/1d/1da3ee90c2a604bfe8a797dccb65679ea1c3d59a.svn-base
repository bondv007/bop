<?php
	echo $this->Html->script('jquery-ui.custom'); 
	echo $this->Html->css(array('jquery-ui.custom')); 
 ?> 

<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns regsiter-2">
						<div class="right-column column sponcers">
							<div class="inlineRow">
								<div class="header">
									<h3>Recommended Events</h3>
								</div>

								<div class="column-body">
									<?php if( !empty($recommended) ){
											foreach($recommended as $rd){ 
										 ?>
									<div class="event">
										<a href="<?php echo $this->webroot.'events/event_details/'.$rd['Event']['id']; ?>">
										<div class="image">
											<img src="<?php echo $this->webroot.'files/events/'.$rd['Event']['id'].'/big_'.$rd['Event']['picture']; ?>" alt="">
											<span class="black-trans"><?php echo $rd['Event']['title']; ?></span>
											<a href="<?php echo $this->webroot.'events/event_details/'.$rd['Event']['id']; ?>" class="register">Register</a>
										</div>
										<div class="dated"><?php echo formatDate($rd['Event']['start_date']); ?></div>
										</a>
									</div>

									<?php }} ?>
								</div>
							</div>
							<div class="clear"></div>
						</div><!--.right-column-->

						<div class="left-column column">
							<div class="inlineRow">
								<div class="header">
									<h3>Individual Registration</h3>
									<a href="javascript:void(0)" class="back">BACK</a>
									<div class="clear"></div>
								</div>

								<div class="column-body">
									<?php 
									echo $this->Session->flash('success');
									echo $this->Session->flash('error');
									echo $this->Session->flash();
								?>
									<div class="form-container">
										<?php echo $this->Form->create('Payment',array('id' => 'PaymentForm', 'url' => array('controller' => 'accounts', 'action' => 'process_payment'))); ?>
										
										<?php 
											echo $this->Form->input('register_id', array('type' => 'hidden', 'value' => $details['EventRegistration']['id'])); 
											echo $this->Form->input('amount', array('type' => 'hidden', 'value' => intval($total_cost))); 	
											echo $this->Form->input('event_id', array('type' => 'hidden', 'value' => $details['EventRegistration']['event_id'])); 	
											
											if(!empty($details['EventRegistration']['user_id']))
											{
												$email = $details['User']['email'];
											}else{
												$email = $details['EventRegistration']['email'];
											}
											
											echo $this->Form->input('email', array('type' => 'hidden', 'value' => $email));
										?>
											<ul>
												<li class="column">
													<label class="nowrap">Card Number</label>
													<input type="text" class="required number" maxlength="16" name="data[Payment][card_number]"> 
												</li>												
											</ul>
											<ul>
												<li>
													<label>Name on the Card</label>
													<input type="text" class="required" maxlength="30" name="data[Payment][name]"> 
												</li>
											</ul>
											<ul class="two-columns clear-after">
												<li class="with-calendar">
													<label>Expiration Date</label>
													<input type="text" placeholder="Select a date range" class="required datepick" name="data[Payment][expire_date]">
													<a href="javascript:void(0)" class="calendar" style="background:no-repeat"><img src="<?php echo $this->webroot; ?>images/calendar.png" alt="" style="margin-left: -29px;margin-top: -4px;"></a>
												</li>
											</ul>
											<ul class="four-columns clear-after">
												<li class="column">
													<label>CVC</label>
													<input type="text" class="required number" maxlength="3" name="data[Payment][cvv]">
												</li>
											</ul>
											<div class="buttons-section">
												<button class="blue_btn" type="submit" id="payment_submit">Submit</button>
											</div>
										<?php echo $this->Form->end(); ?>
									</div>

									<div class="costing">
										<h3>Competition Costs</h3>
									
										<div class="cost">
											
										<?php
											$total = 0;
											if(!empty($details['Eventprice'])){ 									
												foreach($details['Eventprice'] as $price) {
										?>
										<dl>
											<dt><?php if($price['date'] == date('Y-m-d')) echo 'Today'; else echo 'By '.formatDate($price['date']); ?></dt> 
											<dd><?php echo '$'.$price['price']; ?> </dd>
										</dl>
																   
										<?php $total += $price['price']; }} ?>
											
										</div>

										<div class="total">
											<dl>
												<dt>Total Cost</dt>
												<dd><?php echo '$'.$total_cost; ?></dd>
											</dl>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
						</div><!--.left-column-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->

<script type="text/javascript">

$(document).ready(function(){	
	$('.datepick').datepicker({ minDate: 0 , dateFormat:"yy-mm-dd", changeMonth: true, changeYear: true });			
});

</script>	
