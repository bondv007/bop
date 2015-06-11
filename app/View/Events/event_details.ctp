<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "837db686-bb47-428d-a2d8-a5c5fe0ecac3", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php echo $this->Html->script(array('countdown')); ?>	
<style>
.left-crsft img{ max-width: 394px; max-height: 234px;}
</style>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
 
	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid events-map">
			<div class="row">
				<div class="evnt-dtl">
                	<div class="left-crsft">
                    	<div class="left-side">
                                <h1> <?php echo $event['Event']['title']; ?> </h1>
                                <div class="img_box">
                                	<img src="<?php echo $this->webroot.'files/events/'.$event['Event']['id'].'/'.$event['Event']['picture']; ?>" alt="<?php echo $event['Event']['title']; ?>" />
                       			</div>
                       		<div>
                       			<span class='st_sharethis_large' displayText='ShareThis'></span>
								<span class='st_facebook_large' displayText='Facebook'></span>
								<span class='st_twitter_large' displayText='Tweet'></span>
								<span class='st_linkedin_large' displayText='LinkedIn'></span>
								<span class='st_pinterest_large' displayText='Pinterest'></span>
								<span class='st_email_large' displayText='Email'></span>
                       		</div>	
                        </div>        
                        
                        <div class="inner-left-crsft">
                                <div class="timer countdown">
									
                                   <div class="colm">
                                   		<h4 class="timeRefDays"> DAYS </h4>
                                        <div class="num days">00</div>                                        
                                   </div>
                                   
                                   <span class="dots"> :</span>
                                   
                                   <div class="colm">
                                   		<h4 class="timeRefHours"> HRS </h4>
                                        <div class="num hours">00</div>
                                   </div>
                                   
                                   <span class="dots"> :</span>
                                   
                                   <div class="colm">
                               		<h4 class="timeRefMinutes"> Min </h4>
                                        <div class="num minutes">00</div>
                                   </div>
                                </div>
                                
                                <div class="rgistrd"> 
                                	<h3> <?php echo $event['Event']['number_of_registrations']; ?> </h3>
                                    <h5> Total Registered </h5>
                                    
                                    <?php if ( $event['Event']['start_date'] > date('Y-m-d') ) { ?>
                                    <div class="buttns" style="text-align:center;"> 
                                    	
                                    	<?php if($this->Session->read('Auth.User.id')){ ?>
											
											<input class="rgist-btn follow_event" style="<?php if(isset($is_follow)) echo 'display:none;'?>" type="button" value="Follow" onclick="follow_event('<?php echo $this->webroot.'events/follow'; ?>','<?php echo $this->Session->read('Auth.User.id')?>','<?php echo $event['Event']['id']; ?>');">
                                    	
                                    		<input class="rgist-btn unfollow_event" style="<?php if(!isset($is_follow)) echo 'display:none;'?>" type="button" value="Unfollow" onclick="unfollow_event('<?php echo $this->webroot.'events/unfollow'; ?>','<?php echo $this->Session->read('Auth.User.id')?>','<?php echo $event['Event']['id']; ?>');">
                                    	
                                    	<?php } ?>
                                    	
                                    	<input type="button" value="Register" onclick="window.location='<?php echo $this->webroot.'events/event_registration/'.$event['Event']['id']; ?>'" class="rgist-btn" />
                                    	
                                    </div>
                                    <?php } ?>
                                </div>
                    	</div>
                    
						<div class="clearfix"></div>
                	</div>
                    
                    <div class="right-crsft">
                    	<ul>
                        	<li class="list-heading"> PRICING </li>
                        	
                        	<?php if(!empty($event['Eventprice'])){ 
									
									foreach($event['Eventprice'] as $price) {
							?>
                            <li> <?php if($price['date'] == date('Y-m-d')) echo 'Today: '; else echo formatDate($price['date']).':'; ?> <span>&nbsp;&nbsp;&nbsp;<?php echo '$'.$price['price']; ?> </span></li>
                                                       
                            <?php }} ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
	</section>
	<!-- Slider End -->
	
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid event-colum">
			<div class="body-content-mn row mt10">
				
				<div class="row">
                	<div class="left-container" style="word-wrap:break-word;">
                    	<?php echo '<h2>Event Date: '. formatDate($event['Event']['start_date']).'</h2><br>'; ?>
                    	<?php echo '<h2>Event Details: '. $event['Event']['details'].'</h2><br>'; ?>
                    	
                    		
                    	<?php 
                    		echo '<h2>Event Wod: </h2>';
                    		if ( !empty($event['EventWod']) )
                    		{
                    			$allwods = array();
                    			foreach($event['EventWod'] as $ewod)
                    			{
                    				if (!in_array($ewod['Wod']['id'], $allwods))
									{
										echo '<strong>'.$ewod['Wod']['title'].'</strong>'. ' - '.strip_tags($ewod['Wod']['description']);
										echo '<br><br>';
										$allwods[] = $ewod['Wod']['id'];
									}                    				
                    			}
                    		}
                    	?>                    	
                    	
                    </div>
                    
                    <div class="right-map-img" id="map-canvas" style="height:269px;">
                    	<!--<img src="<?php echo $this->webroot; ?>images/map2.jpg" alt="" />-->
                    </div>
                    <div class="clearfix"></div>
				</div>
			</div>
        </div>
	</section>
	<!-- MId Section End -->

<script type="text/javascript">

var geocoder;
var map;

$(document).ready(function () {
	function e() {$event
		var e = new Date();
		e.setDate(e.getDate() + 60);
		dd = e.getDate();
		mm = e.getMonth() + 1;
		y = e.getFullYear();
		futureFormattedDate = mm + "/" + dd + "/" + y;
		return futureFormattedDate
	}
	
	initialize_map();
	
	$(".colm").countdown({
		date: "<?php echo formatDateTime($event['Event']['start_date'].' '.$event['Event']['start_time'],'d M Y H:i:s'); ?>", 
		format: "on"
	});
});


function initialize_map() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    minZoom: 3,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);  
  codeAddress('<?php echo $event['Event']['location']; ?>');
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