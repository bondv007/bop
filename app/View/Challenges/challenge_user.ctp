<?php
	echo $this->Html->script('jquery-ui.custom'); 
	echo $this->Html->css(array('jquery-ui.custom')); 
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<style>
.auto_complete { float: left;
    margin: 10px 5px !important;
       text-overflow: ellipsis !important;
    width: 119px !important;}
.auto_complete_people{ float:none; }
.auto-complete-box label.error{   left: 205px;
    position: absolute;
    text-shadow: none !important;
    text-transform: none;
    top: 40px;}    
#successMessage{ margin-bottom: 0 !important;}    
</style>

	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<?php echo $this->Form->create('Challenge',array('type'=>'file','id'=>'ChallengeForm','class'=>'border-btm')); 
								echo $this->Form->input('from_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
								//echo $this->Form->input('to_id', array('type' => 'hidden', 'value' => $athlete['User']['id']));
						?>
						<div class="column">
							<div class="header">
								<h3>CHALLENGE PEOPLE</h3>
								<div class="blue save-btn">
									<?php echo $this->Form->submit('Send Challenge Request',array('id'=>'send_challenge','class' => 'save_event')); ?>  
								</div>
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
														
						</div><!--.left-column-->

						<div class="column">
							<div class="column-body graybg create-event" style="padding-top:3px;">
								<div class="form-container no-lmr">
									<section class="section-form-section division_section" style="padding-bottom:15px;">	                                  
                                                                      
									
									</section>
									<section class="bottom-section new_division_1">													
													
													<div class="section-form-section wod_form_1">
													<div class="clearfix"></div>
													<ul class="chalange-people-list">
														<li>
															<label>Date: </label>															
															<div class="clear"></div>
															<?php echo $this->Form->input('Challenge.date', array('type' => 'text','readonly' => 'readonly', 'class' => 'required datepick', 'div' => false, 'label' => false)); ?>
															<br/><br/>
															
															<label>Time: </label>															
															<div class="clear"></div>

															<?php echo $this->Form->input('Challenge.time', array('type' => 'time', 'div' => false, 'label' => false, 'separator' => '-')); ?>
														</li>
														<li>
														</li>
														
														<li class="verify">
															<label>Verification</label>
															<div class="clear"></div>
															<label><input id="verify_yes" type="radio" name="data[Challenge][require_verification]" value="Yes"/>Yes</label>
															
															<label><input id="verify_no" type="radio" checked="checked" name="data[Challenge][require_verification]" value="No" />No</label>
														<br/> 
															<div class="video_url_box" style="display: none;">
													<label>Youtube Video URL</label>
													<?php echo $this->Form->input('video_link', array('type' => 'text', 'div' => false, 'label' => false)); ?>
												</div>
														</li>	
													</ul>													
												</div>
												
												<div class="clear"> </div>
												
												<div class="clear"> </div>
												<div class="left-section wod_details_1">												
												
													<section class="wod-colum">
														<div class="header">
															<h3>WOD</h3>
															<div class="select-box pull-right auto-complete-box">
																
																<input type="hidden" id="<?php echo '1_1_'.$wods[0]['Wod']['id']; ?>" />
																<input type="text" class="auto_complete auto_complete_wod small wod_select required wod_select_1_1"  />
																<!--<select class="small wods_select wod_select_1_1" onchange="get_wod_details(this.value, 1,1 ,<?php echo $wods[0]['Wod']['id']; ?>);" > 
																											
																	<?php foreach($wods as $wd){ ?>
																		<option value="<?php echo $wd['Wod']['id']; ?>"> <?php echo $wd['Wod']['title']; ?></option>
																	<?php } ?>
																	
																</select>-->
																<div class="blue">
																	<button onclick="return create_custom_wod(1,1 ,<?php echo $wods[0]['Wod']['id']; ?>);">CUSTOM WOD</button>
																</div>
															</div>
														<div class="clear"></div>
														</div>
														<div class="inner-content <?php echo 'wod_1_1_'.$wods[0]['Wod']['id']; ?>">
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
																<label>
																	<?php echo $mov['type'];
																			if(!empty($mov['sub_type']))
																			{
																				echo '(in '.$mov['sub_type'].')';	
																			}	
																	?>	
																 </label>
																 
																 <input type="hidden" name="data[Wod][1][WodNum][1][Movement][<?php echo $m; ?>][wod_id]" value="<?php echo $wods[0]['Wod']['id']; ?>" />
																 <input type="hidden" name="data[Wod][1][WodNum][1][Movement][<?php echo $m; ?>][movement_id]" value="<?php echo $mov['Movement']['id']; ?>" />
																 <input type=text name="data[Wod][1][WodNum][1][Movement][<?php echo $m; ?>][value]" class="required number wod_values" />
																
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
												 
												 <div class="right-section">
												 	<section class="wod-colum">
														<div class="header">
															<h3>Add People</h3>
															<div class="select-box pull-right auto-complete-box">
																<input type="hidden" id="num_of_selected" value="<?php if(isset($athlete)) echo 1; else echo 0; ?>" />
																<input type="hidden" id="selected_people" value="" />																
																<input type="text" class="auto_complete auto_complete_people small wod_select required"  />
																
																<div class="blue">
																	<button onclick="return add_people();">Add</button>
																</div>
															</div>
														<div class="clear"></div>
														</div>
														<div class="inner-content people_div">
															
															
														<ul class="inner-select add-people">
															<?php if(isset($athlete)){ ?>
															<li>
																<label>
																	<input type="hidden" name="people[]" value="<?php echo $athlete['User']['id']; ?>"/>
																	<?php if(!empty($athlete['User']['photo'])){  ?>
																		<img src="<?php echo $this->webroot.'files/'.$athlete['User']['id'].'/'.$athlete['User']['photo']; ?>" alt="" height="50" width="50"/>
																	<?php }else{ ?>	
																	<img src="<?php echo $this->webroot.'files/image_not_available.jpg'; ?>" alt="" height="50" width="50"/>
																	<?php  } ?>
																	<span><?php echo $athlete['User']['first_name'].' '.$athlete['User']['last_name'].' - '.$athlete['User']['email']; ?></span>
																	<a href="javascript://" class="cancel-cross pull-right">&nbsp;</a>
																</label>
															</li>
															<?php } ?>
														</ul>
														
														<div class="clear"></div>
													
																																				
														</div>														
													</section> <!--first section ends-->
												 </div>										
									<div class="clear"></div>												
								</section>
								
									<section class="bottom-section">
										<div class="header">
											<h3>Challenge Location</h3>
										</div>	
										 <input type="hidden" class="MapLat" name="data[Challenge][latitude]" id="latitude"/>
                                        <input type="hidden" class="MapLon" name="data[Challenge][longitude]" id="longitude"/>
                                        <input type="text" placeholder="Type location here" id="location" name="data[Challenge][location]"  class="location required" style=" margin-bottom: 8px; width: 100%;" />
                                        <div class="map" id="map_canvas"></div>
									</section>	
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

<?php echo $this->element('custom_wod_popup'); ?>
	
<script type="text/javascript">

$(document).ready(function(){
	<?php if(!isset($athlete)) { ?>
	$('#num_of_selected').val('0');
	<?php }else{ ?>
		$('#num_of_selected').val('1');
	<?php } ?>	
	
	$('.datepick').datepicker({ 
				minDate: +1, 
				dateFormat:"yy-mm-dd",
			    onClose: function (dateText, inst) {			
			        $(this).trigger('blur');			
			    }	
			});
			
	//$('#ChallengeForm').validate();		
			
	var availableTags = <?php echo $allwods; ?>;
		
	$( ".auto_complete_wod" ).autocomplete({
			source: availableTags,
			select: function( event, ui ) {
					$( this ).val( ui.item.label );
					var row = $(this).prev().attr('id');
					row = row.split("_");
					$('#this_wod_id_'+row[0]+'_'+row[1]).val(ui.item.val);
					
					get_wod_details(ui.item.value,row[0], row[1], row[2]);
				return false;
			}
	});	
	
	
	$( ".auto_complete_people" ).autocomplete({
			source: '<?php echo $this->webroot.'challenges/get_athletes'; ?>',
			minLength: 2,
			select: function( event, ui ) {
					$( this ).val( ui.item.label );
					$('#selected_people').val(ui.item.value);					
				return false;
			}
	});	
	
});

function get_wod_details(wod_id, div, ctr, num)
{	
	$.post('<?php echo $this->webroot; ?>challenges/get_wod_details', { wod_id: wod_id, div:div, ctr: ctr}, function(data) {
		
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

function create_custom_wod(div, ctr, num)
{	
	var top = $('.new_division_' + div).offset().top - 250;
	$('#WodDiv').val(div);
	$('#WodCtr').val(ctr);
	$('#WodNum').val(num);	
	
	$('.loginBox').css('margin-top',top + 'px');
	$('.custom_wod_popup').show();	
	return false;
}

function add_people()
{	var id = $('#selected_people').val();
	if(id != "")
	{
		$.post('<?php echo $this->webroot.'challenges/get_user_data'; ?>',{ id: id}, function(data){
			if(data!=0)
			{
				var response = data.split('|');
				$('.people_div').append('<ul class="inner-select add-people" id="ul_'+id+'"><li><label><input type="hidden" name="people[]" value="'+response[0]+'"/><img src="'+response[1]+'" alt="" height="50" width="50"/><span>'+response[2]+' - '+response[3]+'</span><a href="javascript://" class="cancel-cross pull-right" onclick="remove_user('+id+')"><img src="<?php echo $this->webroot.'images/cross.png'; ?>" alt="X" style="width:11px;"></a></label></li></ul>');
			
			}
			$('.auto_complete_people').val('');
			$('#selected_people').val('');
			var num = $('#num_of_selected').val();
			num=parseInt(num)+1;
			$('#num_of_selected').val(num);
			
		});
	}else{
		alert('Please select people to add');
	}
	return false;
}

function check_verification()
{	
	if($('#verify_yes').prop('checked'))
	{
		$('.video_url_box').show();
		$('#ChallengeVideoLink').addClass('required url');
	}else{
		$('.video_url_box').hide();
		$('#ChallengeVideoLink').removeClass('required url');
	}
}

function remove_user(num)
{
	$('#ul_'+num).remove();
	var num = $('#num_of_selected').val();
	num=parseInt(num)-1;
	$('#num_of_selected').val(num);
}


$(function () {
    var lat = <?php echo !empty($this->data['Challenge']['latitude'])?$this->data['Challenge']['latitude']:'44.88623409320778'; //44.88623409320778 ?>,
        lng = <?php echo !empty($this->data['Challenge']['longitude'])?$this->data['Challenge']['longitude']:'-87.86480712897173'; //-87.86480712897173 ?>,
        latlng = new google.maps.LatLng(lat, lng),
        image = 'https://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';

    //zoomControl: true,
    //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,

    var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        panControl: true,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_left
        }
    },
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: image
        });

    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["geocode"]
    });

    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();

    google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
        infowindow.close();
        var place = autocomplete.getPlace();
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        moveMarker(place.name, place.geometry.location);
        $('.MapLat').val(place.geometry.location.lat());
        $('.MapLon').val(place.geometry.location.lng());
    });
    google.maps.event.addListener(map, 'click', function (event) {
        $('.MapLat').val(event.latLng.lat());
        $('.MapLon').val(event.latLng.lng());
        infowindow.close();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "latLng":event.latLng
                }, function (results, status) {
                    console.log(results, status);
                    if (status == google.maps.GeocoderStatus.OK) {
                        console.log(results);
                        var lat = results[0].geometry.location.lat(),
                            lng = results[0].geometry.location.lng(),
                            placeName = results[0].address_components[0].long_name,
                            latlng = new google.maps.LatLng(lat, lng);

                        moveMarker(placeName, latlng);
                        $("#location").val(results[0].formatted_address);
                    }
                });
    });
   
    function moveMarker(placeName, latlng) {
        marker.setIcon(image);
        marker.setPosition(latlng);
        infowindow.setContent(placeName);
    }

    function initialize() { 
      var myOptions = {
          zoom: 14,
          center: new google.maps.LatLng(0.0, 0.0),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
          map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
    }
});
</script>			
