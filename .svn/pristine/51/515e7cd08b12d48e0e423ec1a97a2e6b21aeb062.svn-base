<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "837db686-bb47-428d-a2d8-a5c5fe0ecac3", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<?php ?>
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns regsiter-2">
						<div class="right-column column sponcers">
							<div class="inlineRow">
								<div class="header">
									<h3>Recommended Events</h3>
								</div>

								<div class="column-body">
									<?php if( !empty($recommended) ){
											foreach($recommended as $rd){ 
										 ?>
									<div class="event">
										<a href="<?php echo $this->webroot.'events/event_details/'.$rd['Event']['id']; ?>">
										<div class="image">
											<img src="<?php echo $this->webroot.'files/events/'.$rd['Event']['id'].'/big_'.$rd['Event']['picture']; ?>" alt="">
											<span class="black-trans"><?php echo $rd['Event']['title']; ?></span>
											<a href="<?php echo $this->webroot.'events/event_details/'.$rd['Event']['id']; ?>" class="register">Register</a>
										</div>
										<div class="dated"><?php echo formatDate($rd['Event']['start_date']); ?></div>
										</a>
									</div>

									<?php }} ?>
								</div>
							</div>
							<div class="clear"></div>
						</div><!--.right-column-->

						<div class="left-column column">
							<div class="inlineRow">
								<div class="header">
									<h1>Confirmation</h1>
									<div class="clear"></div>
								</div>

								<div class="row confirmation-cont">
									<div class="tCenter">
										<div class="confirmation-cont-head">
											<h2 class="blue">Success!</h2>
											<p>You're all signed-up. We can't wait to see you at the big event. Keep training.</p>
										</div>
									</div>
									<div class="confirmation-cont-body">
										<h3>Athlete Confirmation Details</h3>
										<div class="payment_event_details">
											<p class="seprtr"><strong><?php echo $details['Event']['title']; ?></strong></p>
											<ul>
												<li><strong>Location:</strong> <?php echo $details['Event']['location']; ?></li>
												<li><strong>Affiliate:</strong> <?php echo $details['EventRegistration']['affiliate']; ?></li>
												<li><strong>Event Date:</strong> <?php echo formatDate($details['Event']['start_date']); ?></li>
												<li><strong>Event Time:</strong> <?php echo $details['Event']['start_time']; ?></li>
											</ul>	
											
											
										</div>
										<div class="payment_map">
											<div class="right-map-img" id="map-canvas" style="height:180px;">
						                    	<!--<img src="<?php echo $this->webroot; ?>images/map2.jpg" alt="" />-->
						                    </div>
										</div>
									<div class="clear"></div>		
									<div class="payment_details">	
										<h3>Payment Details:</h3>
										
										<ul>
											<li><strong>Name:</strong> <?php echo $details['Payment']['name_on_card']; ?></li>
											<li><strong>Amount:</strong> <?php echo '$'.$details['Payment']['amount']; ?></li>
											<li><strong>Card:</strong> <?php echo $details['Payment']['brand'].' '. $details['Payment']['funding']; ?></li>
											<li><strong>Card No.:</strong> <?php echo 'XXXXXXXXXXXX'.$details['Payment']['last_four_digit']; ?></li>
											<li><strong>Payment Status:</strong> <?php if($details['Payment']['status'] == 'success') echo 'Received'; else echo 'Failure'; ?></li>
											<li><strong>Payment Date:</strong> <?php echo formatDate($details['Payment']['created']); ?></li>
										</ul>
																				
									</div>	
									
									<h3>Share this with your friends:</h3>
									<div style="margin-top:15px;">
										<?php $st_url = SITE_URL.'events/event_details/'.$details['EventRegistration']['event_id']; ?>
			                       			<span class='st_sharethis_large' displayText='ShareThis' st_url="<?php echo $st_url; ?>"></span>
											<span class='st_facebook_large' displayText='Facebook' st_url="<?php echo $st_url; ?>"></span>
											<span class='st_twitter_large' displayText='Tweet' st_url="<?php echo $st_url; ?>"></span>
											<span class='st_linkedin_large' displayText='LinkedIn' st_url="<?php echo $st_url; ?>"></span>
											<span class='st_pinterest_large' displayText='Pinterest' st_url="<?php echo $st_url; ?>"></span>
											<span class='st_email_large' displayText='Email' st_url="<?php echo $st_url; ?>"></span>
			                       		</div>
									
										<span class="buttons-section clear fLeft"><a href="<?php echo $this->webroot.'events'; ?>" class="blue_btn fLeft"> Continue </a></span>
										<div class="clear"></div>
					 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>					
					 					
									</div>
									<div class="clear"></div>
										
								</div>
							</div>
							<div class="clear"></div>
						</div><!--.left-column-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->
<script type="text/javascript">

var geocoder;
var map;
initialize_map();


function initialize_map() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    minZoom: 3,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);  
  codeAddress('<?php echo $details['Event']['location']; ?>');
}

function codeAddress(address) {
  
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize_map);
</script>