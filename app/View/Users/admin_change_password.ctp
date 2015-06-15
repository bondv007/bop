<div class="pages row">
   
<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
<?php echo $this->element('/admin/flash_message'); ?>
</div>

<div align="center" class="whitebox mtop15">
    <?php echo $this->Form->create('User'); 
    	
    ?>
    <table cellspacing="0" cellpadding="7" border="0" align="center">

	<tr>
	    <td align="left"><strong class="upper">Old Password</strong></td>
	    <td align="left">	<?php
    echo $this->Form->input('old_password', array ('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));
    ?>
	    </td>
	</tr>
	<tr>
	    <td align="left"><strong class="upper">New Password</strong></td>
	    <td align="left">	<?php
    echo $this->Form->input('new_password', array ('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;', 'maxlength' => 20, 'minlength' => 6));
    ?>
	    </td>
	</tr>
	<tr>
	    <td align="left"><strong class="upper">Confirm Password</strong></td>
	    <td align="left">	<?php
    echo $this->Form->input('confirm_password', array ('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));
    ?>
	    </td>
	</tr>
	
	<tr>
        <td align="left"></td>
        <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->form->submit('submit',array('type' => 'submit', 'id'=>'page_add'));?></span></div></td>
    </tr>
            
    </table>
    <?php echo $this->Form->end(); ?>
    
</div>
<script>
$(function(){ 
  $('#UserAdminChangePasswordForm').validate({
  	  rules: {
	    'data[User][confirm_password]': {
	      equalTo: "#UserNewPassword"
	    }
	  }
  });
});	
</script>
