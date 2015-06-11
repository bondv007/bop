<?php 
	echo $this->Html->css(array('demo'));
	echo $this->Html->script(array('jquery.collapse'));
?>
<style>
	.inlineRow, .inlineBlock, .inlineBlockLi > li { margin-right:0;}
	
</style>

	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				<div class="row">
					<div class="register-columns">
						<div class="column">
							<div class="header">
								<h3>Frequently Asked Questions </h3>
								<div class="clear"></div>
							</div>

							<div class="column-body graybg create-event no-pd inlineBlock">							

								<div id="css3-animated-example">
									
						<?php if(!empty($questions)){ 
								$i = 1;
								foreach($questions as $ques) {
							?>			
		                        <h3 class="accordion">Q.<?php echo $i.' '.$ques['Faq']['question']; ?><span class="plus-minus"> </span></h3>
		                        <div class="<?php if($i == 1) echo 'first'; ?>">
		                          <div class="ansRow content">
		                            <p>A. <?php echo $ques['Faq']['answer']; ?> </p>
		                          </div>
		                        </div>
                       <?php $i++; }}else{ ?>
                       	
                       	<div style="margin-top: 50px; height:120px; width:1003px !important; text-align: center !important;">
                       		No results found!
                       	</div>
                       	<?php } ?> 
                        
                        
                    </div>
								<div class="clear"></div>
							</div>
						</div><!--.left-column-->

						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- MId Section End -->
	
<!--collapase accordian-->
      <script type="text/javascript">
        $("#css3-animated-example").collapse({
          accordion: true,
          open: function() {
            this.addClass("open");
            this.css({ height: this.children().outerHeight() });
          },
          close: function() {
            this.css({ height: "0px" });
            this.removeClass("open");
          }
        });
      </script>
<!--collapase accordian-->
