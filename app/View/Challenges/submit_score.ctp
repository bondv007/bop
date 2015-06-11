<style>
	.loginBox { padding: 0; 
			   position: absolute; 
			   top: 0; 
			   left: 0; 
			   margin: 0; 
			   width: 100%; 
			 
			   border-radius: 10px; 
			   background: none; }
	
	.loginBox .social {background:none;}		   
	.loginBox label{ font-size:14px; min-width:64px;}		   
	.social.wod-details { min-height: 264px;}
	.social.wod-details strong{ margin-top:0;float:left; font-size:14px;}
	.topic_challenge{ font-weight:bold;  border-bottom: 1px solid #000000; font-size: 16px;}
	.mtop15{ margin-top:15px;}
	.challenge_links{ text-align:center;}
	.challenge_links .blue_button{
		  background: none repeat scroll 0 0 #0756A4;
    border: 0 none;
    border-radius: 3px;
    color: #FFFFFF;
    cursor: pointer;
    font-family: 'helvetica_cebold';
    font-size: 14px; padding:6px;
    height: 32px;
    text-transform: uppercase;
	}
	ul.inner-select li{ width:100%; margin-top:5px; } 
	.inner-select input{  border: 1px solid #BCBCBC;
    box-sizing: border-box;
    margin-top: 3px;
    padding: 8px;
    width: 100%;}
    
    label.error{ display:block;}
	
</style>

<div class="loginpopup wod-detail register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="javascript://" onclick="$.fancybox.close();"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Submit Score</h2>      	 
                 <div class="social wod-details">                
                 	  <?php echo $this->Form->create('ChallengePeople', array('id' => 'ChallengePeopleForm')); ?>
                 	  
                 	  <div class="challenge_details">
                 	  <div class="topic_challenge"><?php echo 'Wod - '.$challenge['Challenge']['ChallengeWod']['Wod']['title']; ?></div>
                 	  <ul class="inner-select">
                 	 	
                 	  	
							<li>
								<div class="float-left" style="margin-top: 9px; margin-right: 70px;">
								<label>  Type :	</label>
								</div>								
								<div class="float-left"> 
								 
								  <select name="data[ChallengePeople][type]" class="required">
								  	<option value="time">Time</option>
								  	<option value="distance">Distance</option>
								  	<option value="load">Load</option>
								  	<option value="reps">Reps</option>
								  </select>	
								  
								</div>
								
								<div class="clear"></div>
								<div class="float-left" style="margin-top: 9px; margin-right: 58px;">
								<label>  Total Score :	</label>
								</div>
								
								<div class="float-left">												 
								 
								 <input type="text" name="data[ChallengePeople][score]" class="required number">
								
								</div>
							</li>
						
                 	 	 		
                 	  	
                 	  	
                 	  	 </ul>
                 	  	 </div>
                 	  	  <input type="hidden" name="data[ChallengePeople][id]" value="<?php echo $challenge['ChallengePeople']['id']; ?>">
                 	  	<?php
                 	  		if($challenge['Challenge']['require_verification'] == 'Yes'){ 
                 	  	?>
                 	 <div class="topic_challenge"><?php echo 'Video Link Required'; ?></div>
                 	  <ul class="inner-select">
                 	  	<li style="padding-left: 0;">
								<div class="float-left" style="margin-top: 33px; margin-right: 63px;">
								<label>  Video Link	: </label>
								</div>
								
								<div class="float-left">
								<label>
									&nbsp;
								 </label>							 
								 
								
								 <input type="text" name="data[ChallengePeople][video_link]" class="required url">
								</div>
							</li>
                 	  	</ul>
                 	  	
               		<?php } ?>          	  	
                 	
                 	
                 	  
              	        <div class="clear"></div>
                 	 <div class="challenge_links mtop15">  				
						<a class="blue_button" href="javascript://" onclick="submit_score();">Submit</a>              		
              		</div>
              		 <?php echo $this->Form->end(); ?>
                 </div>        
        </div>
    </div>

</div>

<script type="text/javascript">
function submit_score()
{
	if($('#ChallengePeopleForm').valid())
	{
		$('#ChallengePeopleForm').submit();
	}else{
		$('#ChallengePeopleForm').validate();
	}
	
}
</script>

