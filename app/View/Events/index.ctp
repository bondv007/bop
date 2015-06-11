<?php 
 echo $this->Html->css(array('jquery-ui.custom')); 
 echo $this->Html->script(array('jquery-ui.custom')); 
?>	
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>

	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid events-map">
			<div class="athlt-banner-main row">
				<div class="bg-map"> 
                	<div class="upper-map-options">
                    	<div class="event-map"> EVENTS MAP </div>
                        
                        <label>
                        	<input type="radio" checked="checked"  value="competition" name="event_type" />
                        Competitions
                        </label>   
                        
                        <label>
                        	<input type="radio"  value="throwdown" name="event_type" />
                        Throwdowns
                        </label>  
                        
                        <label>
                        	<input type="radio"  value="challenge" name="event_type" />
                          Challenges
                        </label> 
                        <label>
                        	<input type="radio"  value="fundraiser" name="event_type" />
                          Fundraiser
                        </label>  
                      <!--  <div class="setting">
                        		<i class="fa fa-cog"></i>
                        </div>-->
                        <div class="clear"></div> 
                    </div>
                
				
                </div>
				<div id="map_canvas" style="margin-top:-20px;"></div>
			</div>
		</div>
	</section>
	<!-- Slider End -->
<div id="locs" style="display:none;"></div>

<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid event-colum">
			<div class="body-content-mn row mt10">
				
				<div class="row">
					
					<div class="about-team">
                    <div class="event-bg">
						<h2>Events</h2>		
                        <div class="right-drop">                         
                            	
                            	<select id="event_type" class="dropdown" onchange="filter_events();">
									<option value="">Event Type</option>
									<option value="competition">Competition</option>
									<option value="throwdown">Throwdown</option>
									<option value="challenge">Challenge</option>
									<option value="fundraiser">Fundraiser</option>
								</select>                
                           
								<select id="event_location" class="dropdown" onchange="filter_events();">
									<option value="">Location</option>
									<?php if(!empty($locations)){
											
											foreach($locations as $loc){ 
									?>									
										<option value="<?php echo $loc; ?>"><?php echo $loc; ?></option>
										
									<?php }} ?>
								</select>                            	
                          	
                            	<input type="text" class="dropdown datepick" id="event_date" placeholder="Date"/>                            	
                            
                        </div>
                        <div class="clear"></div>
                    </div>    				
						<div class="inner-sponer event_list">
							
							<?php if(!empty($events)){ 
									$i=1;
									foreach($events as $ev){ 
								?>
							<div class="colum <?php if(($i % 4) == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>'" style="cursor:pointer;">
								<div class="image">
                                	<div class="black-strip"><?php echo $ev['Event']['title']; ?> </div>
									<a href="<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>"><img src="<?php echo $this->webroot.'files/events/'.$ev['Event']['id'].'/'.$ev['Event']['picture']; ?>" alt="" width="267" height="223" style="height:223px;" /></a>
									<a class="read-more" href="<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>">Register</a>
								</div>
								<h3><a href="#"><?php echo formatDate($ev['Event']['start_date']); ?></a></h3>
							</div>
							
							<?php $i++; }} else { ?>
							
							<div style="height: 150px; text-align:center;">
							<p style="margin-top:70px;">No Upcoming Events.</p>
							</div>
							
							<?php } ?>						
						
						
						<?php							
						
							if(!isset($url)){
								$url=array('controller'=>$this->params['controller'],'action'=>'filter_events');
								//$url=$this->passedArgs;
							}
							$this->Paginator->options(array(
										'url' => $url,
										'update' => '.event_list',
										//'data' => http_build_query($request_data),
										'evalScripts' => true,
										'method' => 'POST'
							));
							?>
						
							<div class="pagination">
								<ul>
									<?php
										echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled','tag'=>'li','disabledTag' => 'a'));
										echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled','tag'=>'li','disabledTag' => 'a')); 
									?>
								</ul>
							</div>									
					</div>
				
			</div>
		</div>
        </div>
		</div>
	</section>
	<!-- MId Section End -->
