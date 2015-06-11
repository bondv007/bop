<?php
$this->Paginator->options(array (
    'update' => '#main-container',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array ('buffer' => true)),
    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array ('buffer' => true)),
));
?>
<div class="faqs index">
    <h2><?php echo __('Manage Tutorials');?></h2>
    <p class="top15 gray12">
    <?php 
    echo $this->Session->flash('success');
    echo $this->Session->flash('error');
    ?>
    </p>
    <p class="floatright">
	<?php
	echo $this->Html->link('<span>'.__('Add Tutorial').'</span>', array('controller' => 'tutorials','action' => 'add','admin' => true),array('class'=>'black_btn','escape'=>false));
	?>
	</p>
    <div class="row mtop30">
	<?php echo $this->Form->create('Tutorial', array('controller'=>'tutorials', 'action'=>'delete_multiple','admin'=>true));?>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
            <tr>
				<th align="left"><?php echo $this->Paginator->sort('id');?></th>
				<th align="left"><?php echo $this->Paginator->sort('image');?></th>
				<th align="left"><?php echo $this->Paginator->sort('TutorialCategory.name','Category');?></th>
				<th align="left"><?php echo $this->Paginator->sort('title');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
            </tr>
	    <?php
			foreach ($tutorials as $tutorial): ?>
			<tr>
				<td align="left" valign="middle"><?php echo h($tutorial['Tutorial']['id']); ?>&nbsp;</td>
				<td align="left" valign="middle">
					<img src="<?php if(!empty($tutorial['Tutorial']['filename']))
										echo create_thumb_imgname($tutorial['Tutorial']['filename'], 200, 140, DISPLAY_TUTORIAL_DIR); 
									else
										echo $this->webroot.'images/image_not_available.jpg';			
							?>" alt="" width="120" height="120"/>
			    </td>
				<td align="left" valign="middle"><?php echo $tutorial['TutorialCategory']['name']; ?></td>
				<td align="left" valign="middle"><?php echo $tutorial['Tutorial']['title']; ?></td>
				<td align="center">
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'view.gif'), array('action' => 'admin_view', $tutorial['Tutorial']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'admin_edit', $tutorial['Tutorial']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'admin_delete', $tutorial['Tutorial']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $tutorial['Tutorial']['id'])); ?>
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