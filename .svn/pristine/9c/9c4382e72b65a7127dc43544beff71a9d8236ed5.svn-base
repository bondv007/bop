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
            
            <h2>Participants</h2>      	 
                 <div class="social wod-details">                
                 	  
                 	  <div class="challenge_details">
                 	  	<div class="topic_challenge">
                 	  		<div style="width:20%; float:left;">S.No.</div>
                 	  		<div style="width:30%; float:left;">Name</div>
                 	  		<div>Score</div>
                 	  	</div>
                 	  	<?php $i=1; foreach($challenge['ChallengePeople'] as $ppl){ ?>
                 	  	<div class="topic_details mtop15" style="border-bottom:1px solid #ccc;">&nbsp;
                 	  		 <div style="width:20%; float:left;"><?php echo $i; ?></div>
                 	  		 <div style="width:30%; float:left;"><strong><?php echo $ppl['User']['first_name'].' '.$ppl['User']['last_name']; ?> </strong></div>
                 	  		 <span><?php if(!empty($ppl['score'])) echo $ppl['score']; else echo 'Pending'; ?></span>
                 	  	</div>
                 	  
                 	  	<?php $i++;  } ?>
                 	  </div>
              	        <div class="clear"></div>
                 
              		
              		</div>
                 </div>        
        </div>
    </div>

</div>

