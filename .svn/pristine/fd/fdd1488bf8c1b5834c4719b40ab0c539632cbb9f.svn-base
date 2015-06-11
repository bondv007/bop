<div class="faqs index">
    <h2><?php echo __('Manage Opt ins');?></h2>
    <p class="top15 gray12">
    <?php 
    echo $this->Session->flash('success');
    echo $this->Session->flash('error');
    ?>
    </p>
    <?php
	echo $this->Form->create(
			null, array(
				'url' => array('controller' => 'optins', 
					'action' => 'admin_index'),
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
				<div class="floatleft">
				
					<table cellspacing="0" cellpadding="4" border="0">
						<tr valign="top">
							<td valign="middle" align="left" width="200" >
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
								 <div class="floatright mtop15" style=" margin-left: 880px !important;">
								<?php
								//echo $this->Html->link('<span>'.__('Add User').'</span>', array('controller' => 'users','action' => 'add','admin' => true),array('class'=>'black_btn floatRight','escape'=>false));
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
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
            <tr>
				<th align="left"><?php echo $this->Paginator->sort('id');?></th>
				<th align="left"><?php echo $this->Paginator->sort('school_name');?></th>
				<th align="left"><?php echo $this->Paginator->sort('school_id');?></th>
				<th align="left"><?php echo $this->Paginator->sort('sport_id');?></th>
				<th align="left"><?php echo $this->Paginator->sort('gender');?></th>
				<th align="left"><?php echo $this->Paginator->sort('email');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
            </tr>
	    <?php
			foreach ($optins as $data): ?>
			<tr>
				<td align="left" valign="middle"><?php echo h($data['Optin']['id']); ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $data['Optin']['name']; ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $data['schools']['school_name']; ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $data['sports']['name']; ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $data['Optin']['gender']; ?>&nbsp;</td>
				<td align="left" valign="middle"><?php echo $data['Optin']['email']; ?>&nbsp;</td>
				<td align="center">
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'view.gif'), array('action' => 'view', $data['Optin']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array('action' => 'edit', $data['Optin']['id']),array('escape'=>false)); ?>&nbsp;
				<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'delete', $data['Optin']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $data['Optin']['id'])); ?>
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
<?php
echo $this->Js->writeBuffer();
?>
