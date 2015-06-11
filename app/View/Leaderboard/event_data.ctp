<style>
.list-tabing li a{ line-height: 19px;}
</style>
<div id="competitions" class="tab-content-list">
	<div class="row events_row">	
		<div class="register-columns">
	<?php if(!empty($result)){		
			foreach($result as $event_data){				
				foreach($event_data as $event_name => $data){ 	
	 ?>
	
		<div class="column">
				<div class="header">
					<h3><?php echo $event_name; ?></h3>								
				</div>														
			</div><!--.left-column-->
			
			
		<?php foreach($data as $division_name => $division_data){ 
				foreach($division_data as $div_type => $div_type_data){				
					foreach($div_type_data as $weight_class => $weight_class_data){ 
			?>
			
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="leaderboard_table">
			<tr class="highlight">
				<th scope="col" colspan="5"><?php echo $division_name.' | '.$div_type.' | '.$weight_class; ?></th>
			</tr>
			<tr>		
				<th scope="col" width="50">Placing</th>
				<th scope="col">Competitor</th>
				<th scope="col">Division</th>
				<th scope="col">Final Score</th>
				<th scope="col">WOD Score(s)</th>
			</tr>	
			
		<?php $pos = 1; foreach($weight_class_data as $board){  ?>				
				
				<tr>
					<td><?php echo $pos; ?></td>
					<td><?php echo $board['user_name']; ?></td>
					<td><?php echo $board['division_type']; ?></td>
					<td><?php echo $board['score']; ?></td>
					<td><a href="javascript://" onclick="display_wods('<?php echo $board['registration_id']; ?>');">View</a></td>					
				</tr>				
			
			<?php $pos++; } ?>
			
			</table>
		
		<?php }}} ?>
		
	<?php }}}else{ ?>
		<div style="text-align: center; margin-top:100px;">No results found!</div>
	<?php } ?>	
	
	<?php if(!empty($result)){	
							
						
				if(!isset($url)){
					$url=array('controller'=>$this->params['controller'],'action'=>'event_data');
					//$url=$this->passedArgs;
					
				}
				$this->Paginator->options(array(
							'url' => $url,
							'update' => '.events_data',
							'data' => http_build_query($request_data),
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
			<?php } ?>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function display_wods(reg_id)
{
	$.fancybox.open({
		'type' : 'ajax',
		'href' : '<?php echo $this->webroot.'leaderboard/display_wod_scores/'; ?>'+reg_id,
		'autoSize' : false,
		'closeBtn' : false, 
		'width' : '599',
		'height' : '300'
	});	
}

</script>

<?php echo $this->Js->writeBuffer(); ?>