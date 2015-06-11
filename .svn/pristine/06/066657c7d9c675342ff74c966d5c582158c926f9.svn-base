<?php echo $this->Html->script('jquery-ui.custom'); 
 echo $this->Html->css(array('jquery-ui.custom')); 
 ?>
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<div class="column">
							<?php echo $this->Form->create('Event',array('type'=>'file','id'=>'CreateEventForm','class'=>'border-btm')); ?>
							<div class="header">
								<h3>EVENT </h3>					
                                  <?php echo $this->Form->submit('Save',array('id'=>'save_event')); 
										echo $this->Form->input('Event.id',array('type'=>'hidden','id'=>'event_id'));
                                  ?>                                  
								
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>

							<div class="column-body graybg create-event">							

								<div class="form-container no-lmr">
								
									
									<?php echo $this->Form->input('counter_pricing',array('type'=>'hidden','value' => count($ev_price))); ?>
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
                                                        <div class='fancy-file'>
                                                            <div class='fancy-file-name'>&nbsp;</div>
                                                            <button class='fancy-file-button'>Browse...</button>
                                                            <div class='input-container'>
                                                                <?php echo $this->Form->input('Event.picture',array('type'=>'file','class'=>'','label'=>false,'div'=>false,'onchange'=>'readURL(this)')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="inputtype">
														<img id="img_prev" src="#" alt="" />
													</div>
											</li>
										</ul>
										<ul class="two-columns">
											<li class="full">
											<?php echo $this->Form->label('Event.details','Event Details'); 
													echo $this->Form->input('Event.details',array('type'=>'textarea','class'=>'text-area','div'=>false,'label'=>false));	
												?>												
											</li>
										</ul>
										
										<?php if(isset($ev_price)){ $l=1;
												foreach($ev_price as $ep){
											?>
										<ul class="two-columns pricing price_box_<?php echo $l; ?>">
											<li>
												<?php echo $this->Form->label('Eventprice.'.$l.'.price','Pricing'); 
													echo $this->Form->input('Eventprice.'.$l.'.price',array('type'=>'text','class'=>'required number','value'=>$ep['price'],'div'=>false,'label'=>false));	
												?>												
											</li>
											<li class="with-calendar">
												<?php echo $this->Form->label('Eventprice.'.$l.'.date','Date'); 
													echo $this->Form->input('Eventprice.'.$l.'.date',array('type'=>'text','class'=>'required datepick','value'=>$ep['date'],'div'=>false,'label'=>false));	
												?>	
											</li>			
											
										</ul>
											
										<?php $l++; }}else{  ?>	
										
										<ul class="two-columns pricing price_box_1">
											<li>
												<?php echo $this->Form->label('Eventprice.1.price','Pricing'); 
													echo $this->Form->input('Eventprice.1.price',array('type'=>'text','class'=>'required number','div'=>false,'label'=>false));	
												?>												
											</li>
											<li class="with-calendar">
												<?php echo $this->Form->label('Eventprice.1.date','Date'); 
													echo $this->Form->input('Eventprice.1.date',array('type'=>'text','class'=>'required datepick','div'=>false,'label'=>false));	
												?>	
											</li>			
											
										</ul>
										<?php } ?>
										
										<ul class="two-columns">
										<li><a href="javascript://" onclick="add_pricing_div();">Add more pricing</a></li>
										</ul>
										<ul class="two-columns">
											<li class="full">
												<?php echo $this->Form->label('Event.notes','Notes'); 
													echo $this->Form->input('Event.notes',array('type'=>'textarea','class'=>'text-area','div'=>false,'label'=>false));	
												?>
											</li>
										</ul>
										
                                        </div> <!--left side box ends -->
                                        
                                        <!--right side map box-->
                                        <input type="hidden" name="data[Event][latitude]" id="latitude"/>
                                        <input type="hidden" name="data[Event][longitude]" id="longitude"/>
                                        <input type="text" placeholder="Type Location" id="location" name="data[Event][location]" value="<?php echo $this->data['Event']['location']; ?>"  class="location" />
                                        <div class="right-side-box map" id="map-canvas">
                                        	
                                        </div>
                                        <div class="clear"></div>
                                        <!--right side map box ends-->
                                       
                                      
                                        <section class="section-form-section">
									
                                        <div class="clearfix"></div>
										<ul>
											<li>
												<?php echo $this->Form->label('Event.event_type','Event Type'); 
													echo $this->Form->input('Event.event_type',array('type'=>'select','options'=>array('competition'=>'Competition','throwdown'=>'Throwdown','challenge'=>'Challenge','fundraiser'=>'Fundraiser'),'class'=>'required','div'=>false,'label'=>false));	
												?>												
											</li>
											<li>
												<?php echo $this->Form->label('Event.mode','Public/Private'); 
													echo $this->Form->input('Event.mode',array('type'=>'select','options'=>array('public'=>'Public','private'=>'Private'),'class'=>'required','div'=>false,'label'=>false));	
												?>												
											</li>
										</ul>
										<ul class="middle">
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
										<ul>
											<li>
												<?php echo $this->Form->label('Event.start_date','Date'); 
													  echo $this->Form->input('Event.start_date',array('type'=>'text','class'=>'required datepick','label'=>false,'div'=>false)); 
												?>
											</li>
											<li>
												<?php echo $this->Form->label('Event.start_time','Time'); 
													  echo $this->Form->input('Event.start_time',array('type'=>'time','class'=>'required','label'=>false,'div'=>false)); 
												?>
											</li>
										</ul>
                                        <input type="button" class="gray-btn mb20" value="Invite atheletes/affiliates /teams etc "/>
                                        <div class="clear"></div>
                                        
                                        	   
                                       <!--<li class="invites"> <label> Invitees</label>
                                        	 <input type="button" class="invitees" value="Invitee #1" />
                                             <span class="cross"> </span>
                                        </li>
                                        
                                        <li class="invites"> <label> Invitees</label>
                                        	 <input type="button" class="invitees" value="Invitee #2" />
                                             <span class="cross"> </span>
                                        </li>
                                        
                                        <li class="invites"> <label> Invitees</label>
                                        	 <input type="button" class="invitees" value="Invitee #3" />
                                             <span class="cross"> </span>
                                       </li>-->
                                        
                                     
                                        <div class="clear"></div> 
                                  
								
                                    
                                    
									
                                    </section>                            
                                    
								</div>
								<div class="clear"></div>
							</div>
							 <?php echo $this->Form->end(); ?>     
						</div><!--.left-column-->

						<div class="column">
							<div class="column-body graybg create-event">
								<div class="form-container no-lmr">
									<section class="section-form-section division_section">
										<form id="DivisionForm" method="post" action="#" >
                                        <div class="clearfix"></div>
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
                                                    <?php for( $k=1; $k<11; $k++){ ?>
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
									</form>
									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->
	
<script type="text/javascript">

$(document).ready(function(){
	$('#EventCounterPricing').val(<?php echo count($ev_price); ?>);
	$('.datepick').datepicker({ minDate: 0, dateFormat:"yy-mm-dd" });
});


function add_pricing_div()
{
	var num = $('#EventCounterPricing').val();
	num = parseInt(num) + 1;
	$('ul.pricing:last').after('<ul class="two-columns pricing price_box_'+num+'"><li><label for="Eventprice'+num+'Price">Pricing</label><input type="text" id="Eventprice'+num+'Price" class="required number" name="data[Eventprice]['+num+'][price]"></li><li class="with-calendar"><label for="Eventprice'+num+'Date">Date</label><input type="text" id="Eventprice'+num+'Date" class="required datepick" name="data[Eventprice]['+num+'][date]"></li><li><a href="javascript://" onclick="remove_pricing_div('+num+')">Remove</a></a></li></ul>');
	$('#EventCounterPricing').val(num);
	$('.datepick').datepicker({ minDate: 0, dateFormat:"yy-mm-dd" });
}

function remove_pricing_div(num)
{
	$('.price_box_'+num).remove();	
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

function add_division()
{
	var event_id = $('#event_id').val();
	var division = $('#division').val();
	var division_sex = $('#division_sex').val();
	var num_wods = $('#number_of_wods').val();
	
	$.post('<?php echo $this->webroot; ?>events/add_division',{ division:division, division_sex: division_sex, num_wods: num_wods}, function(data) {
		$('.division_section').after(data);
	});
}

function initialize() {

  var markers = [];
   var latLng = new google.maps.LatLng(-34.397, 150.644);
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('location'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
  
}

google.maps.event.addDomListener(window, 'load', initialize);


</script>	
