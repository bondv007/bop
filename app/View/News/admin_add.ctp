<?php $this->Html->script(array('ckeditor/ckeditor'), array('inline'=>false));?>
<?php 
	$options = array(1 => 'Publish',0 => 'Unpublish' );
?>
	<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Add News Post'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage News').'</span>', array('controller' => 'news','action' => 'manage','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php echo $this->Form->create('News',array('type' => 'file'));?>
    	<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">
		
		
		<tr>
			<td align="left"><strong class="upper">Title</strong></td>
			<td align="left"><?php	echo $this->Form->input('title',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Content</strong></td>
			<td align="left"><?php	echo $this->Form->input('content',array('class' => 'input','type'=>'textarea', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td valign="middle"><strong class="upper"><?php echo $this->Form->label('img', __('Image'));?></strong></td>
			<td>
				<?php
					if(!empty($this->data['News']['filename']))
					{
						echo $this->Form->input('filename', array('type' => 'hidden'));
				?>
					<img src="<?php echo create_thumb_imgname($this->data['News']['filename'], 200, 140, DISPLAY_NEWS_DIR); ?>" /> 
				<?php
						echo $this->Form->checkbox('img_del', array('value' => '1')).' Delete<br/>';
					}
				?>
				<input type="file" name="filename" /> (Upto 2 MB)
			</td>
		</tr>
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
<script>

$(function(){ 
  $('#NewsAdminAddForm').validate();
});
	
	CKEDITOR.replace( 'NewsContent' ,
	{
		 filebrowserBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :'<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});
</script>