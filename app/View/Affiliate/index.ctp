<?php 
 echo $this->Html->css(array('jquery-ui.custom','elastislide')); 
 echo $this->Html->script(array('jquery-ui.custom','cycleall','jquery.elastislide')); 
?>	
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>

	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid events-map affiliate">
			
				<!-- Elastislide Carousel -->
				<div id="carousel" class="es-carousel-wrapper">
					<div class="es-carousel">
						<ul class="months_slider">
							
							<?php
								if(isset($month_data[0]))
								{
									$temp = $month_data[0];	
								}					
																 
								$slide_start = 0; $j=0;
								foreach($months_list as $ml_date => $ml){  ?>
								
								<li onclick="get_affiliate_of_month('<?php echo $ml_date; ?>');" class="<?php echo 'month_li_'.$ml_date; if(isset($temp)){  if($ml_date == $temp['PersonOfMonth']['date']){ echo ' active'; $slide_start = $j; }} ?>"><?php echo $ml; ?></li>
									
							<?php $j++; } ?>	
							
						</ul>
					</div>
				</div>
				<!-- Elastislide Carousel -->
				
				
			<div class="row">
				<?php if(!empty($month_data)){ 
						$i=0;
						foreach($month_data as $md){
					?>
				<div class="contact mb60 all_aff_data date_<?php echo $md['PersonOfMonth']['date']; ?>" style="<?php if($i!=0) echo 'display:none;'; ?>">
                	<h1>AFFILIATE OF THE MONTH</h1>                	
                	
                	<div class="top-side-img">
                		<img src="<?php echo $this->webroot.'files/'.$md['User']['id'].'/'.$md['User']['photo']; ?>"  alt="<?php echo $md['User']['other_name']; ?>" />
                	</div>
                    <p><?php echo $md['User']['first_name'].' '. $md['User']['last_name'].'<br>';
							 echo wraptext($md['User']['profile_description'], 600); ?></p>
                   <?php if(!empty($md['User']['profile_description'])){ ?>	
                    <a class="read_more" target="_blank" href="<?php echo $this->webroot.'profile/'.$md['User']['username']; ?>"> Read More</a>
                  <?php } ?>
                </div>
                <?php $i++; }} ?>
                
                <div class="contact mb60 all_aff_data no_aff" style="<?php if(!empty($month_data)) echo 'display:none;'; ?>">
                	<h1>AFFILIATE OF THE MONTH</h1>    
                	<div style="height:150px; text-align:center; margin-top:50px;">
                		<p>No Affiliate of the Month Selected</p>
                	</div>	
                </div>	
                
                
			</div>
		</div>
	</section>
	<!-- Slider End -->
	
<section class="body-content-bg ptb25 row">
	<div class="page-mid event-colum">
	
	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid events-map">
			<div class="affiliate-banner row">
					<div class="about-team mt0">
	                    <div class="event-bg blk-bg">
							<h2>AFFILIATES MAP</h2>
							<div class="select-box pull-right">
			                	<!--<select class="medium"> 
			                    	<option> Region </option>
			                    	<option> Items 1</option>
			                    	<option> Items 2</option>
			                 </select>-->
			                	<select id="affiliate_region_location" name="affiliate_region" class="medium" onchange="filter_affiliates(this.value);"> 
			                    	<option value="0">Region</option>
									<?php if(!empty($regions)){											
											foreach($regions as $region_id => $loc){  ?>																		
										<option value="<?php echo $region_id; ?>"><?php echo $loc; ?></option>										
									<?php }} ?>
			                    </select>
			                    
			                </div>	
	                            <div class="clear"></div>
	                    </div>    	
                    </div>
				<div id="map_canvas" class="bg_map" style="margin-top:-20px;"></div>
			</div>
		</div>
	</section>
	<!-- Slider End -->

