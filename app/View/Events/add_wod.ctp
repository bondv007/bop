<style>
.auto_complete { float: left;margin: 10px 5px !important; text-overflow: ellipsis !important; width: 119px !important;}
 .select-box label.error {margin-left: -130px;    margin-top: 51px;    position: absolute;    text-transform: none;   text-shadow: none !important;}  

.blue button{ padding:10px 6px; }  
.select-box select.score_type_select{ width: 32%; } 
.score_type_select + label.error{ margin-left: -254px;}
</style>

<?php $div = ($data['div_count'] + 1); ?>
		<section class="bottom-section new_division_<?php echo $div; ?>">
						<div class="accdion">
							<div class="accordion open" onclick="toggle_wod(<?php echo $div; ?>);"><h3><?php echo ucwords($data['division']); ?> </h3></div>
						</div>
						
						<div class="section-form-section wod_form_<?php echo $div; ?>" >
						
					</div>
					
					<div class="clear"> </div>
					<div class="left-section wod-division-c1 wod_details_<?php echo $div; ?>">
					
					<?php for( $i = 1; $i <= ($data['num_wods']); $i++ )
						  {
					 ?>
					 
					 <div class="clearfix"></div>
						<ul class="wod-division-c1-list">
							<li>
								<label>Weight Class </label>
								<select class="small" class="required" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][weight_class_id]"> 
									  <option value="0">Select</option>
									<?php foreach($weights as $wt){  ?>
										<option value="<?php echo $wt['WeightClass']['id']; ?>"><?php echo $wt['WeightClass']['weight']; ?></option>
									<?php } ?>	
								</select>
							</li>
							<li>
								<label>  Age Group	</label>
								<select class="small" class="required" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][age_group_id]"> 
									<option value="0">Select</option>
									<?php foreach($age_groups as $age){  ?>
										<option value="<?php echo $age['AgeGroup']['id']; ?>"><?php echo $age['AgeGroup']['age_group']; ?></option>
									<?php } ?>	
								</select>
							</li>
							
							
							
						</ul>
						
						<ul class="wod-division-c1-list">
							
							<li>
								<label>Wod Date</label>
								<input type="text" class="required datepick small" placeholder="Wod Date" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][wod_date]">
							</li>
							
							<li>
							<label>  Score Type	</label>
							<select class="score_type_select required small" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][score_type]" onchange="score_type_check(this.value);">
								
								<option value="Time">Time</option>
								<option value="Reps">Reps</option>
								<option value="Rounds">Rounds</option>
								<option value="Load (lbs)">Load (lbs)</option>
								<option value="Distance">Distance</option>
							</select>
							</li>
							
							<li>
								<select class="score_sub_type_select small" style="display: none; width:70%" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][score_sub_type]">
									<option value="Least">Least</option>
									<option value="Greatest">Greatest</option>
								</select>	
								<img class="score_sub_type_select" style=" display: none; vertical-align: middle; float: right; margin-top:11px;" src="<?php echo $this->webroot.'images/info.png'; ?>" alt="" title="Least: Select this category for those WODs that are scored using the athlete performance of the least duration to complete the WOD. For instance, 1st place at 2:30 and 2nd place at 3:00.
									
