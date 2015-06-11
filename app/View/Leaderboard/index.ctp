<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
			<div class="filter-search row">
				<h2>Search Filters</h2>
				<form id="leaderboard_filter" name="leaderboard_form" action="#" onsubmit="return false;">
					
					<div class="colum">
						<select id="ev_type" name="event_type">
							<option value="">Event Type</option>
							<option value="competition">Competition</option>
							<option value="throwdown">Throwdown</option>
							<option value="challenge">Challenges</option>
						</select>						
					</div>
					
					<div class="colum">
						<select id="ev_country" name="event_country">
							<option value="">Select Country</option>
							<?php if(!empty($countries)){ 
									foreach($countries as $country){
								?>
								<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
							<?php }} ?>
						</select>						
					</div>
					<div class="colum">
						<select id="ev_affiliate" name="event_affiliate">
							<option value="">Affiliate</option>
							<?php if(!empty($affiliates)){ 
									foreach($affiliates as $aff_key => $aff_data){
								?>
								<option value="<?php echo $aff_key; ?>"><?php echo $aff_data; ?></option>
							<?php }} ?>
						</select>						
					</div>                     															 
					<div class="colum blue">
						 <button onclick="filter_leaderboard();" type="submit" style="float:right;">Search</button>
					</div>					
				</form>				
			</div>
		</div>
	</section>
	<!-- Slider End -->
	
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				
				<div class="row">
					<div class="list-tabing">
						<!--<div class="tabrow">
							<ul>
								<li><a href="javascript://" onclick="get_event_data('competition');">Competitions</a></li>
								<li><a href="javascript://" onclick="get_event_data('throwdown');">Throwdowns</a></li>
								<li><a href="javascript://" onclick="get_event_data('challenge');">Challenges</a></li>
							</ul>
						</div>-->						
						<div class="tab-content leaderboard_data" id="event_data">
							<div id="competitions" class="tab-content-list"></div>
						</div>					
					</div>					
			</div>
		</div>
	</section>
	<!-- MId Section End -->

<!-- tab jquery --> 
<script type="text/javascript">
$(document).ready(function(){
		
	get_event_data();
});

function get_event_data()
{
	$('#event_data').html('<div style="height:300px; text-align:center; margin-top:100px;"><img src="<?php echo $this->webroot.'images/loading.gif'; ?>"/></div>');
	$.get('<?php echo $this->webroot.'leaderboard/event_data'; ?>', function(data){
		$('#event_data').html(data);
	});
}

function filter_leaderboard()
{
	$('#event_data').html('<div style="height:300px; text-align:center; margin-top:100px;"><img src="<?php echo $this->webroot.'images/loading.gif'; ?>"/></div>');
	$.post('<?php echo $this->webroot.'leaderboard/event_data'; ?>', $('#leaderboard_filter').serialize(), function(data){
		$('#event_data').html(data);
	});
		
	return false;
}
</script>
