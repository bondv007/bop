<?php echo $this->Html->script('ckeditor/ckeditor');?> <!-- for loading the js file for teh ckeditor--><div class="row">    <div class="floatleft mtop10"><h1><?php echo __('Edit Email Templates');?></h1></div>	<div class="floatright">		<a href="<?php echo SITE_URL;?>admin/emailtemplates/" class="black_btn"><span>Back To Email Templates</span></a></div></div><div class="row mtop15">		<?php echo $this->Form->create(		null, array(			'url' => array(				'controller' => 'Emailtemplates', 				'action' => 'admin_edit', 'admin'),			'inputDefaults' => array(					'label' => false,					'div' => false				),			'type' => 'post'		)	);?>	<div align="center" class="whitebox mtop15">		<?php echo $this->form->input('Emailtemplate.id',array('type'=>'hidden','label' => false, 'div' => false, 'class' => 'input required', 'style'=>'width:450px;'));?>		<table  cellspacing="0" cellpadding="7" border="0" align="center" >			<tr>				<td align="left">					<strong class="upper">Email For</strong>				</td>				<td align="left">					<?php echo $this->form->input('Emailtemplate.email_for',array('label' => false, 'div' => false, 'class' => 'input required', 'style'=>'width:450px;','disabled'=>'disabled'));?>				</td>			</tr>						<tr>				<td align="left">					<strong class="upper">From Name</strong>				</td>				<td align="left">					<?php echo $this->form->input('Emailtemplate.from_name',array('label' => false, 'div' => false, 'class' => 'input required', 'style'=>'width:450px;'));?>				</td>			</tr>			<tr>				<td align="left">					<strong class="upper">From Email</strong>				</td>				<td align="left">					<?php echo $this->form->input('Emailtemplate.from_email',array('label' => false, 'div' => false, 'class' => 'input required', 'style'=>'width:450px;'));?>				</td>			</tr>			<tr>				<td align="left">					<strong class="upper">Reply To</strong>				</td>				<td align="left">					<?php echo $this->form->input('Emailtemplate.reply_to',array('label' => false, 'div' => false, 'class' => 'input required', 'style'=>'width:450px;'));?>				</td>			</tr>			<tr>				<td align="left">					<strong class="upper">subject</strong>				</td>				<td align="left">					<?php echo $this->form->input('Emailtemplate.subject',array('label' => false, 'div' => false, 'class' => 'input required', 'style'=>'width:450px;'));?>				</td>			</tr>			<tr>				<td align="left">					<strong class="upper">content</strong>				</td>				<td align="left">					<?php echo $this->Form->input('Emailtemplate.content', array('class'=>'ckeditor required','id'=>'editor_office2003'));?>				</td>			</tr>			<tr>				<td align="left">					&nbsp;				</td>				<td align="left">					<div class="black_btn2"><span class="upper"><?php echo $this->form->submit('submit',array('type' => 'submit', 'id'=>'template_edit'));?></span></div>									</td>			</tr>		</table>	</div>	<?php echo $this->Form->end();?></div>