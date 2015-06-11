<style>
	#cntct-detail label.error { margin-bottom:-5px;}
	#cntct-detail{ height: auto;}
	input:invalid, textarea:invalid { box-shadow:none; border-radius: 0;}
</style>
<script>
	$(document).ready(function(){
		$("#cntct-detail").validate({
			rules:{
				recaptcha_response_field: {
					required: true
				}
			},
			submitHandler: function(frm){
				$(frm).find('input[type=submit],button[type=submit]').attr('disabled', 'disabled');
				$(frm).submit();
			}
		});
		
		$(".datepicker").datepicker({ minDate: new Date() });
	})
</script>

	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid events-map">
			<div class="row">
				<div class="contact mb60">
                	<h1>Sponsorship Inquiries </h1>
               	<?php 
					if(!empty($row_blk_top['Block']['content']))
					{
						echo '<p>'.$row_blk_top['Block']['content'].'</p>';
					}
				?>
                </div>
			</div>
		</div>
	</section>
	<!-- Slider End -->
	
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid event-colum">
		<?php echo $this->Xicom->display_errors($errors); ?>
             <!--right contact form-->
             	<div class="contact-form">
                <div class="leaderboard">
                	<h2> Sponsorship Enquiry Form </h2>
                </div>
                <div class="clear"></div>
					
                <?php
					echo $this->Form->create('ContactUs', array('id' => 'cntct-detail','url' => $this->Html->url( null, true ), 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false)));
				?>	
                        <label> First Name <br/>
                        	<?php echo $this->Form->input('first_name', array('class' => 'required', 'type' => 'text')); ?>
                        </label>
                        <label class="pull-right"> Last Name <br/>
                        	<?php echo $this->Form->input('last_name', array('class' => 'required', 'type' => 'text')); ?>
                        </label>
                    	<label> Email Address<br/>
                        	<?php echo $this->Form->input('email_id', array('class' => 'required email', 'type' => 'text')); ?>
                        </label>
                    	<label class="pull-right">
                        	Sponsorship for<br/>
                        	<?php echo $this->Form->input('sponsorship_type', array('class'=>'required', 'options' => $ARR_SPONSORSHIP_TYPE) )?>
                        </label>
						<div class="clear"></div>
                        <label>Date of the event<br/>
                        	<?php echo $this->Form->input('event_date', array('class' => 'required datepicker', 'type' => 'text')); ?>
                        </label>
                       <label class="messge">Message<br/>
							<?php echo $this->Form->textarea('message', array('class' => 'required' )); ?>
                        </label>
                        
						<div class="clear"></div>
                       <input type="submit" value="SUBMIT" class="rgist-btn"/>
                        <div class="clear"></div>
                    </form>
                    
                </div>
             
             <!--right contact form End -->
        </div>
	</section>
	<!-- MId Section End -->
