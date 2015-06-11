<?php 
	echo $this->Html->css(array('jquery-ui.custom')); 
	echo $this->Html->script(array('jeditable','jquery-ui.custom'));
 ?>	

<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
			<div class="filter-search row">
				<?php if($this->Session->check('Auth.User')){ ?>
				 <div class="blue fRight">
                	<button type="submit" onclick="window.location.href='<?php echo $this->webroot.'events/manage_events'; ?>'">Back to Events</button>
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
				
				<div class="row">
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3>TFL Crossfit <?php echo $event['Event']['title']; ?></h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="list-tabing">									
						<div class="tab-content">							
							<div class="filter-search row">
								
								<div class="div_filter">
									
									<?php if(!empty($event['EventWod'])){
												$all_division = array(); $male_div = $fem_div = array();	  
												foreach($event['EventWod'] as $ew){
													if(!in_array($ew['division_type'], $all_division)){
														if($ew['division_sex'] == 'Male')
														{
															$male_div[] = $ew['division_type'];
														}else{
															$fem_div[] = $ew['division_type'];
														}	
															
										?>
											
									<?php  $all_division[] = $ew['division_type']; }}} ?>	
									
									<select id="division_select" onchange="get_division_scoring(this.value);">
											
											<?php if(!empty($male_div)){ ?>
											<optgroup label="Male">
												<?php foreach($male_div as $md){ ?>
												<option value="<?php echo str_replace(' ','_',$md); ?>"><?php echo $md; ?></div>
												<?php } ?>	
											</optgroup>		
											<?php } ?>	
											
											<?php if(!empty($fem_div)){ ?>
											<optgroup label="Female">
												<?php foreach($fem_div as $fd){ ?>
												<option value="<?php echo str_replace(' ','_',$fd); ?>"><?php echo $fd; ?></div>
												<?php } ?>	
											</optgroup>		
											<?php } ?>		
									</select>
									
									<input type="text" id="search_users" placeholder="Search"/>
								</div>	
								
								
								<div class="scoring_options">
								<?php if($event['Event']['scoring_status'] == 'Open'){ ?>
									<button class="red" onclick="toggle_scoring(0);">Close Scoring</button>
									<!--<button class="score_edit_btn blue" onclick="toggle_editable();">Edit</button>-->
					                <input type="hidden" id="editable_val" value="0"/>
				                <?php }else if($event['Event']['scoring_status'] == 'Not started'){ ?>
					                <button onclick="toggle_scoring(1);">Open Scoring</button>	
				                <?php } ?>	
								</div>				
							</div>
							<div class="clear"></div>
							
							
							
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" id="data_table" class="table-back" cellpadding="0">
									<thead>
										<tr>
											<th scope="col" width="150">Athlete</th>
											<th scope="col" width="100">Final Score</th>
											
											
										<?php if(!empty($event['EventWod'])){  $allwods = array();
												$wod_count = 1;
												foreach($event['EventWod'] as $wd){
													if(!in_array($wd['id'],$allwods)) {
														$allwods[] = $wd['id'];		
														
													
											?>
												<th scope="col" class="event_wod_<?php echo str_replace(' ','_',$wd['division_type']); ?> all_event_wod"><?php echo 'WOD - '.$wd['Wod']['title'].' ('.$wd['score_type'].')'; ?></th>
											<?php $wod_count++; }}} ?>										
										</tr>
									</thead>
									
									<tbody>
								<?php 
									if ( !empty($event['EventRegistration']) ){
									$i=1;		
									$allusers = array();
									foreach($event['EventRegistration'] as $ev) { 
										
										if(!empty($ev['User']))
										{
											$name = $ev['User']['first_name'].' '.$ev['User']['last_name'];																						
											 
										}else{
											$name = $ev['first_name'].' '.$ev['last_name'];													
											 
										 }		
										
										if(!in_array($name, $allusers))
										{
											$allusers[] = $name;
										}	
										
							?>
									<tr class="row_<?php echo str_replace(' ','_',$name); echo ' all_event_wod event_wod_'.str_replace(' ','_', $ev['EventWod']['division_type']); ?>">
										<td><?php  echo $name; ?></td>
										<td class="event_final_score_wod_<?php echo str_replace(' ','_',$ev['EventWod']['division_type']); ?> all_final_score_wod">
											<p id="register_<?php echo $ev['id']; ?>" class="final_score">
												<?php if(!empty($ev['final_score'])) echo $ev['final_score']; else echo '-'; ?>
											</p>
										</td>
										
										
									<?php 
										if(!empty($event['EventWod'])){  $allwods = array();
											$wod_count = 1;
											foreach($event['EventWod'] as $wd){
												if(!in_array($wd['id'],$allwods)) {
														$allwods[] = $wd['id'];		
												$score_exist = 0;		
										?>
										<td class="event_wod_<?php echo str_replace(' ','_',$wd['division_type']); ?> all_event_wod" title="<?php echo str_replace(' ','_',$wd['division_type']); ?>">
											<p id="<?php echo 'score_'.$ev['id'].'_'.$wd['id']; ?>" class="editable"><?php if(!empty($ev['EventScore'])){ 
													foreach($ev['EventScore'] as $scr){
														if($scr['event_id'] == $event['Event']['id'] 
																		&& $scr['registration_id'] == $ev['id'] 
																					&& $scr['event_wod_id'] == $wd['id']){
																							$score_exist = 1;
																						echo $scr['score']; 
																					}
													}
												}else{
													echo '-';
												}	

												if($score_exist == 0)
												{
													echo '-';
												}
													
												?></p>
																							
										</td>	
										<?php $wod_count++; }}} ?>	
									</tr>
									<?php $i++; }} ?>
									</tbody>
								</table>
							</div>
						</div>					
					</div>					
			</div>
		</div>
	</section>
	<!-- MId Section End -->

<script type="text/javascript">
	$(document).ready(function(){
	
	<?php if($event['Event']['scoring_status'] == 'Open'){ ?>
		instantiate_editable();  
	<?php } ?>
     
	 var availableTags = <?php echo json_encode($allusers); ?>;
				
				$( "#search_users" ).autocomplete({
					source: availableTags,
					focus: function( event, ui ) {
						var disp=ui.item.label.replace(/ /g,"_");
						disp=disp.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,"_");
						$( "#search_users" ).val( ui.item.label );
						var selectedDiv=$('.row_'+disp).clone();
						
						$('.row_'+disp).remove();
						$('#data_table').find('tbody > tr').eq(0).before(selectedDiv);
						
						instantiate_editable();
						
						 var edit_val = $('#editable_val').val();
						 if(edit_val == 0)
						 {
							$('.editable').editable('disable');
							
						    $('#editable_val').val(0);
						    $('.score_edit_btn').removeClass('blue').addClass('red');
						 }
						return false;
				}
		});
     
     
	   // $('.editable').editable('disable');
	   
	   // $('#editable_val').val(0);
	   // $('.score_edit_btn').removeClass('blue').addClass('red');
		$('#search_users').val('');
		
		<?php if(isset($division)){ ?>
		var n = 0;
		$('#division_select option').each(function(e){
			
			if($(this).val() == '<?php echo $division; ?>')
			{
				$('#division_select').find('option').eq(n).attr('selected','selected');				
			}
			n++;
		});
		
		var start = '<?php echo $division; ?>';
		<?php }else{ ?>
			var start = $('#division_select').find('option').eq(0).val();
			$('#division_select').find('option').eq(0).attr('selected','selected');
		<?php } ?>
		
		get_division_scoring(start);
		
	});
	
	function toggle_editable()
	{
		 var edit_val = $('#editable_val').val();
		 if(edit_val == 0)
		 {
		 	$('.editable').editable('enable');
		 	
		 	$('#editable_val').val(1);
		 	$('.score_edit_btn').removeClass('red').addClass('blue');
		 }else{
		 	$('.editable').editable('disable');
		 	
		 	$('#editable_val').val(0);
		 	$('.score_edit_btn').removeClass('blue').addClass('red');
		 }
	}
	
	function toggle_scoring(val)
	{
		$.post('<?php echo $this->webroot.'events/toggle_scoring/'.$event['Event']['id'].'/'; ?>'+val, function(data){
			if(val == '1')
			{
				$('.scoring_options').html(data);
				instantiate_editable(); 
				
			}else{
				$('.editable').editable('disable');
				$('.scoring_options').remove();
				alert('Scoring has been closed.');
			}
			
		});
	}
	
	function get_division_scoring(val)
	{
		if(val!='')
		{	console.log(val);
			$('.all_event_wod').hide();
			$('.event_wod_'+val).show();
			$('.all_final_score_wod').hide();
			$('.event_final_score_wod_'+val).show();
		}
	}
	
	function instantiate_editable()
	{
		var division = '';
		
		$('.editable').editable('<?php echo $this->webroot.'events/update_score/'.$event['Event']['id']; ?>', {
         indicator : 'Saving...',
         onblur : "submit",
         event : 'click',
         tooltip   : '',
         data    : function(string) {return $.trim(string)},
         onsubmit : function(settings,original) {
         			
         				var inp = $('input',this);
         				var input_val = inp.val();	
         				input_val = input_val.trim();
         				
         				division = $('input',this).closest('td').attr('title'); 
						
         				         				
          				if (original.revert == $('input',this).val() || input_val == '' ) {
					        original.reset();
					        return false;
					    }else{
					    	
					    	var input = $(original).find('input');					
							
							if ( input.val() == '-' )
							{
								alert('Please enter valid numeric value');
								 	return false;
							}else{
								if(isNumeric(input.val()))
								 {
								 	return true;								 	
								 }else{
								 	alert('Please enter valid numeric value');
								 	return false;
								 }	
							}																	
          				}
          	},
          	callback  : function(data, settings){
          		
          		//console.log(settings);
       			 update_final_score('<?php echo $event['Event']['id']; ?>', division);
        	}
     	});     	
     
	}
	
	function update_final_score(event_id, division)
	{
		$.post('<?php echo $this->webroot.'events/update_final_score/'; ?>'+event_id, function(data){
			if(data == 'success')
			{
				alert('scores has been updated');
				window.location = '<?php echo SITE_URL.'events/event_scores/'.$event['Event']['id']; ?>'+'/'+division;
			}else{
				alert('There is some issue. Please contact administrator');
			}
		});
	}
</script>