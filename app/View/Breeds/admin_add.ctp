<?php 
	$this->Html->script(array('ckeditor/ckeditor'), array('inline'=>false));
	$num_options = array();
	for($i = 1; $i <=10; $i++) {
		$num_options[$i] = $i;
	}

?>
<?php 
	$options = array(1 => 'Active',0 => 'Inactive' );
?>
	<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Add New Breed'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage Breeds').'</span>', array('controller' => 'breeds','action' => 'manage','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php echo $this->Form->create('Breed',array('type' => 'file')); ?>
    	
    <table cellspacing="0" cellpadding="7" border="0" align="center">		
		<tr>
			<td align="left"><strong class="upper">Breed Name</strong></td>
			<td align="left"><?php	echo $this->Form->input('name',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>		
		<tr>
			<td align="left"><strong class="upper">Litter Size</strong></td>
			<td align="left"><?php	echo $this->Form->input('litter_size',array('type' => 'select', 'options' => $num_options, 'empty' => 'Select Litter Size', 'class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>				
		<tr>
			<td align="left"><strong class="upper">Description</strong></td>
			<td align="left"><?php	echo $this->Form->input('description',array('class' => 'input','type'=>'textarea', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>		
	</table>
	
	<table id="colorsTable" cellspacing="0" cellpadding="7" border="0" align="center">
		<tr id="head_row">
			<td><strong>S.No.</strong></td>
			<td><strong>Image</strong></td>
			<td><strong>Color</strong></td>
			<td><strong>Marking</strong></td>
			<td><strong>Action</strong></td>
		</tr>
		<tr id="row_1">
			<td>1</td>
			<td><input type="file" name="filename[]" /> (Upto 2 MB)</td>
			<td><input type="text" name="data['Breed']['breed_color'][]"></td>
			<td><input type="text" name="data['Breed']['breed_marking'][]"></td>
			<td><a href="javascript://" onclick="delete_color(1);">Delete</a></td>
		</tr>
	</table>
	<input type="hidden" id="num_colors" value="1"/>
	<div><button type="button" onclick="add_colors();">Add Colors/Markings</div>
	
	<table cellspacing="0" cellpadding="7" border="0" align="center">	
		<tr>
			<td align="left"><strong class="upper">Status</strong></td>
			<td align="left"><?php	echo $this->Form->input('status',array('type' => 'select', 'options' => $options,'class' => 'input required', 'label' => false, 'error' => false, 'div' => false));?>
			</td>
		</tr>
        <tr>
            <td align="left"></td>
            <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->Form->end(__('Submit'));?></span></div></td>
        </tr>  
    </table>
</div>
<script type="text/javascript">

	$(function(){ 
	  $('#BreedAddForm').validate();
	});
	
	CKEDITOR.replace( 'BreedDescription' ,
	{
		 filebrowserBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :'<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});
	
	function add_colors() {
		var num = $('#num_colors').val();
		num = parseInt(num) + 1;
		
		$('#colorsTable tr:last').append('<tr id="row_'+num+'"><td>'+num+'</td><td><input type="file" name="filename[]" /> (Upto 2 MB)</td><td><input type="text" name="data['Breed']['breed_color'][]"></td><td><input type="text" name="data['Breed']['breed_marking'][]"></td><td><a href="javascript://" onclick="delete_color('+num+');">Delete</a></td>
		</tr>');
		
		$('#num_colors').val(num);
	}
	
	function delete_color(num) {
		$('#row_'+num).remove();
	}
	
	
</script>