<?php
	
	echo $this->Html->css(array('jcrop/jquery.Jcrop'));
	echo $this->Html->script(array('jcrop/js/jquery.Jcrop'));		

	echo $this->Html->script(array('jquery-ui.custom','ckeditor/ckeditor')); 
	echo $this->Html->css(array('jquery-ui.custom')); 
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<style>
	#errorMessage { margin-bottom: 0;}
</style>

	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<?php 
							echo $this->Form->create('User',array('id'=>'UserProfileForm','class'=>'border-btm manageProfile','type' => 'file')); 
							
							echo $this->Form->input('User.id',array('type' => 'hidden', 'value' => $user['User']['id']));
							echo $this->Form->input('AffiliateProfile.id',array('type' => 'hidden','value'=>$affiliate_profile_id));
							echo $this->Form->input('AffiliateProfile.user_id',array('type' => 'hidden', 'value' => $user['User']['id']));
						?>
						 <div id="coordinate_input">
			                <input type="hidden" id="x" name="x" />
							<input type="hidden" id="y" name="y" />
							<input type="hidden" id="w" name="w" />
							<input type="hidden" id="h" name="h" />
		                </div>
						<div class="column">
							<div class="header">
								<h3>Manage Profile </h3>
								<div class="blue save-btn">								
                                  <?php echo $this->Form->submit('Save',array('id'=>'save_profile','class'=>'save_event')); ?>  
								</div>								  
								
							</div>
							<?php 
								echo $this->Session->flash('success');
								echo $this->Session->flash('error');
								echo $this->Session->flash();
							?>
							<div class="column-body graybg create-event" style="padding-bottom:0px;">
								<div class="form-container no-lmr">							
                                    <div class="container">
										<div class="inlineRow">
											<div class="leftColumns">	
												<ul class="two-columns">
													<li>
														<?php echo $this->Form->label('User.first_name','First Name'); 
															echo $this->Form->input('User.first_name',array('type'=>'text', 'value' => $user['User']['first_name'], 'class'=>'required','label'=>false,'div'=>false)); 
														?>											
													</li>
													<li>
														<?php echo $this->Form->label('User.last_name','Last Name'); 
															echo $this->Form->input('User.last_name',array('type'=>'text', 'value' => $user['User']['last_name'], 'class'=>'required','label'=>false,'div'=>false)); 
														?>											
													</li>
												</ul>
												
												<div class="clear"></div>
	
												<ul class="two-columns">
													<li>
													<?php echo $this->Form->label('User.username','Username'); 
															echo $this->Form->input('User.username',array('type'=>'text', 'value' => $user['User']['username'], 'class'=>'required','label'=>false,'div'=>false)); 
														?>
												</li>
												<li>
													<?php echo $this->Form->label('User.photo','Photo'); ?>												
													<div class="inputbrows">
														<div class='fancy-file' style="overflow:inherit !important;">
															<div class='fancy-file-name'>&nbsp;</div>
															<button class='fancy-file-button'>Browse...</button>
															<div class='input-container'>
																<?php echo $this->Form->input('User.photo',array('type'=>'file','value'=>$user['User']['photo'],'class'=>'','label'=>false,'div'=>false,'onchange'=>'readURL(this)')); ?>
															</div>
														</div>
													</div>
												</li>
											</ul>
												
												<div class="clear"></div>
	
												<ul class="two-columns">
													<li>
														<?php echo $this->Form->label('User.other_name','Affiliate Name'); 
															echo $this->Form->input('User.other_name',array('type'=>'text', 'value' => $user['User']['other_name'], 'class'=>'required','label'=>false,'div'=>false)); 
														?>								
												</li>
												<li>
													<div class="inputtype">
														<div class="cropbox" style="max-width:70px; max-height:70px; overflow:hidden;">
															<img id="img_prev" src="<?php echo $this->webroot.'files/'.$user['User']['id'].'/thumb_'.$user['User']['photo']; ?>" alt="" height="70" width="70" style="height:70px;" />
														</div>
													</div>
												</li>
											</ul>
										</div>
	
											<div class="leftColumns">	
												<ul class="two-columns clear-after">
													<li class="full">
													<?php echo $this->Form->label('User.profile_description','Description'); 
															echo $this->Form->input('User.profile_description',array('type'=>'textarea','value'=>$user['User']['profile_description'],'class'=>'ckeditor text-area','div'=>false,'label'=>false));	
														?>												
													</li>
												</ul>
											</div>
											<div class="clear"></div>
										</div>

										<div class="inlineRow">
											<div class="leftColumns">
												<ul class="two-columns">
													<li>
														<?php echo $this->Form->label('AffiliateProfile.fb_page','Facebook Page ID'); 
															echo $this->Form->input('AffiliateProfile.fb_page',array('type'=>'text','class'=>'','label'=>false,'div'=>false)); 
														?>											
													</li>
													<li>
														<?php
															echo $this->Form->label('AffiliateProfile.twitter_page','Twitter Page ID'); 
															echo $this->Form->input('AffiliateProfile.twitter_page',array('type'=>'text','class'=>'','label'=>false,'div'=>false)); 
														?>											
													</li>
												</ul>
												<div class="clear"></div>
		
												<ul class="two-columns clear-after">
													<li>
														<?php
															echo $this->Form->label('AffiliateProfile.region_id','Region'); 
															echo $this->Form->input('AffiliateProfile.region_id',array('type'=>'select','empty' => 'Select Region','options'=>$regions,'class'=>'','div'=>false,'label'=>false));	
														?>
													</li>
													<li class="with-calendar">
														<?php
															echo $this->Form->label('AffiliateProfile.established_date','Established Date'); 
															echo $this->Form->input('AffiliateProfile.established_date',array('type'=>'text','class'=>'datepick','div'=>false, 'readonly' => 'readonly','label'=>false));
														?>
													</li>
												</ul>
											</div> <!--left column ends here-->

											<div class="leftColumns">		
												<ul class="two-columns">
													<li>
														<?php echo $this->Form->label('AffiliateProfile.google_page','Google Page'); 
															echo $this->Form->input('AffiliateProfile.google_page',array('type'=>'text','class'=>'url','label'=>false,'div'=>false)); 
														?>											
													</li>
													<li>
														<?php echo $this->Form->label('AffiliateProfile.charity_amount_raised','Charity Amount Raised'); 
															echo $this->Form->input('AffiliateProfile.charity_amount_raised',array('type'=>'text','class'=>'number','label'=>false,'div'=>false)); 
														?>											
													</li>
												</ul>
												<div class="clear"></div>
		
												<ul class="two-columns">
													<li>
														<?php echo $this->Form->label('AffiliateProfile.no_of_athletes','Number of Athletes'); 
															echo $this->Form->input('AffiliateProfile.no_of_athletes',array('type'=>'text','class'=>'number','label'=>false,'div'=>false)); 
														?>											
													</li>
													<li>
														<?php echo $this->Form->label('AffiliateProfile.no_of_fans','Number of Fans'); 
															echo $this->Form->input('AffiliateProfile.no_of_fans',array('type'=>'text','class'=>'number','label'=>false,'div'=>false)); 
														?>
													</li>
												</ul>
											</div> <!--left column ends here-->
											<div class="clear"></div>
										</div>

										<div class="inlineRow">	
											<div class="leftColumns">
												<ul class="two-columns">
													<li>
														<?php
															echo $this->Form->label('AffiliateProfile.coach_1_id','Coach 1'); 
															echo $this->Form->input('AffiliateProfile.coach_1_id',array('type'=>'select','empty'=>'Select Coach','options'=>$coaches,'class'=>'','div'=>false,'label'=>false));	
														?>												
													</li>		
													<li>
														<?php
															echo $this->Form->label('AffiliateProfile.coach_2_id','Coach 2'); 
															echo $this->Form->input('AffiliateProfile.coach_2_id',array('type'=>'select','empty'=>'Select Coach','options'=>$coaches,'class'=>'','div'=>false,'label'=>false));
														?>
													</li>
													
													
												</ul>
											</div> <!--left column ends here-->
		
											<div class="leftColumns">		
												<ul class="two-columns">
													<li>
														<?php echo $this->Form->label('AffiliateProfile.show_fans','Show number of fans on profile'); ?>
														<div class="radioContainer">	
														<?php 
																if ( !empty($this->request->data['AffiliateProfile']['show_fans']) &&  ($this->request->data['AffiliateProfile']['show_fans'] == 'Yes'))
																{
																	$radio_val = 'Yes';
																}else{
																	$radio_val = 'No';
																}
																echo $this->Form->input('AffiliateProfile.show_fans', array(
																'between' => '  ',
																'separator' => ' ',
																'type' => 'radio',
																'div' => 'showNum',
																'options' => array('Yes' => 'Yes', 'No' => 'No'),
																'value' => $radio_val,
																'legend' => false
															));
														?>
														</div>      										
													</li>	
												</ul>
											</div> <!--left column ends here-->
											<div class="clear"></div>
										</div>
										
										<div class="inlineRow">											
										
											<input type="hidden" class="MapLat" name="data[AffiliateProfile][latitude]" id="latitude" value="<?php if(isset($this->request->data['AffiliateProfile']['latitude'])) echo $this->request->data['AffiliateProfile']['latitude']; ?>"/>
	                                        <input type="hidden" class="MapLon" name="data[AffiliateProfile][longitude]" id="longitude" value="<?php if(isset($this->request->data['AffiliateProfile']['longitude'])) echo $this->request->data['AffiliateProfile']['longitude']; ?>" />
	                                        <input type="hidden" class="MapCon" name="data[AffiliateProfile][country]" id="country" value="<?php if(isset($this->request->data['AffiliateProfile']['country'])) echo $this->request->data['AffiliateProfile']['country']; ?>" />
	                                        <label for="">Address</label>
	                                        <input type="text" placeholder="Type location here" value="<?php if(isset($this->request->data['AffiliateProfile']['location'])) echo $this->request->data['AffiliateProfile']['location']; ?>" id="location" name="data[AffiliateProfile][location]"  class="location required" style=" margin-bottom: 8px; width: 100%;" />
	                                        <div class="map" id="map_canvas"></div>
									
										</div>
										
									</div> <!--container box ends -->
								</div>
								<div class="clear"></div>
							</div>
						</div><!--.left-column-->
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->
	
