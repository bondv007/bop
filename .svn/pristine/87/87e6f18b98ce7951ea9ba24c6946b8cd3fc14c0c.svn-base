<script>
	$(document).ready(function(){
		$("#frm_addedit").validate();
	})
</script>
    <div class="row">
		<div class="floatleft mtop10"><h1><?php echo $view_title?></h1></div>
		<div class="floatright"><?php echo $this->Html->link('<span>Back to Sponsors List</span>', array('controller' => 'aboutus', 'action' => 'admin_sponsorlist'), array('class' => 'black_btn', 'escape' => false)) ?></div>
    </div>
	<div align="center" class="greybox mtop15">
		<?php echo $this->Form->create('Aboutus', array('url' => null, 'name' => 'frm_addedit', 'id' => 'frm_addedit', 'method' => 'post', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false), 'type'=>'file')) ?>
			<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
			<table cellspacing="0" cellpadding="7" border="0" align="center">
				<tr>
					<td width="20%" valign="middle"><strong class="upper">Name:</strong></td>
					<td><?php echo $this->Form->input('title', array('class' => 'input required', 'style' => "width: 450px;", 'type' => 'text')); ?></td>
				</tr>
				<tr>
					<td width="20%" valign="middle"><strong class="upper">URL:</strong></td>
					<td><?php echo $this->Form->input('url', array('class' => 'input required url', 'style' => "width: 450px;", 'type' => 'text')); ?></td>
				</tr>
				<tr>
					<td valign="middle"><strong class="upper"><?php echo $this->Form->label('img', __('Image'));?></strong></td>
					<td>
						<?php
							if(!empty($this->data['Aboutus']['filename']))
							{
								echo $this->Form->input('filename', array('type' => 'hidden'));
						?>
							<img src="<?php echo create_thumb_imgname($this->data['Aboutus']['filename'], 221, 145, DISPLAY_ABOUTUS_DIR) ?>" /> 
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
