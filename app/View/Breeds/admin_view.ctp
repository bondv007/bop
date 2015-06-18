<div class="products row">
    <div class="floatleft mtop10"><h1><?php  echo __('View News');?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage News').'</span>', array('controller' => 'news','action' => 'manage','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
</div>

<div align="center" class="whitebox mtop15 viewMode">
    <table cellspacing="2" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Id'); ?></strong></td>
			<td align="left"><?php echo h($news['News']['id']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Image'); ?></strong></td>
			<td align="left"><img src="<?php echo create_thumb_imgname($news['News']['filename'], 200, 140, DISPLAY_NEWS_DIR); ?>" /> 
				</td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Title'); ?></strong></td>
			<td align="left"><?php echo $news['News']['title']; ?></td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Content'); ?></strong></td>
			<td align="left"><?php echo $news['News']['content']; ?></td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Status'); ?></strong></td>
			<td align="left"><?php if($news['News']['status'] == 0 ) 
										echo __('Unpublished');
								else if($news['News']['status'] == 1)
										echo __('Published');	
						?></td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Created On'); ?></strong></td>
			<td align="left"><?php echo format_date($news['News']['created']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Last Modified'); ?></strong></td>
			<td align="left"><?php if($news['News']['modified'] != '0000-00-00 00:00:00' &&
													 !empty($news['News']['modified']))
										echo format_date($news['News']['modified']);
									else 
										echo 'N/A';		
								 ?></td>
		</tr>
    </table>
</div>
