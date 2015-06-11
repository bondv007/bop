<div class="ageGroups view">
<h2><?php echo __('Age Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ageGroup['AgeGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Age Group'); ?></dt>
		<dd>
			<?php echo h($ageGroup['AgeGroup']['age_group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ageGroup['AgeGroup']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Age Group'), array('action' => 'edit', $ageGroup['AgeGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Age Group'), array('action' => 'delete', $ageGroup['AgeGroup']['id']), null, __('Are you sure you want to delete # %s?', $ageGroup['AgeGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Age Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Age Group'), array('action' => 'add')); ?> </li>
	</ul>
</div>
