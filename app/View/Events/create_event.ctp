<?php
	echo $this->Html->script('jquery-ui.custom'); 
	echo $this->Html->css(array('jquery-ui.custom')); 
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<style>
#map_canvas label.error{  display: block; margin-left: 225px; margin-top: 6px; position: absolute;}

.column-body.graybg.create-event input[type="text"], 
.column-body.graybg.create-event textarea, 
.column-body.graybg.create-event select, 
.column-body.graybg.create-event input[type="file"] {
	margin-bottom: 0;
}
.wod-division-c1-list label.error{ margin-left: -130px; margin-top: 37px; position: absolute;}

</style> 


	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<?php echo $this->Form->create('Event',array('type'=>'file','id'=>'CreateEventForm','class'=>'border-btm')); ?>
						<?php echo $this->Form->input('latitude',array('type' => 'hidden', 'class' => "MapLat"));?>
						<?php echo $this->Form->input('longitude',array('type' => 'hidden', 'class' => "MapLon"));?>
						<?php echo $this->Form->input('country',array('type' => 'hidden', 'id' => 'country'));?>
						<div class="column">
							<div class="header">
								<h3>CREATE EVENT</h3>
								<div class="blue save-btn">
									<?php echo $this->Form->submit('Save',array('id'=>'save_event')); ?>  
								</div>
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
							<div class="column-body graybg create-event" style="padding-bottom:0px;">							
								<div class="form-container no-lmr">							
									<?php echo $this->Form->input('counter_pricing',array('type'=>'hidden','value'=>1)); ?>
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
                                                                <?php echo $this->Form->input('Event.picture',array('type'=>'file','class'=>'required','label'=>false,'div'=>false,'onchange'=>'readURL(this)')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="inputtype">
														<img id="img_prev" src="#" alt="" />
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
										<ul class="two-columns pricing price_box_1 clear-after">
											<li>
												<?php echo $this->Form->label('Eventprice.1.price','Pricing (in USD)'); 
													echo $this->Form->input('Eventprice.1.price',array('type'=>'text','class'=>'required number','div'=>false,'label'=>false));	
												?>												
											</li>
											<li class="with-calendar">
												<?php echo $this->Form->label('Eventprice.1.date','Date'); 
													echo $this->Form->input('Eventprice.1.date',array('type'=>'text','class'=>'required datepick','div'=>false, 'readonly' => 'readonly','label'=>false));	
												?>	
											</li>			
											
										</ul>
										<ul class="two-columns no-tmr" style="padding-top:7px; padding-bottom:17px;">
										<li style="  float: right; margin-right: -123px;">
											<a href="javascript://" onclick="add_pricing_div();">Add more pricing</a>
											</li>
										</ul>
										
										
                                        </div> <!--left side box ends -->
                                        
                                        <!--right side map box-->
                                        <input type="hidden" name="data[Event][latitude]" id="latitude"/>
                                        <input type="hidden" name="data[Event][longitude]" id="longitude"/>
                                        <input type="text" placeholder="Type Location" id="location" name="data[Event][location]"  class="location required" style=" margin-bottom: 8px;margin-left: 17px;  margin-top: 24px; width: 435px;" />
                                        <div class="right-side-box map" id="map_canvas">
                                        	
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
										<ul class="middle" id="duration_div" style="vertical-align:top; margin-top:0px;">
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
                                        <input type="button" class="gray-btn mb20" onclick="invite_athlete_popup();" value="Invite atheletes/affiliates /teams etc " style="margin-top:30px; margin-bottom:5px !important;"/>
                                        <div class="clear"></div>
                                        
                                        <input type = "hidden" id = "number_invited_people" value = "0" />
                                        <div class="invited_people_div"></div>	 
                                        <div class="border-btm">
											<label style="display:none;" id="invitee_label">Invitees: </label>
											
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
                                        <input type="hidden" id="division_count" value="0"/>
										<!--<ul>
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
										</ul>-->
										<ul class="middle right-list">
                                        	<li>
                                            	
                                        <input type="button" class="gray-btn mt25 mb10" value="Add New Division" onclick="add_division();"/>
                                            </li>
                                        </ul>
									
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

<?php 
	echo $this->element('custom_wod_popup'); 
	echo $this->element('invite_athlete_popup'); 
?>
	
<script type="text/javascript">

$(document).ready(function(){
	
	
	$('#EventCounterPricing').val(1);
	$('.datepick').datepicker({ 
				minDate: 0, 
				dateFormat:"yy-mm-dd",
			    onClose: function (dateText, inst) {			
			        $(this).trigger('blur');			
			    }	
			});
	$('#division_count').val(1);
	$('#number_of_wods').val(1);
	$('#EventEventType').val("challenge");
	
	//add_division();
	
});

CKEDITOR.replace( 'EventDetails' ,
	{
		toolbar: [
			{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	
			{ name: 'insert', items: [ 'Image' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
			[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
			'/',																					// Line break - next group will be placed in new line.
			{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
		],
		filebrowserUploadUrl : '<?php echo $this->webroot.'img/ckeditor/upload.php'; ?>', 
		height: '100px'
	});
	


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
	$('ul.pricing:last').after('<ul class="two-columns pricing price_box_'+num+' clear-after"><li><label for="Eventprice'+num+'Price">Pricing</label><input type="text" id="Eventprice'+num+'Price" class="required number" name="data[Eventprice]['+num+'][price]"></li><li class="with-calendar"><label for="Eventprice'+num+'Date">Date</label><input type="text" id="Eventprice'+num+'Date" class="required datepick" name="data[Eventprice]['+num+'][date]" readonly="readonly"> <a href="javascript://" onclick="remove_pricing_div('+num+')"> &nbsp; </a></a></li></ul>');
	$('#EventCounterPricing').val(num);
	$('.datepick').datepicker({ minDate: 0, dateFormat:"yy-mm-dd" });
}

function remove_pricing_div(num)
{
	$('.price_box_'+num).remove();	
}

function add_division()
{
	open_lightbox('<?php echo $this->webroot.'events/add_division_popup'; ?>','500px','300px','no');
	
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
	var top = $('#map_canvas').offset().top;
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


$(function () {
    var lat = <?php echo !empty($this->data['Event']['latitude'])?$this->data['Event']['latitude']:'44.88623409320778'; //44.88623409320778 ?>,
        lng = <?php echo !empty($this->data['Event']['longitude'])?$this->data['Event']['longitude']:'-87.86480712897173'; //-87.86480712897173 ?>,
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
        
        //get country
        for(var i = 0; i < place.address_components.length; i += 1) {
			  var addressObj = place.address_components[i];
			  for(var j = 0; j < addressObj.types.length; j += 1) {
			    if (addressObj.types[j] === 'country') {			     
					$('#country').val(addressObj.long_name);
			    }
			  }
			}
        
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
                        var country = getCountry(results);
                    	$('#country').val(country.long_name);
                    	
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
