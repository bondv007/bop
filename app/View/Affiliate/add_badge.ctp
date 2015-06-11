<style>

.column-body.graybg.create-event input[type="text"], .column-body.graybg.create-event textarea, .column-body.graybg.create-event select, .column-body.graybg.create-event input[type="file"] { margin-bottom:0;}	
	
</style>

<?php
	echo $this->Html->script(array('jquery-ui.custom')); 
	echo $this->Html->css(array('jquery-ui.custom')); 
 ?>
 
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						
						<div class="column">
							
							<div class="header">
								<h3>ADD BADGE</h3>										  
								<div class="blue save-btn">								
                                  <button onclick="window.location='<?php echo $this->webroot.'affiliate/manage_badges'; ?>'">Back to Manage Badges</button>
								</div>
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
							<div class="column-body graybg create-event">							
								
							<div class="form-container no-lmr">		
									
									<?php echo $this->Form->create('Badge',array('type'=>'file',
																						'id'=>'AddBadgeForm',
																						'url'=>array('controller' => 'affiliate',
																										'action' => 'add_badge'))); ?>	
																										
									<?php echo $this->Form->input('Badge.user_id',array('type'=>'hidden','value'=>$user_id)); ?>																									
                                    <div class="container">
									  <div class="leftColumns custom_invitation_form">	
										<ul class="two-columns">
											<li>
												<?php echo $this->Form->label('Badge.title','Title'); 
													echo $this->Form->input('Badge.title',array('type'=>'text', 'class'=>'required','label'=>false,'div'=>false)); 
												?>											
											</li>											
											<li>
												<?php echo $this->Form->label('Badge.link','Link'); 
													echo $this->Form->input('Badge.link',array('type'=>'text', 'class'=>'required url','label'=>false,'div'=>false)); 
												?>											
											</li>											
										 </ul>									 
										 
										
										 
										 <ul class="two-columns">																						
											<li>
												<?php echo $this->Form->label('Badge.photo','Photo'); ?>												
													<div class="inputbrows">
                                                        <div class='fancy-file' style="overflow:inherit !important;">
                                                            <div class='fancy-file-name'>&nbsp;</div>
                                                            <button class='fancy-file-button'>Browse...</button>
                                                            <div class='input-container'>
                                                                <?php echo $this->Form->input('Badge.photo',array('type'=>'file','class'=>'required','label'=>false,'div'=>false,'onchange'=>'readURL(this)')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
											</li>
											<li>
												 <div class="inputtype">
													<img id="img_prev" src="#" alt=""/>
												</div>
											</li>
										 </ul>
										 </div>
								
								<div class="clear"></div>
								
								<div class="leftColumns mt15">	 
									<ul class="two-columns">
										
										<li> 
											<div class="blue pull-right">
												<button type="submit" id="#submitForm" onclick="return submit_athleteForm();">Save</button>
											</div>
										</li>
									</ul>
							  </div>
									  
									  
							</div> <!--left side box ends -->                                                               
						<?php echo $this->Form->end(); ?>			
						</div>
						<div class="clear"></div>								
								
							</div>
							
						</div><!--.left-column-->
												
								
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->

<script type="text/javascript">

function submit_athleteForm()
{
    $('#AddBadgeForm').validate({
            rules: {
					"data[Badge][photo]": {
						required: true,
						extension: "png|jpg|jpeg",
						messages:{ 
							
							extension: "Please select profile picture (Only jpeg, jpg, png files allowed)"}
					}
				},           
            submitHandler: function(form) { 
            	$('#AddBadgeForm').submit();               
            }   
     	}); 
    
}



function readURL(input) {
	
	if (input.files[0] && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#img_prev').attr('src', e.target.result).width(70).height(70);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

</script>
