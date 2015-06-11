<?php
	echo $this->Html->script('jquery-ui.custom'); 
	echo $this->Html->css(array('jquery-ui.custom')); 
 ?>

<div class="faqs row">
    <div class="floatleft mtop10"><h2><?php echo __('Select affiliate of the month'); ?></h2></div>
    
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back').'</span>', array('controller' => 'affiliate','action' => 'admin_affiliate_of_month'),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php 
    echo $this->Form->create('PersonOfMonth');

    ?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper">Select Year</strong></td>
			<td align="left">
			<?php
				$cur_year = date('Y'); $options = array();
				for($i = $cur_year; $i>=2014; $i--)
				{
					$options[$i] = $i;
				}
				echo $this->Form->input('year',array('type' => 'select', 'options' => $options,'class' => 'input required', 'label' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		
		<tr>
			<td align="left"><strong class="upper">Select Month</strong></td>
			<td align="left">
			<?php
				
				echo $this->Form->input('month',array('type' => 'select', 'options' => $months,'class' => 'input required', 'label' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Affiliate</strong></td>
			<td align="left">
				<?php echo $this->Form->input('user_id',array('type' => 'text','class' => 'input required', 'label' => false, 'div' => false));?>	
			</td>
		</tr>
		
        <tr>
            <td align="left"></td>
            <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->form->submit('submit',array('type' => 'submit', 'id'=>'optin_submit'));?></span></div></td>
        </tr>  
    </table>
    <?php  echo $this->Form->end();  ?>
</div>

<script type="text/javascript">

$(document).ready(function(){
	
	var availableTags = <?php echo $affiliates; ?>;
		
	$( "#PersonOfMonthUserId" ).autocomplete({
			 source: "<?php echo $this->webroot.'admin/affiliate/get_all_affiliates'; ?>"
			
	});	
	
});
	
</script>