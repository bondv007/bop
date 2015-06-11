<style>
	.loginBox { padding: 0; 
			   position: absolute; 
			   top: 0; 
			   left: 0; 
			   margin: 0; 
			   width: 100%; 
			   border-radius: 10px; 
			   background: none; }
	
.loginBox .inputtype { width:auto; }

</style>

<div class="loginpopup register">
	<span class="overlay"></span>
    <div class="loginBox">
        <div class="logininner clearfix">
            <a class="close" href="javascript://" onclick="$.fancybox.close();"><img src="<?php echo FRONT_END_IMAGES_PATH ?>close_btn.png" alt="" /></a>
            
            <h2>Add New Division</h2> 
                
            <?php 
            	echo $this->Form->create('Division', array ('id' => 'divisionForm', 'class' => 'formStyle'));
			?>                
                
          	
                <div class="col">
                    
                    <div class="inputtype">
                        <label>Division Title</label>
                        <div class="inputtext">
                            <?php
                             echo $this->Form->input('division', array ('id' => 'division','type' => 'text','tabindex' => '1', 'min-length' => '2','class' => 'required', 'required' => false,  'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                     <div class="inputtype">
                        <label>Gender</label>
                        <div class="inputtext" style="width:100px;">
                            <?php echo $this->Form->input('division_sex', array ('id' => 'division_sex','type' => 'select', 'options' => array('Male' => 'Male', 'Female' => 'Female'),'tabindex' => '2', 'class' => 'required', 'required' => false, 'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    
                    <div class="inputtype">
                        <label>No. of Wods</label>
                        <div class="inputtext">
                        	
                            <?php
                            $options = array();
                            for($k=1;$k<11;$k++)
							{
								$options[$k] = $k;
							}
                            
                             echo $this->Form->input('number_of_wods', array ('id' => 'number_of_wods','type' => 'select','options' => $options, 'tabindex' => '3', 'class' => 'required', 'required' => false,  'label' => false, 'div' => false)); ?>
                         </div>
                    </div>
                </div>               
               
                <div class="clear"></div>
                
                <div class="bottom">
                	
                	<?php 
                	 echo $this->Form->button('Cancel', array ('class' => 'submitBtn ','onclick' => '$.fancybox.close(); return false;','name' => "cancelbtn",'id' => "cancel_button", 'label' => false, 'div' => false)); 
                
                	echo $this->Form->submit('Add New Division', array ('class' => 'submitBtn ','name' => "send_button",'id' => "send_button", 'label' => false, 'div' => false)); ?>
                   
                </div>
                            
            <?php
            echo $this->Form->end();
            ?>
        
        </div>
    </div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
	
		
	$("#send_button").click(function(){
    		$('#divisionForm').validate({
			
            	submitHandler: function(form) {     
            		var division = $('#division').val();
					var division_sex = $('#division_sex').val();
					var num_wods = $('#number_of_wods').val();
					var div_count = $('#division_count').val();
					
					$.post('<?php echo $this->webroot; ?>events/add_division',{ division:division, division_sex: division_sex, num_wods: num_wods, div_count: div_count}, function(data) {
						$('.division_section').after(data);
						$('#division_count').val(parseInt(div_count)+1);
						$.fancybox.close();
						scrollToAnchor('.new_division_' + (parseInt(div_count)+1));
					});	
            	}   
        });
	});	
	});
</script>
