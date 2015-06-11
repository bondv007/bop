<script>
	$(document).ready(function(){
		$("#frm_addedit").validate();
	})
</script>
    <div class="row">
		<div class="floatleft mtop10"><h1><?php echo $view_title?></h1></div>
    </div>
	<div align="center" class="greybox mtop15">
		<?php echo $this->Form->create('Aboutus', array('url' => null, 'name' => 'frm_addedit', 'id' => 'frm_addedit', 'method' => 'post', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false), 'type'=>'file')) ?>
			<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
			<table cellspacing="0" cellpadding="7" border="0" align="center">
				<tr>
					<td width="20%" valign="middle"><strong class="upper">Video code:</strong></td>
					<td>
						<?php echo $this->Form->input('desc', array('class' => 'input', 'style' => "width: 450px;", 'rows' => 5, 'maxlength' => 150)); ?>
						<br>Width:960px, Height: 540px.
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
