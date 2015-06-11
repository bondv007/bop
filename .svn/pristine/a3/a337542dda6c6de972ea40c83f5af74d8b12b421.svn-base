<?php if(!empty($posts)){ 
		foreach($posts as $nws) {
	?>
<li class="noBrdr" onclick="window.open('<?php echo $nws['link']; ?>')">
	<?php if(isset($nws['picture'])){ ?>
	<div class="msg-img"> <img src="<?php echo $nws['picture']; ?>" alt=""></div>
	<?php } ?>
	<div class="msg-cont">
		<?php if(isset($nws['name'])){ ?>  
			<span class="row"> <a href="<?php echo $nws['link']; ?>"> <?php echo $nws['name']; ?> </a></span>
		<?php }
			if(isset($nws['message'])){
		 ?>
		<p><?php echo $nws['message']; ?></p>
		<?php } ?>
		<b><?php echo date('d-M-Y',$nws['created']); ?></b>
	</div>
</li>
<?php }}else{ ?>
	
<li style="height: 100px; text-align: center; margin-top: 50px;">No news feeds available</li>	
<?php } ?>	
