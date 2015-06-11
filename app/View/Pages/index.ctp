<div class="loginpopup register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="<?php echo SITE_URL; ?>"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Create an Account</h2> 
             <?php
            echo $this->Session->flash('success');
			echo $this->Session->flash('error');
			echo $this->Session->flash();
			?>          
                
            <?php echo $this->Form->create('User', array ('id' => 'userSignUp', 'class' => 'formStyle','type' => 'file')); ?>
                
                <div class="checktype">
                    <label>Signing up as:</label>
                    <div class="inputtext">
                        <p>
                        	<input type="radio" name="data[User][user_type]" value="athlete" checked=true />
                            Athlete
                        </p>
                        <p>
                        	<input type="radio" name="data[User][user_type]" value="affiliate" />
                            Affiliate
                        </p>
                        <p>
                        	<input type="radio"  name="data[User][user_type]" value="fan" />
                            Fan 
                        </p>
                    </div>
                </div>
                
                <div class="social">
                	<ul>
                    	<li>
                    		<button type="submit" name="facebook_button" id="facebook_button" value="facebook">                    			
                    			<img src="<?php echo FRONT_END_IMAGES_PATH ?>facebook.png" alt="" />
                    		</button>
                    	</li>
                    	<li>
                    		<button type="submit" name="twitter_button" id="twitter_button" value="twitter">                    			
                    			<img src="<?php echo FRONT_END_IMAGES_PATH ?>twitter.png" alt="" />
                    		</button>
                    	</li>
                    	<li>
                    		<button type="submit" name="linkedin_button" id="linkedin_button" value="linkedin">                    			
                    			<img src="<?php echo FRONT_END_IMAGES_PATH ?>linkdin.png" alt="" />
                    		</button>
                    	</li>
                    </ul>	
                
                	<span class="or">OR</span>
                </div>
                
                <div class="col">
                    
                    <div class="inputtype">
                        <label>First name</label>
                        <div class="inputtext">
                            <?php echo $this->Form->input('first_name', array ('type' => 'text', 'tabindex' => '1', 'class' => 'required', 'required' => false, 'minlength' => 2, 'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <label>Email Address</label>
                        <div class="inputtext">
                            <?php echo $this->Form->input('email', array ('type' => 'text', 'tabindex' => '3', 'class' => 'required email', 'required' => false,  'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <label>Password</label>
                        <div class="inputtext">
                            <?php
							echo $this->Form->input('password', array ('id'=>'signuppassword', 'tabindex' => '5','class' => 'inpText required', 'required' => false,'minlength' => 4, 'maxlength' => 20, 'label' => false, 'div' => false));
							?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <label>Photo</label>
                        <div class="inputbrows">
                            <div class='fancy-file'>
                                <div class='fancy-file-name'>&nbsp;</div>
                                <button class='fancy-file-button'>Browse...</button>
                                <div class='input-container'>
                                    <?php echo $this->Form->input('User.photo', array('type' => 'file', 'tabindex' => '7','class' => 'required', 'required' => false, 'label' => false, 'div' => false)); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="col right">
                    
                    <div class="inputtype">
                        <label>Last name</label>
                        <div class="inputtext">
                            <?php echo $this->Form->input('last_name', array ('type' => 'text', 'tabindex' => '2', 'class' => 'required', 'required' => false, 'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <label>Mobile number (optional)</label>
                        <div class="inputtext">
                            <?php echo $this->Form->input('mobile_number', array ('type' => 'text', 'tabindex' => '4', 'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="inputtype">
                        <label>Confirm password</label>
                        <div class="inputtext">
                            <?php
							echo $this->Form->input('confirm_password', array ('type' => 'password', 'tabindex' => '6', 'class' => 'inpText required', 'equalTo' => '#signuppassword','label' => false, 'div' => false));
							?>
                        </div>
                    </div>

                </div>
                
                <div class="bottom">
                	<?php echo $this->Form->submit('Create Account', array ('class' => 'submitBtn ','name' => "register_button",'id' => "register_button", 'label' => false, 'div' => false)); ?>
                    <p><input id="terms_conditions" type="checkbox" class="mright5 required" value="1" name="data[User][terms]" /> I have read and agree to <a href="#">terms and conditions</a> & <a href="#">privacy policy.</a></p>
                	
                </div>
                            
            <?php
            echo $this->Form->end();
            ?>
        
        </div>
    </div>

</div>
