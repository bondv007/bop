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
			<h1>Forgot Password</h1>			
			<p class="top15 gray12">Please enter your email. A link to update password will be sent to your inbox.</p>
			<?php
			echo $this->Form->create(
				null, array(
					'url' => array(
						'controller' => 'users', 
						'action' => 'admin_forgot_password'),
					'inputDefaults' => array(
							'label' => false,
							'div' => false
						)
				)
			);
			?>
			<p class="top30"><span class="login_field">
				<?php echo $this->Form->input('User.email', array('type' => 'text','placeholder' => 'Email', 'class' => 'inpt', 'size' => '38' ));?>
			 
			  </span>
			</p>
			
			<div class="top15">		   
				<div class="floatright">
					<div class="black_btn2"><span class="upper"><input type="submit" value="SUBMIT" name=""></span></div>
				</div>
			</div>
			<div class="top15">
				<div class="floatleft top15 gray12">
					<?php echo $this->Html->link('<< Click here to login', array('controller' => 'users', 'action' => 'login', 'admin' => true)); ?>
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