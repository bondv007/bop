<?php echo $this->element('slider'); ?>
 <div class="loginpopup">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="<?php echo SITE_URL; ?>"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Members Login</h2>
            <?php
            echo $this->Session->flash('auth');
			echo $this->Session->flash('success');
			echo $this->Session->flash('error');
            ?>            
            <div class="logincenter">
                
                <?php
				echo $this->Form->create(
					null, array(
						'url' => array(
							'controller' => 'users', 
							'action' => 'login'),
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
                        	<?php echo $this->Form->input('User.email', array('type' => 'text', 'tabindex' => '1','required' => false, 'class'=>'required email'));?>
                        </div>
                    </div>
                    <div class="inputtype">
						<?php echo $this->Html->link('Forgot Password ?',array('controller'=>'users','action'=>'forgot_password'));?>
                        <label>Password</label>
                        <div class="inputtext">
                            <?php echo $this->Form->input('User.password', array('type' => 'password', 'tabindex' => '2','required' =>false,'class' => 'required'));?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <?php echo $this->Form->submit('Login Now', array ('class' => 'submitBtn ', 'label' => false, 'div' => false, 'id' => 'login_btn')); ?>
                        <p>
							 <?php echo $this->Form->checkbox('remember_me', array ('class' => 'check ', 'label' => false, 'div' => false)); ?>
                            Remember me                        
                        </p>
                    </div>
                
                <?php                
                echo $this->Form->end();
				?>            
            </div>
            
        </div>
    </div>

</div>
