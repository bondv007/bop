<?php $this->Html->script(array('ckeditor/ckeditor'), array('inline'=>false));?>
<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Edit Faq'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage Faq').'</span>', array('controller' => 'faqs','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php echo $this->Form->create('Faq');?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">
		<?php echo $this->Form->input('id',array('type' => 'hidden'));?>
		<tr>
			<td align="left"><strong class="upper">Question</strong></td>
			<td align="left"><?php	echo $this->Form->input('question',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Answer</strong></td>
			<td align="left"><?php	echo $this->Form->input('answer',array('class' => 'input required','type'=>'textarea', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
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
  $('#FaqAdminEditForm').validate();
});

	CKEDITOR.replace( 'FaqAnswer' ,
	{
		 filebrowserBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserImageBrowseUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserFlashBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
		filebrowserUploadUrl  :'<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
		filebrowserImageUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		filebrowserFlashUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});
	
</script>