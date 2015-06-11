<?php
 echo $this->Html->script('jquery-ui.custom'); 
 echo $this->Html->css(array('jquery-ui.custom')); 
 ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

<style>
#map-canvas label.error{  display: block; margin-left: 225px; margin-top: 6px; position: absolute;}

.column-body.graybg.create-event input[type="text"], 
.column-body.graybg.create-event textarea, 
.column-body.graybg.create-event select, 
.column-body.graybg.create-event input[type="file"] {
	margin-bottom: 0;
}
</style> 


	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<?php echo $this->Form->create('Event',array('url'=>array('controller'=>'events','action'=>'update_event'),'type'=>'file','id'=>'CreateEventForm','class'=>'border-btm')); ?>
						
						<?php echo $this->Form->input('Event.id',array('type'=>'hidden')); ?>
						
						<div class="column">
							
							<div class="header">
								<h3>Edit EVENT </h3>
								<div class="blue save-btn">								
                                  <?php echo $this->Form->submit('Update',array('id'=>'update_event','class' => 'save_event')); ?>  
								</div>								  
								
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
							<div class="column-body graybg create-event" style="padding-bottom:0px;">							

								<div class="form-container no-lmr">							
									
									<?php echo $this->Form->input('counter_pricing',array('type'=>'hidden','value'=>count($event['Eventprice']) + 1)); ?>
                                    <div class="left-side-box">
										<ul class="two-columns">
											<li>
												<?php echo $this->Form->label('Event.title','Event Title'); 
													echo $this->Form->input('Event.title',array('type'=>'text','class'=>'required','label'=>false,'div'=>false)); 
												?>											
											</li>
											<li>
												<?php echo $this->Form->label('Event.picture','Event Picture'); ?>												
													<div class="inputbrows">
                                                        <div class='fancy-file' style="overflow:inherit !important;">
                                                            <div class='fancy-file-name'>&nbsp;</div>
                                                            <button class='fancy-file-button'>Browse...</button>
                                                            <div class='input-container'>
                                                                <?php echo $this->Form->input('Event.picture',array('type'=>'file','value'=>$event['Event']['picture'],'label'=>false,'div'=>false,'onchange'=>'readURL(this)')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="inputtype">
														<img id="img_prev" src="<?php echo $this->webroot.'files/events/'.$event['Event']['id'].'/thumb_'.$event['Event']['picture']; ?>" alt="" height="70" width="70" style="height:70px;" />
													
													</div>
											</li>
										</ul>
										<ul class="two-columns clear-after">
											<li class="full">
											<?php echo $this->Form->label('Event.details','Event Details'); 
													echo $this->Form->input('Event.details',array('type'=>'textarea','class'=>'text-area','div'=>false,'label'=>false));	
												?>												
											</li>
										</ul>
										
										<ul class="two-columns">
											<li class="full">
												<?php echo $this->Form->label('Event.notes','Notes'); 
													echo $this->Form->input('Event.notes',array('type'=>'textarea','class'=>'text-area','div'=>false,'label'=>false));	
												?>
											</li>
										</ul>
										
										<?php $p=1;
										  foreach($event['Eventprice'] as $price) { ?>
										<ul class="two-columns pricing price_box_<?php echo $p; ?> clear-after">
											<li>
												<?php echo $this->Form->label('Eventprice.'.$p.'.price','Pricing'); 
													echo $this->Form->input('Eventprice.'.$p.'.price',array('type'=>'text','class'=>'required number','value' => $price['price'],'div'=>false,'label'=>false));	
												?>												
											</li>
											<li class="with-calendar">
												<?php echo $this->Form->label('Eventprice.'.$p.'.date','Date'); 
													echo $this->Form->input('Eventprice.'.$p.'.date',array('type'=>'text','value' => $price['date'] ,'class'=>'required datepick','div'=>false, 'readonly' => 'readonly','label'=>false));	
												?>	
												
												<?php if ( $p > 1 ) { ?>
												<a href="javascript://" onclick="remove_pricing_div(<?php echo $p; ?>)"> &nbsp; </a>
												<?php } ?>
											</li>	
											
											
										</ul>
										<?php $p++; } ?>
										<ul class="two-columns no-tmr" style="padding-top:7px; padding-bottom:17px;">
											<li style="float: right; margin-right: -123px;">
												<a href="javascript://" onclick="add_pricing_div();">Add more pricing</a>
											</li>
										</ul>
										
										
                                        </div> <!--left side box ends -->
                                        
                                        <!--right side map box-->
                                        <input type="hidden" name="data[Event][latitude]" id="latitude"/>
                                        <input type="hidden" name="data[Event][longitude]" id="longitude"/>
                                        <input type="text" placeholder="Type Location" id="location" name="data[Event][location]"  class="location required" />
                                        <div class="right-side-box map" id="map-canvas">
                                        	
                                        </div>
                                        <div class="clear"></div>
                                        <!--right side map box ends-->
                                       
                                      
                                        <section class="section-form-section" style="border-top: 1px solid #A6A6A6; margin-top: 11px;">
                                        <div class="clearfix"></div>
                                        <div style="margin-top:25px;">
										<ul style="vertical-align:top;">
											<li>
												<?php echo $this->Form->label('Event.event_type','Event Type'); 
													echo $this->Form->input('Event.event_type',array('type'=>'select','options'=>array('competition'=>'Competition','throwdown'=>'Throwdown','challenge'=>'Challenge','fundraiser'=>'Fundraiser'),'class'=>'required','div'=>false, 'onchange' => 'check_event_type(this.value)', 'label'=>false));	
												?>												
											</li>
											<li>
												<?php echo $this->Form->label('Event.mode','Public/Private'); 
													echo $this->Form->input('Event.mode',array('type'=>'select','options'=>array('public'=>'Public','private'=>'Private'),'class'=>'required','div'=>false,'label'=>false));	
												?>												
											</li>
										</ul>
									
										<ul class="middle" id="duration_div" style="vertical-align:top; margin-top:0px; <?php if($event['Event']['event_type'] != 'challenge') echo 'display:none;'; ?>">
											<li>
												<?php 
													$days_options = array();
													for( $j=1; $j<31; $j++ )
													{
														$days_options[$j]=$j;
													}
													echo $this->Form->label('Event.duration','Duration'); 
													echo $this->Form->input('Event.duration_type',array('type'=>'select','options'=>array('days'=>'Days','weeks'=>'Weeks','months'=>'Months'),'class'=>'required','div'=>false,'label'=>false));	
													echo $this->Form->input('Event.duration',array('type'=>'select','options'=>$days_options,'div'=>false,'class'=>'required','label'=>false,'class'=>'too-small'));	
												?>											
											</li>
										</ul>
										<ul class="date-time" style="vertical-align:top; margin-top:0px;">
											<li>
												<?php echo $this->Form->label('Event.start_date','Date'); 
													  echo $this->Form->input('Event.start_date',array('type'=>'text','class'=>'required datepick', 'readonly' => 'readonly','label'=>false,'div'=>false)); 
												?>
											</li>
											<li>
												<?php echo $this->Form->label('Event.start_time','Time'); 
													  echo $this->Form->input('Event.start_time',array('type'=>'time','class'=>'required','label'=>false,'div'=>false)); 
												?>
											</li>
										</ul>
										</div>
                                        <input type="button" class="gray-btn mb20" onclick="invite_athlete_popup();" value="Invite atheletes/affiliates /teams etc " style="margin-top:30px; margin-bottom: 5px !important;"/>
                                        <div class="clear"></div>
                                         <div class="border-btm">
											 <label style="display:none;" id="invitee_label">Invitees: </label>
                                        <input type = "hidden" id = "number_invited_people" value = "0" />
                                        <div class="invited_people_div"></div>	 
                                        
                                        <ul class="display_people" style="margin-top:5px; width:100%; max-width:100%">							
										</ul>   
										</div>                                                               
                                     
                                        <div class="clear"></div>                                  
										
										</section>                            
                                    
								</div>
								<div class="clear"></div>
							</div>
							
						</div><!--.left-column-->

						<div class="column">
							<div class="column-body graybg create-event" style="padding-top:3px;">
								<div class="form-container no-lmr">
									<section class="section-form-section division_section" style="padding-bottom:15px;">
										
                                        <div class="clearfix"></div>
                                        <input type="hidden" id="division_count" value="<?php echo count($event['EventWod']); ?>"/>
										<ul>
											<li>
												<label>Divisions	</label>
                                                <select class="medium" id="division"> 
                                                    <option value='Male open'> Male open</option>
                                                    <option value='Female open'> Female open</option>
                                                    <option value='Male masters'> Male masters</option>
                                                    <option value='Female masters'> Female masters</option>
                                                </select>
											</li>
											<li>
												<label>  Sex	</label>
                                                <select class="medium" id='division_sex'> 
                                                    <option value='Male'> Male </option>
                                                    <option value='Female'> Female</option>
                                                    
                                                </select>
											</li>
										</ul>
										<ul class="middle">
											<li>
												<label> Number of Wods	</label>
                                                <select class="small" id='number_of_wods'> 
                                                    <?php for( $k=1; $k < 11; $k++){ ?>
														<option value='<?php echo $k; ?>'><?php echo $k; ?></option>
                                                    <?php } ?>
                                                </select>
											</li>
										</ul>
										<ul class="middle right-list">
                                        	<li>
                                            	
                                        <input type="button" class="gray-btn mt25" value="Add New Division" onclick="add_division();"/>
                                            </li>
                                        </ul>
									
									</section>
											
									<?php 
										$i=1; 
										if ( !empty($eventWod) ) {
											
											foreach($eventWod as $division_type => $wd){  ?>
											
						<section class="bottom-section new_division_<?php echo $i; ?>">		
						<div class="accdion">
							<div class="accordion open" onclick="toggle_wod(<?php echo $i; ?>);"><h3><?php echo ucwords($division_type); ?> / RX <?php echo ucwords($wd['division_sex']); ?>   /  <?php echo count($wd['details']); ?> </h3></div>
						</div>
						
						<div class="section-form-section wod_form_<?php echo $i; ?>" >
							
						</div>
					
						<div class="clear"> </div>				
												
										<?php		$j=1;
												
												foreach($wd['details'] as $wod_id => $data) {
									 ?>				 
						<div class="clearfix"></div>
							<ul>
							<li>
								<label>Weight Class </label>
								<select class="medium" name="data[Wod][<?php echo $i; ?>][weight_class]"> 
									<?php foreach($weights as $wt){  ?>
										<option value="<?php echo $wt['WeightClass']['id']; ?>"><?php echo $wt['WeightClass']['weight']; ?></option>
									<?php } ?>	
								</select>
							</li>
							<li>
								<label>  Age Group	</label>
								<select class="medium" name="data[Wod][<?php echo $i; ?>][age_group]"> 
									<?php foreach($age_groups as $age){  ?>
										<option value="<?php echo $age['AgeGroup']['id']; ?>"><?php echo $age['AgeGroup']['age_group']; ?></option>
									<?php } ?>	
								</select>
							</li>
							<li>
								<label>Wod Date</label>
								<input type="text" class="required datepick" name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][wod_date]">
							</li>
						</ul>
						
						<div class="left-section wod_details_<?php echo $i; ?>">
					
				
						<section class="wod-colum">
							<div class="header">
								<h3>WOD #<?php echo $j; ?></h3>
								<div class="select-box pull-right">
									<select class="small wods_select wod_select_<?php echo $j; ?>" onchange="get_wod_details(<?php echo $wod_id; ?>, <?php echo $i; ?>,<?php echo $j; ?> ,<?php echo $wod_id; ?>, '<?php echo $data['division_type']; ?>', '<?php echo $data['division_sex']; ?>');" > 
																				
										<?php foreach($allwods as $allwd){ ?>
											<option value="<?php echo $allwd['Wod']['id']; ?>" <?php if($wod_id == $allwd['Wod']['id']) echo 'selected'; ?>><?php echo $allwd['Wod']['title']; ?></option>
										<?php } ?>
										
									</select>
									<!--<div class="blue">
										<button onclick="return create_custom_wod(<?php echo $i.'_'.$j; ?>. ,<?php echo $data['data']['wod_id']; ?>, '<?php echo $data['division_type']; ?>', '<?php echo $data['division_sex']; ?>');">CUSTOM WOD</button>
									</div>-->
								</div>
								<div class="clear"></div>
							</div>
							<div class="inner-content <?php echo 'wod_'.$i.'_'.$j.'_'.$data['data']['wod_id']; ?>">
									<p class="underline"> <?php echo strip_tags($data['data']['Wod']['description']); ?> &nbsp; </p>
							
							<?php
								$m = 0;
								$count_movement = count($data['data']['WodMovement']);
								
								foreach($data['data']['WodMovement'] as $mov){ 									
									if(!empty($mov['Movement'])) { 
								?>		
							<ul class="inner-select">
								<li>
									<label>  Movement : <?php echo $mov['Movement']['title']; ?>	</label>
								</li>
								<li>
									<label>
										<?php echo $mov['type'];
												if(!empty($mov['sub_type']))
												{
													echo '(in '.$mov['sub_type'].')';	
												}	
										?>	
									 </label>
									 
									 <input type="hidden" name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][Movement][<?php echo $m; ?>][id]" value="<?php echo $data['data']['id']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][Movement][<?php echo $m; ?>][wod_id]" value="<?php echo $data['data']['Wod']['id']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][Movement][<?php echo $m; ?>][division_type]" value="<?php echo $data['division_type']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][Movement][<?php echo $m; ?>][division_sex]" value="<?php echo $data['division_sex']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][Movement][<?php echo $m; ?>][movement_id]" value="<?php echo $mov['Movement']['id']; ?>" />
									 <input type=text name="data[Wod][<?php echo $i; ?>][WodNum][<?php echo $j; ?>][Movement][<?php echo $m; ?>][value]" class="required number" value="<?php echo $data['data']['value']; ?>" />
									
								</li>
							</ul>
							
							<div class="clear"></div>
							
							<?php if($m != ($count_movement - 1)) { ?>
							 <span class="plus"> </span>
							<?php 
									} 
									$m++; }} 
							?>
							
															
							</div>
							
						</section> <!--first section ends-->						
					
						
								 </div> <!-- left section ends -->
								 <div class="clear"></div>
								
							
								<div class="blue mb25 fLeft wod_buttons_<?php echo $i;  ?>">
									<button onclick="return delete_existing_wod(<?php echo $i; ?>,'<?php echo $data['data']['id']; ?>');">DELETE </button>
								</div>
								 <div class="clear"></div>
								 <?php 
								  	$j++; } ?>
								
												
							</section>	
												 
						 <?php $i++; }}  ?>
								 
								</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<?php echo $this->Form->end(); ?>					
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->

