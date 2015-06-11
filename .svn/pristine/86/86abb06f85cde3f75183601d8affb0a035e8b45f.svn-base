 <?php if(!empty($category)){
 	
			foreach($category['Tutorial'] as $tutorial) {
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