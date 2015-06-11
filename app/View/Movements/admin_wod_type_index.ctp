<?php
$this->Paginator->options(array (
    'update' => '#main-container',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array ('buffer' => true)),
    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array ('buffer' => true)),
));
?>
<div class="faqs index">
    <h2><?php echo __('Manage WOD types');?></h2>
    <p class="top15 gray12">
    <?php 
    echo $this->Session->flash('success');
    echo $this->Session->flash('error');
    ?>
    </p>
    <p class="floatright">
	<?php
	echo $this->Html->link('<span>'.__('Add WOD Type').'</span>', array('controller' => 'movements','action' => 'wod_type_add','admin' => true),array('class'=>'black_btn','escape'=>false));
	?>
	</p>
    <div class="row mtop30">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
            <tr>
				<th align="left"><?php echo $this->Paginator->sort('id');?></th>
				<th align="left"><?php echo $this->Paginator->sort('title');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
            </tr>
	    <?php
			foreach ($wod_types as $type): ?>
			<tr>
				<td align="left" valign="middle"><?php echo h($type['WodType']['id']); ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $type['WodType']['title']; ?>&nbsp;</td>
				<td align="center">
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'wod_type_edit', $type['WodType']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'wod_type_delete', $type['WodType']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $type['WodType']['id'])); ?>
				</td>
			</tr>
			<?php 
				if(isset($type['children']) && count($type['children']) > 0) { 
					foreach($type['children'] as $type_data) {
				?>
					<tr>
						<td align="left" valign="middle"><?php echo $type_data['WodType']['id']; ?></td>
						<td align="left" valign="middle"><span class="blue">---> <?php echo $type_data['WodType']['title']; ?></span></td>
						<td align="center">
							<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'wod_type_edit', $type_data['WodType']['id']),array('escape'=>false)); ?>&nbsp;
							<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'wod_type_delete', $type_data['WodType']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $type_data['WodType']['id'])); ?>
						</td>
					</tr>
				<?php }
				} ?>
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
    </div>
</div>
<?php
echo $this->Js->writeBuffer();
?>