Greatest: Select this category for those WODs that are scored using the athlete performance of the greatest duration to complete the WOD. For instance, 1st place at 3:00 and 2nd place at 2:30.">
				
							
							</li>
						</ul>	
					 
						<section class="wod-colum">
							<div class="header">
								<h3>WOD #<?php echo $i; ?></h3>
								<div class="select-box pull-right">
									
									<input type="hidden" id="<?php echo $div.'_'.$i.'_'.$wods[0]['Wod']['id']; ?>" />
									<input type="text" class="auto_complete small wod_select required wod_select_<?php echo $div.'_'.$i; ?>" />
									<!--<select class="small wods_select wod_select_<?php echo $div.'_'.$i; ?>" onchange="get_wod_details(this.value, <?php echo $div; ?>,<?php echo $i; ?> ,<?php echo $wods[0]['Wod']['id']; ?>, '<?php echo $data['division']; ?>', '<?php echo $data['division_sex']; ?>');" > 
																				
										<?php foreach($wods as $wd){ ?>
											<option value="<?php echo $wd['Wod']['id']; ?>"> <?php echo $wd['Wod']['title']; ?></option>
										<?php } ?>
										
									</select>-->
									<div class="blue">
										<button onclick="return create_custom_wod(<?php echo $div; ?>, <?php echo $i; ?> ,<?php echo $wods[0]['Wod']['id']; ?>, '<?php echo $data['division']; ?>', '<?php echo $data['division_sex']; ?>');">CUSTOM WOD</button>
									</div>
								</div>
							<div class="clear"></div>
							</div>
							<div class="inner-content <?php echo 'wod_'.$div.'_'.$i.'_'.$wods[0]['Wod']['id']; ?>">
									<p class="underline"> <?php echo strip_tags($wods[0]['Wod']['description']); ?> &nbsp; </p>
							
							
								
							<?php
								$m = 0;
								$count_movement = count($wods[0]['WodMovement']);
								
								foreach($wods[0]['WodMovement'] as $mov){ 									
									if(!empty($mov['Movement'])) { 
								?>		
							<ul class="inner-select">
								<li>
									<label>  Movement : <?php echo $mov['Movement']['title']; ?>	</label>
								</li>
								<li>
									<label style="float:left;">
										
										<?php echo $mov['type'];
												if(!empty($mov['sub_type']))
												{
													echo '(in '.$mov['sub_type'].')';	
												}	
										?>	
										
									 </label>
									 <?php if ($mov['type'] == 'time'){ ?>
									 <img style="float:right; margin-top:2px;" src="<?php echo $this->webroot.'images/info.png'; ?>" alt="" title="Least: Select this category for those WODs that are scored using the athlete performance of the least duration to complete the WOD. For instance, 1st place at 2:30 and 2nd place at 3:00.
									
Greatest: Select this category for those WODs that are scored using the athlete performance of the greatest duration to complete the WOD. For instance, 1st place at 3:00 and 2nd place at 2:30.">
								
								<?php } ?>	
									 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][Movement][<?php echo $m; ?>][wod_id]" value="<?php echo $wods[0]['Wod']['id']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][Movement][<?php echo $m; ?>][division_type]" value="<?php echo $data['division']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][Movement][<?php echo $m; ?>][division_sex]" value="<?php echo $data['division_sex']; ?>" />
									 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][Movement][<?php echo $m; ?>][movement_id]" value="<?php echo $mov['Movement']['id']; ?>" />
									 <input type=text name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $i; ?>][Movement][<?php echo $m; ?>][value]" class="required number wod_values" />
									
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
						
						<?php } ?>
					 </div> <!-- left section ends -->					 
				
					<div class="clear"></div>
					<!--<div class="blue mr10 mb25 fLeft">
						<button type="submit">EDIT </button>
					</div>-->
					<div class="blue mr10 mb25 fLeft wod_buttons_<?php echo $div;  ?>">
						<button onclick="return toggle_wod(<?php echo $div; ?>);">SAVE </button>
					</div>
					<div class="blue mb25 fLeft wod_buttons_<?php echo $div;  ?>">
						<button onclick="return remove_wod(<?php echo $div; ?>);">DELETE </button>
					</div>
	</section>
                                    
                                      
	<!--<div class="accdion">
			<div class="accordion close"><h3>Open - RX Females</h3></div>
		</div>-->
		
<script type="text/javascript">

$(document).ready(function(){
	$('.datepick').datepicker({ 
				minDate: 0, 
				dateFormat:"yy-mm-dd",
			    onClose: function (dateText, inst) {			
			        $(this).trigger('blur');			
			    }	
			});
			
	var availableTags = <?php echo $allwods; ?>;
		
	$( ".auto_complete" ).autocomplete({
			source: availableTags,
			select: function( event, ui ) {
					$( this ).val( ui.item.label );
					var row = $(this).prev().attr('id');
					row = row.split("_");
					$('#this_wod_id_'+row[0]+'_'+row[1]).val(ui.item.val);
					
					get_wod_details(ui.item.value,row[0], row[1], row[2], '<?php echo $data['division']; ?>', '<?php echo $data['division_sex']; ?>');
				return false;
			}
	});	
});

function get_wod_details(wod_id, div, ctr, num, division, division_sex)
{	
	$.post('<?php echo $this->webroot; ?>events/get_wod_details', { wod_id: wod_id, div:div, ctr: ctr, division: division, division_sex: division_sex}, function(data) {
		
		$('.wod_'+div+'_'+ctr+'_'+num).html(data);
	});
}

function toggle_wod(num)
{
	$('.wod_form_'+num).toggle('slow');
	$('.wod_details_'+num).toggle('slow');
	$('.wod_buttons_'+num).toggle('slow');
	return false;	
}

function remove_wod(num)
{
	$('.new_division_' + num).remove();	
	return false;	
}

function create_custom_wod(div, ctr, num, division, division_sex)
{
	
	var top = $('.new_division_' + div).offset().top - 250;
	$('#WodDiv').val(div);
	$('#WodCtr').val(ctr);
	$('#WodNum').val(num);
	
	$('#WodDivision').val(division);
	$('#WodDivisionSex').val(division_sex);
	$('.loginBox').css('margin-top',top + 'px');
	$('.custom_wod_popup').show();	
	return false;
}

function score_type_check(val)
{
	if(val == 'Time')
	{
		$('.score_sub_type_select').show();
	}else{
		$('.score_sub_type_select').hide();
	}
}
</script>		
