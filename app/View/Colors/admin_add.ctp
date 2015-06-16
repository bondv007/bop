<?php $this->Html->script(array('ckeditor/ckeditor'), array('inline'=>false));?>

	<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Add Pet Color'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage Pet Color').'</span>', array('controller' => 'colors','action' => 'manage','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php echo $this->Form->create('PetColors',array('type' => 'file'));?>
    	<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">
		
		
		<tr>
			<td align="left"><strong class="upper">Color Name</strong></td>
			<td align="left"><?php	echo $this->Form->input('name',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		
		<tr>
			<td valign="middle"><strong class="upper"><?php echo $this->Form->label('img', __('Image'));?></strong></td>
			<td>
				<?php
					if(!empty($this->data['PetColors']['filename']))
					{
						echo $this->Form->input('filename', array('type' => 'hidden'));
				?>
					<img src="<?php echo create_thumb_imgname($this->data['PetColors']['filename'], 200, 140, DISPLAY_COLORS_DIR); ?>" /> 
				<?php
						echo $this->Form->checkbox('img_del', array('value' => '1')).' Delete<br/>';
					}
				?>
				<input type="file" name="filename" /> (Upto 2 MB)
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
  $('#PetColorsAdminAddForm').validate();
});
</script>