<?php ?>	
<style>
#successMessage{ margin-bottom: 0 !important;}    
.pagination{ text-align:right}
.pagination ul span{ padding-right: 5px;}
.tab-content td{ vertical-align: middle; word-break: break-all;}
</style>

						
	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
			<div class="filter-search row">
				<?php if($this->Session->check('Auth.User')){ ?>
				 <div class="blue fRight">
                	<button type="submit" onclick="window.location.href='<?php echo $this->webroot.'users'; ?>'">Back to Dashboard</button>
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
				<?php 
					echo $this->Session->flash('success');
					echo $this->Session->flash('error');
					echo $this->Session->flash();
				?>
				
			<input type="hidden" id="key" value="<?php echo $key; ?>" />
			
			<div class="row">	
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3>Affiliates</h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="affiliate_listing"></div>	
			</div>		
			
			<div class="row">	
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3>Athletes</h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="athlete_listing"></div>	
			</div>	
			
			<div class="row">	
					<div class="register-columns">
					<div class="column">
							<div class="header">
								<h3>Events</h3>								
							</div>														
						</div><!--.left-column-->
					</div>
					<div class="event_listing"></div>	
			</div>			
				
			
			
			
				
		</div>
	</section>
	<!-- MId Section End -->

<script type="text/javascript">

$(document).ready(function(){
	search_affiliates();
	search_athletes();
	search_events();
});

function search_affiliates(){
	$.post('<?php echo $this->webroot.'info/search_affiliate'; ?>',{ key: $('#key').val() }, function(data){
		$('.affiliate_listing').html(data);	
	});
}

function search_athletes(){
	$.post('<?php echo $this->webroot.'info/search_athlete'; ?>',{ key: $('#key').val() }, function(data){
		$('.athlete_listing').html(data);	
	});
}

function search_events(){
	$.post('<?php echo $this->webroot.'info/search_event'; ?>',{ key: $('#key').val() }, function(data){
		$('.event_listing').html(data);	
	});
}
</script>


