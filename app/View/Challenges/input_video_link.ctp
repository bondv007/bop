<style>
	.loginBox { padding: 0; 
			   position: absolute; 
			   top: 0; 
			   left: 0; 
			   margin: 0; 
			   width: 100%; 
			   border-radius: 10px; 
			   background: none; }
	


</style>

<div class="loginpopup register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="javascript://" onclick="$.fancybox.close();"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Video URL</h2> 
           
            <?php 
            	echo $this->Form->create('ChallengePeople', array ('id' => 'peopleForm','url' => array('controller' => 'challenges', 'action' => 'accept_challenge'),'class' => 'formStyle'));				
					
				echo $this->Form->input('id', array('type' => 'hidden', 'value' => $people_id));			
			 ?>
                <div class="col col-full wd100p">
                	  <div class="inputtype">
                        <label>Video Link</label>
                        <div class="inputtext">
                            <?php echo $this->Form->input('video_link', array ('type' => 'text', 'tabindex' => '2', 'class' => 'msg_subject required url', 'required' => false, 'label' => false, 'div' => false)); ?>
                     </div>
                    </div>
                </div>
              
                <div class="bottom">
                	
                	<?php echo $this->Form->submit('Accept', array ('class' => 'submitBtn ','name' => "send_button",'id' => 'send_button', 'label' => false, 'div' => false)); ?>
                   
                </div>
                            
            <?php
            echo $this->Form->end();
            ?>
        
        </div>
    </div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		
    		$('#peopleForm').validate();
	
	});
</script>
