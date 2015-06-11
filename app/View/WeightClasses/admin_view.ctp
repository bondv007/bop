<div class="weightClasses view">
<h2><?php echo __('Weight Class'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($weightClass['WeightClass']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($weightClass['WeightClass']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($weightClass['WeightClass']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Weight Class'), array('action' => 'edit', $weightClass['WeightClass']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Weight Class'), array('action' => 'delete', $weightClass['WeightClass']['id']), null, __('Are you sure you want to delete # %s?', $weightClass['WeightClass']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Weight Classes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weight Class'), array('action' => 'add')); ?> </li>
	</ul>
</div>