<div id="inp_img_div" style="display:none;">
	<img src="" id="img_crop" alt="" />
	<input id="crop_save" name="save" type="submit" value="Save" class="blueBtn" />
	
</div>
	
<script type="text/javascript">
$(document).ready(function(){
	$('.datepick').datepicker({ dateFormat:"yy-mm-dd" });
	$('#crop_save').click(function(e){
		$.fancybox.close();
		return false;
	});
});

CKEDITOR.replace( 'UserProfileDescription' ,
	{
		toolbar: [
			{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
			[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
			'/',																					// Line break - next group will be placed in new line.
			{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
		]
	});
	
function readURL(input) {
	
	if (input.files[0] && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#img_prev').attr('src', e.target.result).width(70).height(70);
		};

		reader.readAsDataURL(input.files[0]);
	}
}	

var jcrop_api;
var bounds, boundx, boundy;
function readURL(input) {
	if (input.files[0] && input.files[0]) {
		
		var reader = new FileReader();
		
		reader.onload = function (e) {
			$('#img_prev')
			.attr('src', e.target.result)
			.width(70)
			.height(70);
			
			$('#img_crop').attr('src', e.target.result);
			clearCoords;
			$('.jcrop-holder img').attr('src', e.target.result);
			$.fancybox.open({
				'href' : '#inp_img_div',
				'afterLoad' : function(){
					
					
					$('#img_crop').Jcrop({
						  onChange:   showCoords,
						  onSelect:   showCoords,
						  onRelease:  clearCoords			
						},function(){
						  jcrop_api = this;
						  bounds = jcrop_api.getBounds();
							boundx = bounds[0];
							boundy = bounds[1];
						});			
			
					$('#coords').on('change','input',function(e){
					  var x1 = $('#x1').val(),
						  x2 = $('#x2').val(),
						  y1 = $('#y1').val(),
						  y2 = $('#y2').val();
					  jcrop_api.setSelect([x1,y1,x2,y2]);
					});
				}
			});
		};
		reader.readAsDataURL(input.files[0]);
	}
}

  function showCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
    showPreview(c);
  };
  
  function showPreview(coords) {
  	//console.log(coords);
   
	if (parseInt(coords.w) > 0)
	{
		var rx = 100 / coords.w;
		var ry = 100 / coords.h;

		$('#img_prev').css({
			width: Math.round(rx * boundx) + 'px',
			height: Math.round(ry * boundy) + 'px',
			marginLeft: '-' + Math.round(rx * coords.x) + 'px',
			marginTop: '-' + Math.round(ry * coords.y) + 'px'
		});
	}
}


  function clearCoords()
  {
    $('#coords input').val('');
  }
  
  
$(function () {
    var lat = <?php echo !empty($this->request->data['AffiliateProfile']['latitude'])?$this->request->data['AffiliateProfile']['latitude']:'44.88623409320778'; //44.88623409320778 ?>,
        lng = <?php echo !empty($this->request->data['AffiliateProfile']['longitude'])?$this->request->data['AffiliateProfile']['longitude']:'-87.86480712897173'; //-87.86480712897173 ?>,
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
