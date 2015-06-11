<div class="faqs index">
    <h2><?php echo __('Manage affiliate of the month for Year - '.$year);?></h2>
    <p class="top15 gray12">
    <?php 
    	echo $this->Session->flash('success');
    	echo $this->Session->flash('error');
    ?>
    </p>
    <?php
	echo $this->Form->create(
			null, array(
				'url' => array('controller' => 'affiliate', 
					'action' => 'admin_affiliate_of_month'),
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
								<strong><?php echo __('Select Year :'); ?></strong>
									<?php
										$options = array();
										$cur_year = date('Y');
										
										for($i = $cur_year; $i>=2014; $i--)
										{
											$options[$i] = $i;
										}
									echo $this->Form->input(null, array(
											'type'=>'select',
											'class' => 'input',
											'empty' => 'Please select',
											'name' => 'year',
											'options' => $options,
											'style' => 'width: 200px;',
											'selected' => $cur_year
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
								echo $this->Html->link('<span>'.__('Add affiliate of the month').'</span>', array('controller' => 'affiliate','action' => 'admin_add_affiliate_of_month'),array('class'=>'black_btn floatRight','escape'=>false));
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
				<th align="left">S.No.</th>
				<th align="left">Month</th>
				<th align="left">Photo</th>
				<th align="left">Affiliate Name</th>
				<th align="left">First Name</th>
				<th align="left">Last Name</th>
				<th align="left">Region</th>
				<th class="actions"><?php echo __('Actions');?></th>
            </tr>
	    <?php $i=1;
			foreach ($data as $dat): ?>
			<tr>
				<td align="left" valign="middle"><?php echo $i; ?></td>
				<td align="left" valign="middle"><?php echo date('F',strtotime($dat['PersonOfMonth']['date'])); ?></td>
				<td align="left" valign="middle"><img src="<?php echo $this->webroot.'files/'.$dat['User']['id'].'/thumb_'.$dat['User']['photo']; ?>"></td>
				<td align="left" valign="middle"><?php echo $dat['User']['other_name']; ?></td>
				<td align="left" valign="middle"><?php echo $dat['User']['first_name']; ?></td>
				<td align="left" valign="middle"><?php echo $dat['User']['last_name']; ?></td>
				<td align="left" valign="middle"><?php if(isset($dat['User']['AffiliateProfile']['Region']['name']))
																	echo $dat['User']['AffiliateProfile']['Region']['name'];	
														else echo 'N/A';  ?></td>
				
				<td align="center">
				<?php 
			
					echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'trash.gif'), array('action' => 'delete_affiliate_of_month', $dat['PersonOfMonth']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $dat['PersonOfMonth']['id']));
				
				?>
				</td>
			</tr>
			<?php endforeach; ?>
			
        </table>
    </div>

</div>