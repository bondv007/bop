<?php
$this->Paginator->options(array (
    'update' => '#main-container',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array ('buffer' => true)),
    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array ('buffer' => true)),
));
?>
<div class="faqs index">
    <h2><?php echo __('Manage categories');?></h2>
    <p class="top15 gray12">
    <?php 
    echo $this->Session->flash('success');
    echo $this->Session->flash('error');
    ?>
    </p>
    <p class="floatright">
	<?php
	echo $this->Html->link('<span>'.__('Add Category').'</span>', array('controller' => 'categories','action' => 'add','admin' => true),array('class'=>'black_btn','escape'=>false));
	?>
	</p>
    <div class="row mtop30">
	<?php echo $this->Form->create('Faq', array('controller'=>'faqs', 'action'=>'delete_multiple','admin'=>true));?>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
            <tr>
				<th align="left"><?php echo $this->Paginator->sort('id');?></th>
				<th align="left"><?php echo $this->Paginator->sort('title');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
            </tr>
	    <?php
			foreach ($categories as $category): ?>
			<tr>
				<td align="left" valign="middle"><?php echo h($category['Category']['id']); ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $category['Category']['title']; ?>&nbsp;</td>
				<td align="center">
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'view.gif'), array('action' => 'view', $category['Category']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'edit', $category['Category']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'delete', $category['Category']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
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