
<?php
	echo $this->Html->script(array('jquery-ui.custom')); 
	echo $this->Html->css(array('jquery-ui.custom')); 
 ?>
 							
								<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="page-mid">
			<div class="filter-search row">
				<h2>Search Filters</h2>
				<?php echo $this->Form->create('searchForm',array('url'=>array('controller'=>'affiliate','action'=>'add_coach'),'type'=>'get')); ?>
				
					<div class="colum">
						<input type="text" name="search_keyword" class="inputText" placeholder="Enter keyword here"/>					
					</div>
					<div class="colum">
						<select name="filter" class="selectBox">
							
							<option value="first_name">First Name</option>
							<option value="last_name">Last Name</option>
							<option value="email">Email</option>
						</select>						
					</div>
					
					<div class="colum">
						<div class="blue">								
                             <button type="submit">Search</button>
						</div>					
					</div>
				<?php echo $this->Form->end(); ?>
				 <div class="blue fRight">
                	<button type="submit" onclick="window.location.href='<?php echo $this->webroot.'users'; ?>'">Back to Dashboard</button>
                </div>
			</div>
		</div>
	</section>
	<!-- Slider End -->
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				
				
				<div class="row">
					<div class="register-columns">
						
						<div class="column">
							
							<div class="header">
								<h3>ADD COACH</h3>										  
								<div class="blue save-btn">								
                                  <button onclick="window.location='<?php echo $this->webroot.'affiliate/add_new_coach'; ?>'">Add New Coach</button>
								</div>
							</div>
						</div>
					</div>	
					
					<div class="list-tabing">
					
						<div class="tab-content">
							<div id="competitions" class="tab-content-list">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>		
										<th scope="col" width="50">S.No.</th>
										<th scope="col"><?php echo $this->Paginator->sort('User.photo','Image'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('User.first_name','First Name'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('User.last_name','Last Name'); ?></th>
										<th scope="col"><?php echo $this->Paginator->sort('User.email','Email'); ?></th>
										<th scope="col">Actions</th>
										
									</tr>
									
								<?php 
									if ( !empty($users) ){
									$i=1;		
									foreach($users as $ev) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php if(!empty($ev['User']['photo'])){ ?>
												<img src="<?php echo $this->webroot.'files/'.$ev['User']['id'].'/thumb_'.$ev['User']['photo']; ?>" alt="Image not available" />	
											<?php	}else{  ?> 
												<img src="<?php echo $this->webroot.'images/image_not_available.jpg'; ?>" height="80" width="80" alt="Image Not Available" />
											<?php } ?>
										
										</td>
										<td><?php echo $ev['User']['first_name']; ?></td>
										<td><?php echo $ev['User']['last_name']; ?></td>
										<td><?php echo $ev['User']['email']; ?></td>
										
										<td>					
											<?php if( !in_array($ev['User']['id'],array_keys($already)) && !in_array($ev['User']['email'],array_values($already)) ) { ?>
											<a href="<?php echo $this->webroot.'affiliate/connect_coach/'.$ev['User']['id']; ?>">Invite</a>
											<?php  }else{ ?>
												<span>Invited</span>
											<?php } ?>									
											
										</td>			
									</tr>
									<?php $i++; }} ?>
									
								</table>
							</div>
							
							<div class="pagination addAthleat">
								<?php echo $this->Paginator->prev('Prev'); ?><?php echo $this->Paginator->numbers(); ?><?php echo $this->Paginator->next('Next'); ?>
							</div>

						</div>
					
					</div>
					
			</div>
						
				
			</div>
		</div>
	</section>
	<!-- MId Section End -->

<script type="text/javascript">

$(document).ready(function(e){
	$("#athlete_options").autocomplete({
		 source: function( request, response ) {

        $.ajax({
            dataType: "json",
            type : 'Get',
            url: '<?php echo $this->webroot.'affiliate/get_users_for_athletes'; ?>',
            data:
            {
                term: request.term,
            },
            success: function(data) {
            
				response( $.map( data, function(item) {
					 return {
						label: item.label,
						value: item.value,
						photo: item.photo
					}
				}));
           }		
					  
        });
      },
      select: function( event, ui ) {
				
				$('#selected_athlete').val(ui.item.value);
				$('#athlete_options').val(ui.item.label);
				return false;
			},
		 focus: function( event, ui ) {
				
				$('#selected_athlete').val(ui.item.value);
				$('#athlete_options').val(ui.item.label);
				return false;
			},	
		minLength: 1
	});
	
	
	
		
});

function submit_athleteForm()
{
    $('#InviteCustomAthleteForm').validate({
            submitHandler: function(form) { 
            	$('#InviteCustomAthleteForm').submit();               
            }   
     	}); 
    
}

function invite_user()
{
	var user_id = $('#selected_athlete').val();
	var user = $('#athlete_options').val();
	var affiliate_id = $('#AthleteAffiliateId').val();	
	
	if( user=="" )
	{
		alert('Please select athlete from GameOn');
			
	} else {
		$('.invitation_form').html('<div style="height:150px; text-align:center; "><img src="<?php echo $this->webroot.'images/loading.gif'; ?>" /></div>');
		
		$.post('<?php echo $this->webroot; ?>affiliate/invite_athlete',{ id: user_id, affiliate_id: affiliate_id}, function(data){
				
			data = data.split('|');			
			$('.invitation_form').html(data[1]);	
			//$('.invitation_form').html('<div style="height:150px; text-align:center; "></div>');	
		});
	}	
	return false;
}


function readURL(input) {
	
	if (input.files[0] && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#img_prev').attr('src', e.target.result).width(70).height(70);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

</script>