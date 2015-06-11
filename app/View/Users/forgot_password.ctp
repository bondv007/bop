<?php echo $this->element('slider'); ?>
 <div class="loginpopup">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="<?php echo $this->webroot; ?>"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Forgot Password</h2>
            <?php
			echo $this->Session->flash('success');
			echo $this->Session->flash('error');
            ?>            
            <div class="logincenter">
                
                <?php
				echo $this->Form->create(
					null, array(
						'url' => array(
							'controller' => 'users', 
							'action' => 'forgot_password'),
						'inputDefaults' => array(
								'label' => false,
								'div' => false
							)
					)
				);
			?>
                    
                    <div class="inputtype">
                        <label>Email Address</label>
                        <div class="inputtext">
                        	<?php echo $this->Form->input('User.email', array('type' => 'text','required' => false,'class' => 'required email' ));?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <?php echo $this->Form->submit('Submit', array ('class' => 'submitBtn ', 'label' => false, 'div' => false, 'id'=>'forgot_password_btn')); ?>
                        <span class="left" style="float:left;"><?php echo $this->Html->link('Return to login  ',array('controller'=>'users','action'=>'login'));?></span>
                    </div>
                
                <?php                
                echo $this->Form->end();
				?>            
            </div>
            
        </div>
    </div>

</div>
