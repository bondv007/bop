<style>
	.loginBox { padding: 0; 
			   position: absolute; 
			   top: 0; 
			   left: 0; 
			   margin: 0; 
			   width: 100%; 
			   border-radius: 10px; 
			   background: none; }
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
</style>

<div class="loginpopup wod-detail register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="javascript://" onclick="$.fancybox.close();"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Challenge Details</h2>      	 
                 <div class="social wod-details">                
                 	  
                 	  <div class="challenge_details">
                 	  	<div class="topic_challenge">Event Details</div>
                 	  	<div class="topic_details mtop15">&nbsp;
                 	  		 <strong>Challenge Date/Time: </strong>
                 	  		 <span><?php echo formatDate($challenge['Challenge']['date']).' '.$challenge['Challenge']['time'];?></span>
                 	  	</div>
                 	  	<div class="topic_details">&nbsp;
                 	  		 <strong>Challenge Location: </strong>
                 	  		 <span><?php if(!empty($challenge['Challenge']['location'])) echo $challenge['Challenge']['location']; else echo 'N/A'; ?></span>
                 	  	</div>
                 	  	<div class="topic_details">&nbsp;
                 	  		 <strong>Challenged By: </strong>
                 	  		 <span><?php echo $challenge['User']['first_name'].' '.$challenge['User']['last_name'];?></span>
                 	  	</div>	
                 	  	<div class="topic_details">&nbsp;
                 	  		 <strong>Verification required: </strong>
                 	  		 <span><?php echo $challenge['Challenge']['require_verification']; ?></span>
                 	  	</div>	
                 	  	
                 	  	<div class="topic_challenge mtop15">Wod Details</div>
                 	  	<div class="topic_details mtop15">&nbsp;
                 	  		 <strong>Title: </strong>
                 	  		 <span><?php echo strip_tags($challenge['ChallengeWod'][0]['Wod']['title']);?></span>
                 	  	</div>
                 	  	<div class="topic_details">&nbsp;
                 	  		<strong>Description: </strong>
                 	  		 <span><?php echo strip_tags($challenge['ChallengeWod'][0]['Wod']['description']);?></span>
                 	  	</div>	
                 	  	<div class="topic_details">&nbsp;
                 	  		<strong>Movements: </strong>
                 	  		<ul>
                			<?php foreach($challenge['ChallengeWod'][0]['Wod']['WodMovement'] as $wm){ ?>
                				<li><?php echo $wm['Movement']['title']; ?></li>
                			<?php } ?>
                			</ul>
                 	  	</div>	
                 	  </div>
              	        <div class="clear"></div>
                 	<div class="challenge_links mtop15">
                 	<?php if ( $ch_people['ChallengePeople']['status'] == 'Pending' && $challenge['Challenge']['date'] >= date('Y-m-d')) {  ?>
			
						<a class="blue_button" href="<?php echo $this->webroot.'challenges/update_status/accept/'.$ch_people['ChallengePeople']['id']; ?>">Accept</a>
								
					<a class="blue_button" href="<?php echo $this->webroot.'challenges/update_status/decline/'.$ch_people['ChallengePeople']['id']; ?>">Decline</a>	
					<?php }?>		
              		
              		</div>
                 </div>        
        </div>
    </div>

</div>
