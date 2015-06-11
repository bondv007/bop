<style>
	.loginBox { padding: 0; 
			   position: absolute; 
			   top: 0; 
			   left: 0; 
			   margin: 0; 
			   width: 100%; 
			   border-radius: 10px; 
			   background: none; }
	
	
.table-back tbody tr td{text-align:center; border-bottom: 1px solid #CCCCCC;}
.table-back tbody tr > *:first-child { background-color: #fff; text-align:center; }		   
	
</style>

<div class="loginpopup wod-detail register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="javascript://" onclick="$.fancybox.close();"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Wod Scores</h2>      	 
                 <div class="social wod-details">                           	  
                 	  <div class="challenge_details">
                 	  	<table width="100%" border="0" cellspacing="0" id="data_table" class="table-back" cellpadding="0">
									<thead>
										<tr>											
											<th scope="col">Wod</th>
											<th scope="col">Score Type</th>											
											<th scope="col">Score</th>																			
										</tr>
									</thead>									
									<tbody>	
										<?php foreach($scores as $sc){ ?>							
										<tr>
											<td><?php  echo $sc['EventWod']['Wod']['title']; ?></td>
											<td><?php echo $sc['EventWod']['score_type']; ?></td>
											<td><?php echo $sc['EventScore']['score']; ?></td>											
										</tr>							
										<?php } ?>		
									</tbody>
								</table>	
                 	  </div>
              	        <div class="clear"></div>
                 </div>        
        </div>
    </div>
</div>
