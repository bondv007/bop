	<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Add Weight Class'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage Weight Class').'</span>', array('controller' => 'WeightClasses','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php
     echo $this->Session->flash();
     echo $this->Form->create('WeightClass');?>
    <table cellspacing="0" cellpadding="7" border="0" align="center" width="450">
		<tr>
			<td align="left"><strong class="upper">Weight Class</strong></td>
			<td align="left"><?php	echo $this->Form->input('weight',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
            <td align="left"></td>
            <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->Form->end(__('Submit'));?></span></div></td>
        </tr>  
	</table>
</div>	

<script type="text/javascript">

$(document).ready(function(){ 
	$('#WeightClassAdminAddForm').validate();
});

</script>