<?php
$this->Paginator->options(array (
    'update' => '#main-container',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array ('buffer' => true)),
    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array ('buffer' => true)),
));
?>
<div class="faqs index">
    <h2><?php echo __('Manage Breeds');?></h2>
    <p class="top15 gray12">
    <?php 
    echo $this->Session->flash('success');
    echo $this->Session->flash('error');
    ?>
    </p>
    
	<?php
	echo $this->Form->create(
			null, array(
				'url' => array('controller' => 'breeds', 
					'action' => 'admin_manage'),
					'inputDefaults' => array(
							'label' => false,
							'div' => false
						),
				'type' => 'get',
				'name' => 'search_form'
			)
		);
	?>
	<div class="row mtop15">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
			<tr valign="top">
			  <td align="left" class="searchbox">
				<div class="">
				
					<table cellspacing="0" cellpadding="4" border="0">
						<tr valign="top">
							<td valign="middle" align="left" width="200">
								<strong><?php echo __('Keyword :'); ?></strong>
									<?php
									if ( !empty($this->request->query['keyword']) )
									{
										$keyword = $this->request->query['keyword'];
									}
									else
									{
										$keyword = '';
									}
									echo $this->Form->input(null, array(
											'type'=>'text',
											'name'=>'keyword',											
											'class' => 'input',
											'id' => 'keyword',
											'style' => 'width: 200px;',
											'div' =>false,
											'value' => $keyword
									));
								?>
							</td>
							
							<td valign="middle" align="left" style="width:100%">
								<div class="black_btn2 mtop15">
									<span class="upper">
										<input type="submit" value="Search" name="">
									</span>
								</div>
								 <div class="floatright mtop15" style="">
								<?php
								echo $this->Html->link('<span>'.__('Add New Breed').'</span>', array('controller' => 'breeds','action' => 'add','admin' => true),array('class'=>'black_btn','escape'=>false));
	?>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</td>
		  </tr>
		</table>	
	</div>
	<?php echo $this->Form->end(); ?>
	
    <div class="row mtop30">
	<?php echo $this->Form->create('Breed', array('controller'=>'breeds', 'action'=>'delete_multiple','admin'=>true));?>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
            <tr>
				<th align="left"><?php echo $this->Paginator->sort('id');?></th>
				<th align="left"><?php echo 'Image'; ?></th>
				<th align="left"><?php echo $this->Paginator->sort('name');?></th>
				<th align="left"><?php echo $this->Paginator->sort('litter_size');?></th>				
				<th align="left"><?php echo $this->Paginator->sort('created');?></th>
				
				<th class="actions"><?php echo __('Actions');?></th>
            </tr>
	    <?php
			foreach ($breeds as $nw): ?>
			<tr>
				<td align="left" valign="middle"><?php echo h($nw['Breed']['id']); ?>&nbsp;</td>
				<td align="left" valign="middle">
					<img src="<?php if(!empty($nw['BreedImages']))
										echo DISPLAY_BREED_DIR.$nw['BreedImages'][0]['filename'];
									else
										echo $this->webroot.'images/image_not_available.jpg';			
							?>" alt="" width="120" height="120"/>
			    </td>
				<td align="left" valign="middle"><?php echo $nw['Breed']['name']; ?></td>
				<td align="left" valign="middle"><?php echo $nw['Breed']['litter_size']; ?></td>
				<td align="left" valign="middle"><?php echo format_date($nw['Breed']['created']);  ?></td>
				<td align="center">
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'view.gif'), array('action' => 'admin_view', $nw['Breed']['id']),array('escape'=>false)); ?>&nbsp;
				<?php //echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'admin_edit', $nw['Breed']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'admin_delete', $nw['Breed']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $nw['Breed']['id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr align='right'>
				<td colspan="9" align="left" class="bordernone">
					<div class="floatleft mtop7">
						<div class="pagination">
						<?php
						echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
						echo $this->Paginator->numbers(array('separator' => ''));
						echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
						?>
						</div>
					</div>
				</td>
			</tr>
        </table>
		<?php echo $this->Form->end();?>
    </div>
</div>
<?php
echo $this->Js->writeBuffer();
?>