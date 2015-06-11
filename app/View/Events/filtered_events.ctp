<?php if(!empty($events)){ 
		$i=1;
		foreach($events as $ev){ 
	?>
<div class="colum <?php if(($i % 4) == 0) { echo 'no-lm'; }?>">
	<div class="image">
		<div class="black-strip"><?php echo $ev['Event']['title']; ?> </div>
		<a href="<?php echo $this->webroot.'events/event_details/'.$ev['Event']['id']; ?>"><img src="<?php echo $this->webroot.'files/events/'.$ev['Event']['id'].'/'.$ev['Event']['picture']; ?>" alt="" width="267" height="223"  style="height:223px;" /></a>
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
		//$url=array('controller'=>$this->params['controller'],'action'=>'filter_events');
		$url=$this->passedArgs;
	}
	$this->Paginator->options(array(
				'url' => $url,
				'update' => '.event_list',
				'data' => http_build_query($data),
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
<?php
	echo $this->Js->writeBuffer();
?>		
