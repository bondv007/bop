
    <!--top mid section-->
    <section class="athltic-profile-top row">
    <div class="page-mid events-map">
      <div class="row">
          <div class="contact mb60">
              <h1>Tutorials  </h1>
              <p> Curabitur consequat nisi lectus, a auctor erat rutrum a. Praesent nulla est, ullamcorper at pretium non, sagittis ac turpis. Nunc a erat felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus libero est, aliquet vel ligula in, pretium fringilla nunc. Donec mattis euismod lorem, vel suscipit lectus vulputate quis. Suspendisse varius non diam at blandit. Vestibulum faucibus nulla in mi aliquam convallis. Fusce imperdiet, diam vel suscipit egestas, odio sapien pellentesque mauris, ut pharetra orci neque vitae justo. Aenean mattis interdum facilisis. Integer ut dignissim urna, rutrum malesuada metus.</p>
          </div>
    </div>
    </div>
    </section>
    <!--top mid section ends here-->
      
  <!-- MId Section -->
  <section class="body-content-bg ptb25 row">
      <div class="page-mid">
          <div class="body-content-mn row mt10">
              <div class="row">
                  <div class="register-columns regsiter-2">
                      <aside class="right-column column sponcers">
                          <div class="inlineRow">
                              <div class="header">
                                  <h3>categories </h3>
                              </div>
                              <div class="column-body no-pd">
                              	
                              	<?php $i=0; $p = 999;
                              		if(!empty($categories)) {                              				 
											 
                              			foreach($categories as $cat) {
                              			
                              				if(!empty($cat['Tutorial'])) {
                              					if($p == 999) { 
                              							$p = $i;
												}	
                              	?>
                              	  <div class="tutorials">
                                     <div class="">
                                     	<h4><a href="javascript://"  onclick="display_tutorial('<?php echo $cat['TutorialCategory']['id']; ?>');"><?php echo $cat['TutorialCategory']['name']; ?></a></h4>
                                        <p>
                                        	<?php foreach($cat['Tutorial'] as $tut) {
                                        			echo $tut['title'].'<br>';
                                        	} ?>	
                                        	</p>
                                     </div>
                                  </div>		
                              				
                              	<?php }
										$i++;
								}} ?>
                                 
                                                                
                              </div>
                          </div>
                          <div class="clear"></div>
                      </aside><!--.right-column-->

                      <section class="left-column column">
                          <div class="inlineRow">
                              

                              <div class="column-body list_tutorial">
                             <?php if(!empty($categories)){
                             	
										foreach($categories[$p]['Tutorial'] as $tutorial) {
								  ?> 	
                              <!--tutorial section-->
                                  <div class="tutorials-section">
                                  		<div class="tutorial-image inlineBlock mr10">
                                        	<figure> 
                                            	<img src="<?php echo create_thumb_imgname($tutorial['filename'], 200, 140, DISPLAY_TUTORIAL_DIR); ?>" />
                                            </figure>
                                        </div>
                                        
                                        <div class="content inlineBlock">
                                        	<h1><a href="<?php echo $this->webroot.'tutorials/view_tutorial/'.$tutorial['id']; ?>"><?php echo $tutorial['title']; ?></a></h1>
                                            <em>Posted on <?php echo formatDate($tutorial['created'], 'd M Y')?></em>
                                            
                                            <p><?php echo limit_words($tutorial['content'], 60); ?><a href="<?php echo $this->webroot.'tutorials/view_tutorial/'.$tutorial['id']; ?>"> read more </a></p>
                                        </div>
                                  </div>
                              <!--tutorial section ends here-->
                              <?php }} ?>                          
                                  <div class="clear"></div>
                              </div>
                          </div>
                          <div class="clear"></div>
                      </section><!--.left-column-->
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- MId Section End -->

<script type="text/javascript">
	
	function display_tutorial(id)
	{
		
		showLoading('.list_tutorial','<?php echo $this->webroot.'images/loading.gif'; ?>');
		$.post('<?php echo $this->webroot.'tutorials/display_tutorials_list'; ?>', {id:id}, function(data){
			$('.list_tutorial').html(data);
		});
	}
	
</script>