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
			echo $this->Session->flash();
            ?>            
            <div class="logincenter">
                
                <?php
				echo $this->Form->create(
					null, array(
						'url' => array(
							'controller' => 'users', 
							'action' => 'twitter_email'),
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
                        <?php echo $this->Form->submit('Update Email', array ('class' => 'submitBtn ', 'label' => false, 'div' => false, 'id' => 'twitter_login_btn')); ?>
                        <?php echo $this->Form->hidden('twitter_id', array ('value' => $twitter_id, 'label' => false, 'div' => false)); ?>
                        <?php echo $this->Form->hidden('screen_name', array ('value' => $screen_name, 'label' => false, 'div' => false)); ?>
                    </div>
                
                <?php                
                echo $this->Form->end();
				?>            
            </div>
            
        </div>
    </div>

</div>