<!-- MId Section -->
	
			<div class="body-content-mn row mt10">
				
				<div class="row affiliate">					
					<div class="about-team">
                    <div class="event-bg blk-bg">
						<h2>AFFILIATES</h2>		
                        <div class="clear"></div>
                    </div>    				
					<div class="inner-sponer event_list">
							
					<?php if(!empty($affiliates)){ 
							$k=1;
							foreach($affiliates as $region => $aff_data){ ?>
						
						<div class=""> <h3 class="blue-text"> <?php echo $region; ?> </h3></div>
									
						 <div class="slider_container_<?php echo $k; ?> region_box">				 
						<?php  	$j=0;		 
								for($i=0; $i<ceil(count($aff_data)/3); $i++){   ?>							
								
							<ul class="compition-sBox mt10">
									
								<?php if(isset($aff_data[$j])){ ?>
								<li>	
									<div class="colum <?php if($j%3 == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo ''; ?>'">
										<div class="image">
		                                	<div class="black-strip"><?php if(!empty($aff_data[$j]['User']['other_name'])) echo $aff_data[$j]['User']['other_name']; else echo $aff_data[$j]['User']['first_name'].' '.$aff_data[$j]['User']['last_name']; ?> </div>
											<a href="<?php if(!empty($aff_data[$j]['User']['username'])) echo $this->webroot.'profile/'.$aff_data[$j]['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$aff_data[$j]['User']['id'].'/'.$aff_data[$j]['User']['photo']; ?>" alt=""  />
											</a>											
										</div>										
									</div>
								</li>
								<?php } ?>
								
								<?php if(isset($aff_data[$j+1])){ ?>
								<li>	
									<div class="colum <?php if(($j+1)%3 == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo ''; ?>'">
										<div class="image">
		                                	<div class="black-strip"><?php if(!empty($aff_data[$j+1]['User']['other_name'])) echo $aff_data[$j+1]['User']['other_name']; else echo $aff_data[$j+1]['User']['first_name'].' '.$aff_data[$j+1]['User']['last_name']; ?> </div>
											<a href="<?php if(!empty($aff_data[$j+1]['User']['username'])) echo $this->webroot.'profile/'.$aff_data[$j+1]['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$aff_data[$j+1]['User']['id'].'/'.$aff_data[$j+1]['User']['photo']; ?>" alt="" />
											</a>											
										</div>										
									</div>
								</li>
								<?php } ?>
								
								
								<?php if(isset($aff_data[$j+2])){ ?>
								<li>	
									<div class="colum <?php if(($j+2)%3 == 0) { echo 'no-lm'; }?>" onclick="window.location='<?php echo ''; ?>'">
										<div class="image">
		                                	<div class="black-strip"><?php if(!empty($aff_data[$j+2]['User']['other_name'])) echo $aff_data[$j+2]['User']['other_name']; else echo $aff_data[$j+2]['User']['first_name'].' '.$aff_data[$j+2]['User']['last_name']; ?> </div>
											<a href="<?php if(!empty($aff_data[$j+2]['User']['username'])) echo $this->webroot.'profile/'.$aff_data[$j+2]['User']['username']; else echo '#'; ?>">
												<img src="<?php echo $this->webroot.'files/'.$aff_data[$j+2]['User']['id'].'/'.$aff_data[$j+2]['User']['photo']; ?>" alt="" />
											</a>											
										</div>										
									</div>
								</li>
								<?php } 								
									$j+=3; 	?>						
									
								</ul>		
								
							<?php } ?>
							</div>
							<ul class="row tCenter step_paging step_tabs_<?php echo $k; ?>"></ul>
								
							
							<script type="text/javascript">
							 $(document).ready(function(){	
	
								 $('.slider_container_<?php echo $k; ?>').cycle({
										speed: 1000,
										timeout:3000,
										fx: 'fade',
										pager: '.step_tabs_<?php echo $k; ?>',
										activePagerClass: 'active',
										pagerAnchorBuilder: function(idx, slide) {
											return '<li><a href="javascript://"></a></li>';
										}
									});
							});
							</script>
							<div class="clear"></div>
							<?php  $k++;  } }else{ ?>
							
								
							<div style="height: 150px; text-align:center;">
							<p style="margin-top:70px;">No affiliates found.</p>
							</div>
							
							<?php } ?>													
					</div>				
			</div>
		</div>
        </div>
		</div>
	</section>
	<!-- MId Section End -->
	<div id="locs" style="display:none;"></div>
		