<?php
	echo $this->Js->writeBuffer();
?>		
<script type="text/javascript">


var data = <?php echo $map_data; ?>;
var map;
var markers = [];
var lastinfowindow;
var locIndex;


$(document).ready(function(){
	
	initialize_all_event();
	$('.datepick').datepicker({ 
				minDate: 0, 
				dateFormat:"yy-mm-dd",
				onSelect: function(dateText, inst) {
					
					filter_events();
				}
	}); 
	
});

function filter_events()
{
	var event_type = $('#event_type').val();
	var event_location = $('#event_location').val();
	var event_date = $('#event_date').val();
	
	showLoading('.event_list','<?php echo $this->webroot.'images/loading.gif'; ?>');
	$.post('<?php echo $this->webroot; ?>events/filter_events',{event_type: event_type, event_location: event_location, event_date: event_date }, function(response){
		
		$('.event_list').html(response);		
	});	
}

function initialize_all_event() 
{
	var latlng = new google.maps.LatLng(0, 0);
	var myOptions = {
		zoom: 2,
		minZoom: 2,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	
	geocoder = new google.maps.Geocoder();
	
	data.forEach(function(mapData,idx) {
		geocoder.geocode( { 'address': mapData.address}, function(results, status) {
				
				if (status == google.maps.GeocoderStatus.OK) {
					
					var marker = new google.maps.Marker({
						map: map, 
						position: results[0].geometry.location,
						title: mapData.title
						//icon: getIcon(mapData.type)
					});
					var contentHtml = "<div style='width:150px;height:80px' class='map_tooltip'><h3>"+mapData.title+"</h3>"+mapData.address+"</div>";
					var infowindow = new google.maps.InfoWindow({
		    			content: contentHtml
					});
					google.maps.event.addListener(marker, 'click', function() {
					  infowindow.open(map,marker);
					});
					marker.locid = idx+1;
					marker.infowindow = infowindow;
					markers[markers.length] = marker;
					
					var sideHtml = '<p class="loc" data-locid="'+marker.locid+'"><b>'+mapData.title+'</b><br/>';
						 sideHtml += mapData.address + '</p>';
						 $("#locs").append(sideHtml); 
					
					
					//Are we all done? Not 100% sure of this
					if(markers.length == data.length) 
								doFilter();

				} else {
					//alert("Geocode was not successful for the following reason: " + status);
				}
			});

	});

	$(document).on("click",".loc",function() {
		var thisloc = $(this).data("locid");
		for(var i=0; i<markers.length; i++) {
			if(markers[i].locid == thisloc) {
				//get the latlong
				if(lastinfowindow instanceof google.maps.InfoWindow) lastinfowindow.close();
				map.panTo(markers[i].getPosition());
				markers[i].infowindow.open(map, markers[i]);
				lastinfowindow = markers[i].infowindow;
			}
		}
	});

	/*
	Run on every change to the checkboxes. If you add more checkboxes to the page,
	we should use a class to make this more specific.
	*/

	function doFilter() {
		if(!locIndex) {
			locIndex = {};
			//I reverse index markers to figure out the position of loc to marker index
			for(var x=0, len=markers.length; x<len; x++) {
				locIndex[markers[x].locid] = x;
			}
		}
		
		
		//what's checked?
		var checked = $("input[type=radio]:checked");
		
		var selTypes = [];
		for(var i=0, len=checked.length; i<len; i++) {
			selTypes.push($(checked[i]).val());
		}
		for(var i=0, len=data.length; i<len; i++) {
			var sideDom = "p.loc[data-locid="+(i+1)+"]";
			
			
			
			//Only hide if length != 0
			if(checked.length !=0 && selTypes.indexOf(data[i].type) < 0) {
				$(sideDom).hide();
				markers[locIndex[i+1]].setVisible(false);
			} else {
				$(sideDom).show();
				markers[locIndex[i+1]].setVisible(true);
			}
		}
	}

	$(document).on("click", "input[type=radio]", doFilter);

}

</script>	
	
