 <?php echo $this->element('slider'); ?>
 <div class="loginpopup">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="<?php echo $this->webroot; ?>"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Update Password</h2>
            <?php
            echo $this->Session->flash();
			echo $this->Session->flash('success');
			echo $this->Session->flash('error');
            ?>            
            <div class="logincenter">
                
                <?php
				echo $this->Form->create(
					null, array(
						'url' => array(
							'controller' => 'users', 
							'action' => 'update_password',$token),
						'inputDefaults' => array(
								'label' => false,
								'div' => false
							)
					)
				);
			?>
                    
                    <div class="inputtype">
                        <label>New Password</label>
                        <div class="inputtext">
                        	<?php echo $this->Form->input('User.password', array('type' => 'password', 'tabindex' => '1','required' => false ,'class' => 'required'));?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <label>Confirm Password</label>
                        <div class="inputtext">
                        	<?php echo $this->Form->input('User.confirm_password', array('type' => 'password', 'tabindex' => '2','required' => false ,'class' => 'required'));?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <?php echo $this->Form->submit('Submit', array ('class' => 'submitBtn ', 'label' => false, 'div' => false, 'id'=>'update_password_btn')); ?>
                    </div>
                
                <?php                
                echo $this->Form->end();
				?>            
            </div>
            
        </div>
    </div>

</div>
