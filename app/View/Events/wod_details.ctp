
<p class="underline"> <?php echo strip_tags($wod['Wod']['description']); ?> </p>
		
	<?php
		$m = 0;
		foreach($wod['WodMovement'] as $mov){ 									
			if(!empty($mov['Movement'])) { 
		?>		
		<ul class="inner-select">
			<li>
				<label>  Movement : <?php echo $mov['Movement']['title']; ?>	</label>
			</li>
			<li>
				<label style="float:left;">
				<?php echo $mov['type'];
						if(!empty($mov['sub_type']))
						{
							echo '(in '.$mov['sub_type'].')';	
						}	
					?>	
				 </label>
				
				 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $ctr; ?>][Movement][<?php echo $m; ?>][wod_id]" value="<?php echo $wod['Wod']['id']; ?>" />
				 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $ctr; ?>][Movement][<?php echo $m; ?>][division_type]" value="<?php echo $division; ?>" />
				 <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $ctr; ?>][Movement][<?php echo $m; ?>][division_sex]" value="<?php echo $division_sex; ?>" />
				  <input type="hidden" name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $ctr; ?>][Movement][<?php echo $m; ?>][movement_id]" value="<?php echo $mov['Movement']['id']; ?>" />
				 <input type=text name="data[Wod][<?php echo $div; ?>][WodNum][<?php echo $ctr; ?>][Movement][<?php echo $m; ?>][value]" class="required number wod_values" />
				
			</li>
		</ul>
		<div class="clear"></div>
		<!--<span class="plus"> </span>-->
		<?php $m++; }} ?>
		
