<div class="faqs row">
    <div class="floatleft mtop10"><h2><?php echo __('Edit opt in info'); ?></h2></div>
    <?php
    echo $this->Session->flash('success');
	?>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage opt ins').'</span>', array('controller' => 'optins','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php 
    echo $this->Form->create('Optin');
    echo $this->Form->hidden('id', array('type' => 'hidden'));
    ?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper">Name</strong></td>
			<td align="left"><?php	echo $this->Form->input('name',array('class' => 'input required', 'label' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">School</strong></td>
			<td align="left">
				<?php echo $this->Form->input('school_id',array('options' => $schools,'class' => 'u_select required', 'label' => false, 'div' => false));?>	
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Sport</strong></td>
			<td align="left"><?php	echo $this->Form->input('sport_id',array('class' => 'u_select required', 'label' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Gender</strong></td>
			<td align="left">
				<?php $genderoptions = array('m' => 'Male', 'f' => 'Female');?>
				<?php echo $this->Form->radio('gender',$genderoptions,array('label' => false, 'div' => false, 'legend' => false, 'class' => 'required'));?>	
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Email</strong></td>
			<td align="left"><?php	echo $this->Form->input('email',array('class' => 'input', 'label' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
        <tr>
            <td align="left"></td>
            <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->form->submit('submit',array('type' => 'submit', 'id'=>'optin_edit'));?></span></div></td>
        </tr>  
    </table>
    <?php
    echo $this->Form->end();
    ?>
</div>
