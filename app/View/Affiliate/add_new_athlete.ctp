<style>

.column-body.graybg.create-event input[type="text"], .column-body.graybg.create-event textarea, .column-body.graybg.create-event select, .column-body.graybg.create-event input[type="file"] { margin-bottom:0;}	
.form-container .two-columns li { height: 65px; }		
</style>


<?php
	echo $this->Html->script(array('jquery-ui.custom')); 
	echo $this->Html->css(array('jquery-ui.custom')); 
 ?>
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
				
				<div class="register-columns">
						
						<div class="column">
							
							<div class="header">
								<h3>ADD NEW ATHLETE</h3>										  
								<div class="blue save-btn">								
                                  <button onclick="window.location='<?php echo $this->webroot.'affiliate/manage_athletes'; ?>'">Back to Manage Athletes</button>
								</div>
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
							
						
							<div class="column-body graybg create-event">							
								
								
								
								<div class="form-container no-lmr">								
									
									
									
									<?php echo $this->Form->create('CustomAthlete',array('type'=>'file',
																						'id'=>'InviteCustomAthleteForm',
																						'url'=>array('controller' => 'affiliate',
																										'action' => 'add_new_athlete'))); ?>	
																										
									<?php echo $this->Form->input('Athlete.affiliate_id',array('type'=>'hidden','value'=>$affiliate_id)); ?>																									
                                    <div class="container">
									  <div class="leftColumns custom_invitation_form">	
										<ul class="two-columns">
											<li>
												<?php echo $this->Form->label('Athlete.first_name','First Name'); 
													echo $this->Form->input('Athlete.first_name',array('type'=>'text', 'class'=>'required','label'=>false,'div'=>false)); 
												?>											
											</li>											
											<li>
												<?php echo $this->Form->label('Athlete.last_name','Last Name'); 
													echo $this->Form->input('Athlete.last_name',array('type'=>'text', 'class'=>'required','label'=>false,'div'=>false)); 
												?>											
											</li>											
										 </ul>									 
										 
										 <ul class="two-columns">
											<li>
												<?php echo $this->Form->label('Athlete.email','Email'); 
													echo $this->Form->input('Athlete.email',array('type'=>'text', 'class'=>'required email','label'=>false,'div'=>false)); 
												?>											
											</li>	
											<li>
												<?php echo $this->Form->label('Athlete.profile_link','Profile Link'); 
													echo $this->Form->input('Athlete.profile_link',array('type'=>'text', 'class'=>'required url','label'=>false,'div'=>false)); 
												?>	
											</li>																			
										 </ul>
										 
										 <ul class="two-columns">																						
											<li>
												<?php echo $this->Form->label('Athlete.photo','Photo'); ?>												
													<div class="inputbrows">
                                                        <div class='fancy-file' style="overflow:inherit !important;">
                                                            <div class='fancy-file-name'>&nbsp;</div>
                                                            <button class='fancy-file-button'>Browse...</button>
                                                            <div class='input-container'>
                                                                <?php echo $this->Form->input('Athlete.photo',array('type'=>'file','class'=>'required','label'=>false,'div'=>false,'onchange'=>'readURL(this)')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
											</li>
											<li>
												 <div class="inputtype">
													<img class="" id="img_prev" src="#" alt=""/>
												</div>
											</li>
										 </ul>
										 </div>
								
								<div class="clear"></div>
								
								<div class="leftColumns mt15">	 
									<ul class="two-columns">
									
										<li> 
											<div class="blue pull-right">
												<button type="submit" id="#submitForm" onclick="return submit_athleteForm();">Send Invitation</button>
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
	</section>
	<!-- MId Section End -->

<script type="text/javascript">

$(document).ready(function(e){
	$("#athlete_options").autocomplete({
		 source: function( request, response ) {

        $.ajax({
            dataType: "json",
            type : 'Get',
            url: '<?php echo $this->webroot.'affiliate/get_users_for_athletes'; ?>',
            data:
            {
                term: request.term,
            },
            success: function(data) {
            
				response( $.map( data, function(item) {
					 return {
						label: item.label,
						value: item.value,
						photo: item.photo
					}
				}));
           }		
					  
        });
      },
      select: function( event, ui ) {
				
				$('#selected_athlete').val(ui.item.value);
				$('#athlete_options').val(ui.item.label);
				return false;
			},
		 focus: function( event, ui ) {
				
				$('#selected_athlete').val(ui.item.value);
				$('#athlete_options').val(ui.item.label);
				return false;
			},	
		minLength: 1
	});
	
	
	
		
});

function submit_athleteForm()
{
    $('#InviteCustomAthleteForm').validate({
    	 rules: {
					"data[Athlete][photo]": {
						required: true,
						extension: "png|jpg|jpeg",
						messages:{ 
							
							extension: "Please select profile picture (Only jpeg, jpg, png files allowed)"}
					}
				},   
            submitHandler: function(form) { 
            	$('#InviteCustomAthleteForm').submit();               
            }   
     	}); 
    
}

function invite_user()
{
	var user_id = $('#selected_athlete').val();
	var user = $('#athlete_options').val();
	var affiliate_id = $('#AthleteAffiliateId').val();	
	
	if( user=="" )
	{
		alert('Please select athlete from GameOn');
			
	} else {
		$('.invitation_form').html('<div style="height:150px; text-align:center; "><img src="<?php echo $this->webroot.'images/loading.gif'; ?>" /></div>');
		
		$.post('<?php echo $this->webroot; ?>affiliate/invite_athlete',{ id: user_id, affiliate_id: affiliate_id}, function(data){
				
			data = data.split('|');			
			$('.invitation_form').html(data[1]);	
			//$('.invitation_form').html('<div style="height:150px; text-align:center; "></div>');	
		});
	}	
	return false;
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