<script type="text/javascript">

var data = <?php echo $map_data; ?>;
var map;
var markers = [];
var lastinfowindow;
var locIndex;


$(document).ready(function(){
	
	initialize_all_event();
	 $('.slider_container').cycle({
			speed: 1000,
			timeout:4000,
			fx: 'fade',
			pager: '.step_tabs',
			activePagerClass: 'active',
			pagerAnchorBuilder: function(idx_1, slide) {
				return '<li><a href="javascript://"></a></li>';
			}
		});
		
	$('#carousel').elastislide({
			imageW 	: 180,
			minItems	: 5,
			current: <?php echo $slide_start; ?>
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
	
	//$(document).on("change", "#affiliate_region_location", doFilter);
	
});

function get_affiliate_of_month(cl)
{

	var flag = 0;	
	
	$('.all_aff_data').each(function(ind,ele){
		if($(this).hasClass('date_' + cl))
		{			
			flag = 1;			
		}
	});
	$('.all_aff_data').hide();
	
	$('.months_slider li').removeClass('active');
	$('.month_li_'+cl).addClass('active');
	
	if(flag == 0)
	{
		$('.no_aff').slideDown();
	}else{
		$('.date_'+cl).slideDown();
	}
}

function filter_affiliates(aff_region)
{
	if(aff_region != '0')
	{
		//console.log(aff_region);
		showLoading('.event_list','<?php echo $this->webroot.'images/loading.gif'; ?>');
		$.post('<?php echo $this->webroot; ?>affiliate/filter_affiliates',{region: aff_region }, function(response){
			
			$('.event_list').html(response);	
			doFilter();	
		});	
	}	
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
					var contentHtml = "<div style='width:150px;height:80px' class='map_tooltip'><h3>"+mapData.title+"</h3>"+"<strong>Region: "+mapData.region+"</strong><br>"+mapData.address+"</div>";
					var infowindow = new google.maps.InfoWindow({
		    			content: contentHtml
					});
					google.maps.event.addListener(marker, 'click', function() {
					  infowindow.open(map,marker);
					});
					marker.locid = idx+1;
					marker.infowindow = infowindow;
					markers[markers.length] = marker;
					
					var sideHtml = '<p class="loc" data-locid="'+marker.locid+'"><b>'+mapData.title+'</b><br/>'+'<strong>Region: '+mapData.region+'</strong>';
						 sideHtml += mapData.address + '</p>';
						 $("#locs").append(sideHtml); 
					
					//Are we all done? Not 100% sure of this
					//if(markers.length == data.length) 
								//doFilter();

				} else {
					//alert("Geocode was not successful for the following reason: " + status);
				}
			});
	});
}

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
		
		var checked = $("#affiliate_region_location");
		
		if(checked.val() != "0")
		{
			var selTypes = [];
			selTypes.push($(checked).val());
			for(var i=0, len=data.length; i<len; i++) {
				var sideDom = "p.loc[data-locid="+(i+1)+"]";				
				
				if(checked.length !=0 && selTypes.indexOf(data[i].region_id) < 0) {				
					
					$(sideDom).hide();
					markers[locIndex[i+1]].setVisible(false);
				} else {
					
					$(sideDom).show();
					markers[locIndex[i+1]].setVisible(true);
				}
			}
			
		}else{
			for(var i=0, len=data.length; i<len; i++) {
				var sideDom = "p.loc[data-locid="+(i+1)+"]";
				//$(sideDom).show();
				markers[locIndex[i+1]].setVisible(true);
			}	
		}
		
	}
	
	
</script>	

<?php 	echo $this->Js->writeBuffer(); ?>	
