<div class="products row">
    <div class="floatleft mtop10"><h1><?php  echo __('View Tutorial');?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Tutorials').'</span>', array('controller' => 'tutorials','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
</div>

<div align="center" class="whitebox mtop15 viewMode">
    <table cellspacing="2" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Id'); ?></strong></td>
			<td align="left"><?php echo h($tutorial['Tutorial']['id']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Image'); ?></strong></td>
			<td align="left"><img src="<?php echo create_thumb_imgname($tutorial['Tutorial']['filename'], 200, 140, DISPLAY_TUTORIAL_DIR); ?>" /> 
				</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Category'); ?></strong></td>
			<td align="left"><?php echo $tutorial['TutorialCategory']['name']; ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Title'); ?></strong></td>
			<td align="left"><?php echo $tutorial['Tutorial']['title']; ?></td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Content'); ?></strong></td>
			<td align="left"><?php echo $tutorial['Tutorial']['content']; ?></td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Created On'); ?></strong></td>
			<td align="left"><?php echo date('Y-m-d H:i:s', strtotime($tutorial['Tutorial']['created'])); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Last Modified'); ?></strong></td>
			<td align="left"><?php if($tutorial['Tutorial']['modified'] != '0000-00-00 00:00:00' &&
													 !empty($tutorial['Tutorial']['modified']))
										echo date('Y-m-d H:i:s', strtotime($tutorial['Tutorial']['modified']));
									else 
										echo 'N/A';		
								 ?></td>
		</tr>
    </table>
</div>
