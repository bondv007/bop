<div class="faqs index">
	<h2><?php echo __('Age Groups'); ?></h2>
	
	<p class="top15 gray12">
    <?php 
    echo $this->Session->flash();
       echo $this->Session->flash('success');
    echo $this->Session->flash('error'); 
   
    ?>
    </p>

	<div class="row mtop15">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
			<tr valign="top">
			  <td align="left" class="searchbox">
				<div class="">
				
					<table cellspacing="0" cellpadding="4" border="0">
						<tr valign="top">
							<td>&nbsp;</td>
							<td valign="middle" align="left" style="width:100%">
								
								 <div class="floatright mtop15" style=" margin-left: 880px !important;">
								<?php
								echo $this->Html->link('<span>'.__('Add Age Group').'</span>', array('controller' => 'AgeGroups','action' => 'add','admin' => true),array('class'=>'black_btn floatRight','escape'=>false));
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

	
	 <div class="row mtop30">
	<table cellpadding="0" cellspacing="0" class="listing" width="100%" align="center">
	<tr>
			<th align="left"><?php echo $this->Paginator->sort('id'); ?></th>
			<th align="left"><?php echo $this->Paginator->sort('age_group'); ?></th>
			<th align="left"><?php echo $this->Paginator->sort('created'); ?></th>
			<th align="left" class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ageGroups as $ageGroup): ?>
	<tr>
		<td><?php echo h($ageGroup['AgeGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($ageGroup['AgeGroup']['age_group']); ?>&nbsp;</td>
		<td><?php echo h($ageGroup['AgeGroup']['created']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'edit', $ageGroup['AgeGroup']['id']),array('escape'=>false)); ?>
			<?php echo $this->Form->postLink($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'delete', $ageGroup['AgeGroup']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $ageGroup['AgeGroup']['id'])); ?>
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
	</div>
	
	
</div>

