<style>
	
.regsiter-2 .left-column { margin-left: 0;}
</style>
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
                      

                      <section class="left-column column">
                          <div class="inlineRow">
                              

                              <div class="column-body list_tutorial">
                                                
                                  		 	
                              <!--tutorial section-->
                                  <div class="tutorials-section">
                                  		<div class="tutorial-image inlineBlock mr10">
                                        	<figure> 
                                            	<img src="<?php echo $this->webroot.'files/tutorials/'.$tutorial['Tutorial']['filename']; ?>" />
                                            </figure>
                                        </div>
                                        
                                        <div class="content inlineBlock">
                                        	<h1><?php echo $tutorial['Tutorial']['title']; ?></h1>
                                            <em>Posted on <?php echo formatDate($tutorial['Tutorial']['created'], 'd M Y')?></em>
                                            
                                            <p><?php echo $tutorial['Tutorial']['content']; ?></p>
                                        </div>
                                  </div>
                              <!--tutorial section ends here-->		        
                                                
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

