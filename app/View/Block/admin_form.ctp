	<script type="text/javascript" src="<?php echo SITE_URL ?>js/ckeditor/ckeditor.js"></script>
	<?php
		$this->Html->scriptBlock('$(document).ready(function(){
			$("#frm_addedit").validate();
		})', array('inline' => false));
	?>
    <div class="row">
		<div class="floatleft mtop10"><h1><?php echo $view_title?></h1></div>
		<div class="floatright"><?php echo $this->Html->link('<span>Back to Blocks List</span>', array('controller' => 'block', 'action' => 'admin_list'), array('class' => 'black_btn', 'escape' => false)) ?></div>
    </div>
	<div align="center" class="greybox mtop15">
		<?php 
			echo $this->Form->create('Block', array('id' => 'frm_addedit', 'type' => 'file',  'url' => $this->Html->url( null, true ), 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false, 'legend' => false)));
			if(isset($this->data['Block']['id']))
			{
				echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->data['Block']['id']));
			}
		?>
			<table cellspacing="0" cellpadding="7" border="0" align="center">
				<tr>
					<td valign="middle"><strong class="upper">Heading:</strong></td>
					<td><?php echo $this->Form->input('heading', array('class' => 'input required', 'style' => "width: 450px;")); ?></td>
				</tr>
				<tr>
					<td valign="middle"><strong class="upper">Title:</strong></td>
					<td><?php echo $this->Form->input('title', array('class' => 'input required', 'style' => "width: 450px;")); ?></td>
				</tr>
				<tr>
					<td valign="middle"><strong class="upper">Content:</strong></td>
					<td>
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
