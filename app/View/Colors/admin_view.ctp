<div class="products row">
    <div class="floatleft mtop10"><h1><?php  echo __('View Pet Color');?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage Pet Color').'</span>', array('controller' => 'colors','action' => 'manage','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
</div>

<div align="center" class="whitebox mtop15 viewMode">
    <table cellspacing="2" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Id'); ?></strong></td>
			<td align="left"><?php echo h($color['PetColors']['id']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Image'); ?></strong></td>
			<td align="left"><img src="<?php echo create_thumb_imgname($color['PetColors']['filename'], 200, 140, DISPLAY_COLORS_DIR); ?>" /> 
				</td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Color Name'); ?></strong></td>
			<td align="left"><?php echo $color['PetColors']['name']; ?></td>
		</tr>
		
		
		
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Created On'); ?></strong></td>
			<td align="left"><?php echo format_date($color['PetColors']['created']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Last Modified'); ?></strong></td>
			<td align="left"><?php if($color['PetColors']['modified'] != '0000-00-00 00:00:00' &&
													 !empty($color['PetColors']['modified']))
										echo format_date($color['PetColors']['modified']);
									else 
										echo 'N/A';		
								 ?></td>
		</tr>
    </table>
</div>
