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

<div class="loginpopup wod-detail register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="javascript://" onclick="$.fancybox.close();"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Wod Details - <?php echo $wod[0]['Wod']['title']; ?></h2>      	 
                 <div class="social wod-details">                
                 	  <strong>Description</strong> 	  
                 	  <label class="text_msg wd100p"><?php echo $wod[0]['Wod']['description']; ?></label>
                     
                     <strong>Details</strong> 	  
                 	  <label class="text_msg wd100p"><?php echo $wod[0]['Wod']['details']; ?></label>
                	
                		<div class="wod_mov_list">
                			<strong>Movements</strong>
                			<ul>
                			<?php foreach($wod as $wd){ ?>
                				<li><?php echo $wd['movement']['title']; ?></li>
                			<?php } ?>
                			</ul>	
                		</div>	
                     
                 </div>   
                 
                        
          
               
        
        </div>
    </div>

</div>

