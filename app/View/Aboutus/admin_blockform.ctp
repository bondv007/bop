<script type="text/javascript" src="<?php echo SITE_URL ?>js/ckeditor/ckeditor.js"></script>
<script>
	function tog_type(obj)
	{
		if($(obj).val() == 'block_big')
		{
			$('#div_ckeditor').show();
			$('#div_desc').hide();
		}
		else
		{
			$('#div_desc').show();
			$('#div_ckeditor').hide();
		}
	}
	
	$(document).ready(function(){
		$("#frm_addedit").validate();
	})
</script>
    <div class="row">
		<div class="floatleft mtop10"><h1><?php echo $view_title?></h1></div>
		<div class="floatright"><?php echo $this->Html->link('<span>Back to Blocks List</span>', array('controller' => 'aboutus', 'action' => 'admin_blocklist'), array('class' => 'black_btn', 'escape' => false)) ?></div>
    </div>
	<div align="center" class="greybox mtop15">
		<?php echo $this->Form->create('Aboutus', array('url' => null, 'name' => 'frm_addedit', 'id' => 'frm_addedit', 'method' => 'post', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false), 'type'=>'file')) ?>
			<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
			<table cellspacing="0" cellpadding="7" border="0" align="center">
				<tr>
					<td width="20%" valign="middle"><strong class="upper">Type:</strong></td>
					<td><?php echo $this->Form->input('type', array('class'=>'required', 'options' => $ARR_ABOUTUS_BLOCK_TYPE, 'default' => 'block', 'onchange' => "tog_type(this)") )?></td>
				</tr>
				<tr>
					<td width="20%" valign="middle"><strong class="upper">Name:</strong></td>
					<td><?php echo $this->Form->input('title', array('class' => 'input required', 'style' => "width: 450px;", 'type' => 'text')); ?></td>
				</tr>
				<tr>
					<td width="20%" valign="middle"><strong class="upper">Description:</strong></td>
					<td>
						<div id="div_desc" style="<?php echo ((empty($this->data['Aboutus']['type']) || (!empty($this->data['Aboutus']['type']) && $this->data['Aboutus']['type'] == 'block'))?'':'display:none;') ?>">
							<?php echo $this->Form->input('desc', array('class' => 'input', 'style' => "width: 450px;", 'rows' => 5, 'maxlength' => 150)); ?>
							<br>Max. 150 characters
						</div>
						<div id="div_ckeditor" style="<?php echo (((!empty($this->data['Aboutus']['type']) && $this->data['Aboutus']['type'] == 'block_big'))?'':'display:none;') ?>">
							<?php echo $this->Form->input('content', array('class' => 'input required', 'style' => "width: 450px;", 'rows' => '5', 'id' => 'content')); ?>
							<script type="text/javascript">
							//<![CDATA[
								CKEDITOR.replace( 'content',
									{
										filebrowserBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserImageBrowseUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserFlashBrowseUrl :'<?php echo SITE_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserUploadUrl  :'<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
										filebrowserImageUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
										filebrowserFlashUploadUrl : '<?php echo SITE_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
										
									});
							//]]>
							</script>
							</div>
					</td>
				</tr>
				<tr>
					<td valign="middle"><strong class="upper"><?php echo $this->Form->label('img', __('Image'));?></strong></td>
					<td>
						<?php
							if(!empty($this->data['Aboutus']['filename']))
							{
								echo $this->Form->input('filename', array('type' => 'hidden'));
						?>
							<img src="<?php echo create_thumb_imgname($this->data['Aboutus']['filename'], 290, 190, DISPLAY_ABOUTUS_DIR) ?>" /> 
						<?php
								echo $this->Form->checkbox('img_del', array('value' => '1')).' Delete<br/>';
							}
						?>
						<input type="file" name="filename" /> (Upto 2 MB)
					</td>
				</tr>
				<tr>
                	<td>&nbsp;</td>
					<td>
						<div class="floatleft">
							<input type="submit" class="submit_btn" value="">
						</div>
						<div class="floatleft" id="domain_loader" style="padding-left:5px;"></div>
					</td>
				</tr>
			</table>
		</form>
	</div>
