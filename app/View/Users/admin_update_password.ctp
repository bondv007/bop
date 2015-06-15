 <!--Admin logn section Start from Here-->
<div id="login-box">
  <div class="white-box" style="width:325px; padding-top:60px;">
	<?php echo $this->Session->flash('success');
	echo $this->Session->flash('error');?>
	<div class="tl">
	  <div class="tr">
		<div class="tm">&nbsp;</div>
	  </div>
	</div>
	<div class="ml">
	  <div class="mr">
		<div class="middle">
		  <div class="lb-data">
			<h1>Update Password</h1>			
			<?php
			echo $this->Form->create(
				null, array(
					'url' => array(
						'controller' => 'users', 
						'action' => 'admin_update_password', $token),
					'inputDefaults' => array(
							'label' => false,
							'div' => false
						)
				)
			);
			?>
			<p class="top30"><span class="login_field">
				<?php echo $this->Form->input('User.password', array('type' => 'password' ,'placeholder' => 'New Password','class' => 'inpt required', 'size' => '38' , 'maxlength' => 20, 'minlength' => 6));?>
			
			  </span>
			</p>
			<p class="top15">
			<span class="login_field">
				<?php echo $this->Form->input('User.confirm_password', array('type' => 'password' ,'placeholder' => 'Confirm Password','class' => 'inpt required', 'size' => '38' , 'maxlength' => 20, 'minlength' => 6));?>
			 </span>
			</p>
			<div class="top15">
							   
				<div class="floatright">
					<div class="black_btn2"><span class="upper"><input type="submit" value="SUBMIT" name=""></span></div>
				</div>
			</div>
				
			<?php echo $this->Form->end() ?>
		  </div>
		</div>
	  </div>
	</div>
	<div class="bl">
	  <div class="br">
		<div class="bm">&nbsp;</div>
	  </div>
	</div>
  </div>
</div>
<!--Admin logn section end Here-->

<script>
$(function(){ 
  $('#UserAdminUpdatePasswordForm').validate({
  	  rules: {
	    'data[User][confirm_password]': {
	      equalTo: "#UserPassword"
	    }
	  }
  });
});	
</script>