<?php 
	echo $this->element('custom_wod_popup'); 
	echo $this->element('invite_athlete_popup'); 
?>
	
<script type="text/javascript">

$(document).ready(function(){
		
	google.maps.event.addDomListener(window, 'load', initialize('location', 'map-canvas'));
	$('#EventCounterPricing').val(<?php echo count($event['Eventprice']); ?>);
	$('.datepick').datepicker({ minDate: 0, dateFormat:"yy-mm-dd" });
	$('#division_count').val(<?php echo count($event['EventWod']); ?>);
	$('#number_of_wods').val(1);
	$('#location').val('<?php echo $event['Event']['location']; ?>');
	//add_division();	
});

function toggle_wod(num)
{
	$('.wod_form_'+num).toggle('fast');
	$('.wod_details_'+num).toggle('fast');
	$('.wod_buttons_'+num).toggle('fast');
	return false;	
}

function check_event_type(value)
{
	if(value == "challenge") 
	{
		$('#duration_div').show();
	}else{
		$('#duration_div').hide();
	}	
}

function add_pricing_div()
{
	var num = $('#EventCounterPricing').val();
	num = parseInt(num) + 1;
	$('ul.pricing:last').after('<ul class="two-columns pricing price_box_'+num+' clear-after"><li><label for="Eventprice'+num+'Price">Pricing</label><input type="text" id="Eventprice'+num+'Price" class="required number" name="data[Eventprice]['+num+'][price]"></li><li class="with-calendar"><label for="Eventprice'+num+'Date">Date</label><input type="text" id="Eventprice'+num+'Date" class="required datepick" name="data[Eventprice]['+num+'][date]" readonly="readonly"> <a href="javascript://" onclick="remove_pricing_div('+num+')"> &nbsp; </a></li></ul>');
	$('#EventCounterPricing').val(num);
	$('.datepick').datepicker({ minDate: 0, dateFormat:"yy-mm-dd" });
}

