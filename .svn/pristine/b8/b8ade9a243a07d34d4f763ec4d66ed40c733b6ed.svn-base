<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Add WOD type'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage WOD types').'</span>', array('controller' => 'movements','action' => 'wod_type_index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php echo $this->Form->create('WodType');?>
    <?php echo $this->Form->input('type',array('type' => 'hidden','value' =>'wod'));?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper">Title</strong></td>
			<td align="left"><?php	echo $this->Form->input('title',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Parent</strong></td>
			<td align="left"><?php	echo $this->Form->input('parent_id',array('class' => 'input', 'type' => 'select','options' => $types,'empty' => 'No Parent', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
        <tr>
            <td align="left"></td>
            <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->Form->end(__('Submit'));?></span></div></td>
        </tr>  
    </table>
</div>
<script>

$(function(){ 
  $('#WodTypeAdminWodTypeAddForm').validate();
});	
</script>