function remove_pricing_div(num)
{
	$('.price_box_'+num).remove();	
}

function add_division()
{
	var event_id = $('#event_id').val();
	var division = $('#division').val();
	var division_sex = $('#division_sex').val();
	var num_wods = $('#number_of_wods').val();
	var div_count = $('#division_count').val();
	
	$.post('<?php echo $this->webroot; ?>events/add_division',{ division:division, division_sex: division_sex, num_wods: num_wods, div_count: div_count}, function(data) {
		$('.division_section').after(data);
		$('#division_count').val(parseInt(div_count)+1);
		scrollToAnchor('.new_division_' + (parseInt(div_count)+1));
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

function invite_athlete_popup()
{
	var top = $('#map-canvas').offset().top;
	$('.loginBox').css('margin-top',top + 'px');
	$('.invite_athlete_box').fadeIn();
	get_people();
	//scrollToAnchor('.invite_athlete_box');
}

function get_people()
{
	$.post('<?php echo $this->webroot; ?>events/get_people',function(data){
		$('.people_div').html(data);
		$('.loading_div').hide();	
	});	
}

function delete_existing_wod(num,ids)
{
	
	$.post('<?php echo $this->webroot; ?>events/delete_event_wod',{id:id},function(data){		
		$('.new_division_' + num).remove();	
	});		
	return false;
}


</script>	
