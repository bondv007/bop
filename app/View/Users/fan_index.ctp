<?php $this->Html->script(array('ckeditor/ckeditor','jcarousallite'), array('inline'=>false));?>
<style>
.sociallink.badges_list li{padding:0 16px;}
</style>
	<!-- Slider -->
	<section class="athlt-profile-top row">
		<div class="athlt-profile-top-hd row">
			<div class="page-mid">
				<div class="row">
					<h3 class="admin-hd">Fan Admin Panel <span>/ Signed in as</span>  <span> <?php echo $user['first_name'].' '.$user['last_name']; ?> </span></h3>
						<div class="fRight admin-hd-ryt setting-icon">
						
						<a href="javascript://" onclick="toggle_dropdown();" class=""> <img class="" src="<?php echo $this->webroot; ?>images/admin-setting.png" alt=""> </a>
						     <div class="drop-content" style="display:none;">
								 <ul>
									<li><a href="<?php echo $this->webroot; ?>followers/manage_profile">Manage Profile</a></li>
								
									<li><a href="<?php echo $this->webroot; ?>followers/manage_badges">Manage Badges</a></li>
								 </ul>                            
                            </div>						
					</div>
				</div>
			</div>
		</div>
		<div class="page-mid">
		
			<?php 
				echo $this->Session->flash('success');
				echo $this->Session->flash('error');
				echo $this->Session->flash();
			?>
			<div class="athlt-profile-main row">
				<div class="athlt-profile-lmn">
					<?php echo $this->Form->create('ProfileForm',array('id' =>'ProfileFormIndexForm','type' => 'file', 'url' => array('controller' => 'users', 'action' => 'update_profile'))); ?>
					<div class="prof-image"> 
						
						<img src="<?php echo $this->webroot.'files/'. $user['id'] .'/'. 'big_'.$user['photo']; ?>" width="100%" alt=""> 						
						<a href="javascript://" onclick="$('#profile_picture').trigger('click');"> Edit </a>
						
					</div>
					<input type = "file" name = "data[photo]" id = "profile_picture" onchange = "validate_img('#ProfileFormIndexForm');" style = "opacity:0; height:0; width: 0"/> 
					
					<div class="prof-disc">
						<h3 class="row"><?php echo $user['first_name'].' '.$user['last_name']; ?>  
							<a id="edit_profileForm"  href="javascript://" onclick = "show_edit_description();" class="fRight button-blk mt2"> Edit </a>
							<a id="save_profileForm" href="javascript://" onclick = "return submit_profileForm();" class="fRight button-blk mt2" style = "display:none; ">Save</a>	
						</h3>
						<div class="prof-disc-cont description_text">
							<?php echo $user['profile_description']; ?>
							</div>
						
						<div class="prof-disc-cont description_field" style = "display:none;">
							<textarea id="profile_description" name = "profile_description" style = "height:160px; width: 459px;"><?php echo $user['profile_description']; ?></textarea>
							
						</div>
					</div>
					<div class="row mt15">						
						<a href="javascript://" onclick="show_help('<?php echo $this->webroot.'info/help'; ?>');" class="button-blue mr10"> Help </a>
					</div>
				</div>
				
				<div class="athlt-profile-rmn">
					<ul>
						<li> <label> Region </label>  <span> <?php if(isset($profile['Region']['name'])) echo $profile['Region']['name']; else echo 'n/a'; ?></span></li>
						<li> <label> Box </label>  <span> TBBJ</span></li>
						<li> <label> My Cross Filter </label>  <span> Filter</span></li>
						
					</ul>
					<div class="row profile-scl mt10">
						<?php if(!empty($profile['FanProfile']['fb_page'])){ ?>
						<a href="<?php echo 'http://www.facebook.com/'.$profile['FanProfile']['fb_page']; ?>" class="sc1"> &nbsp; </a>
						<?php } ?>
						
						<?php if(!empty($profile['FanProfile']['twitter_page'])){ ?>
						<a href="<?php echo 'http://www.twitter.com/'.$profile['FanProfile']['twitter_page']; ?>" class="sc2"> &nbsp; </a>
						<?php } ?>
						
						<?php if(!empty($profile['FanProfile']['google_page'])){ ?>
						<a href="<?php echo $profile['FanProfile']['google_page']; ?>" class="sc3"> &nbsp; </a>
						<?php } ?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</section>
	<!-- Slider End -->

<section class="body-content-bg ptb25 row">
	<div class="page-mid">
		<div class="body-content-mn row mt10">
			<div class="row mb25">
				
				<div class="athl-brd-rSec" style="width:100%;">
					<div class="social-badges">
						<div class="body-content-box-1">
							<div class="box-1-head">
								<div class="disp-tCell"><span> Social Badges</span> </div>
							</div>
							<?php if(!empty($badges)){ ?>
								<div class="sociallink badges_list big-sliders social-badge-secion-inner pt30 pb60 mr0" style="width: 97.1% !important; max-width: 974px;height:120px;">
									<?php if(count($badges) >= 5){ ?>
									<a href="" class="prev">Prev</a>
									<?php } ?>
		                        	 <div class="slider-container">
			                                <ul class="" >
			                                	<?php if(!empty($badges)){	                                			
														foreach($badges as $bg){ 
			                                		?>
			                                    <li>
			                                    	<a href="<?php echo $bg['Badge']['link']; ?>" target="_blank" title="<?php echo $bg['Badge']['title']; ?>">
			                                    		<img class="circle big" src="<?php echo $this->webroot.'files/badges/'.$bg['Badge']['id'].'/thumb_'.$bg['Badge']['photo']; ?>" width="105" height="105" alt="" />
			                                    	</a>
			                                    </li>	                                                                   
			                                	<?php }} ?>
			                                </ul>
			                         </div>
	                         		<?php if(count($badges) >= 5){ ?>
	                                <a href="" class="next">Next</a>
	                                <?php } ?>
								</div>
								<?php }else{ ?>
									<div class="sociallink badges_list social-badge-secion-inner pt30 pb60 mr0" style="width: 97% !important;max-width: 904px; height:120px;">
										</div>
								<?php } ?>	
						</div>
					</div>
				</div>
			</div>
			
			<div class="row mb25">					
					<div class="msg-pnl-r" style="float:left; margin-right: 18px;">
						<div class="social-badges mb25">
							<div class="body-content-box-1">
								<div class="box-1-head">
									<div class="disp-tCell"><span> Messages</span> </div>
								</div>
								<div class="messages-secion-inner">
									
									<?php echo $this->Form->create('Message',array('id' => 'PostForm', 'type' => 'post')); ?>
										<div id="postMsg" style="display: none;"></div>
										<input type="hidden" id="post_fb" name="post_fb" value="0"/>	
										<input type="hidden" id="post_tw" name="post_tw" value="0"/>									
										<ul class="messages-secion-evnts brdr-btm-groove">
										<li class="mb10">
											<div class="mng-event-top">
												<select name="message_type" class="required">
														<option value="1"> Status Update</option>
														
													</select>
												
												<?php if($this->Session->check('Auth.User.fb_user_access_token')) { ?>
													
													<a href="javascript://" id="post_fb_link" class="post_links post_fb_link" onclick="toggle_value('post_fb');">Facebook</a>
												<?php }else{ ?>
													
													<a href="<?php echo $this->webroot.'users/facebook'; ?>" id="post_fb_link" class="post_fb_link post_links">Facebook</a>
												<?php } ?>	
												
												<?php if(!empty($user['twitter_id']) && !empty($user['twitter_auth_token'])) { ?>
													
													<a href="javascript://" onclick="toggle_value('post_tw');" id="post_tw_link" class="post_tw_link post_links">Twitter</a>
												<?php }else{ ?>
													
													<a href="<?php echo $this->webroot.'users/twitter'; ?>" id="post_tw_link" class="post_tw_link post_links">Twitter</a>
												<?php } ?>		
																							
												
												<div class="text-area-ch posRel">
													<textarea id="post_text" name="content" class="required"></textarea>
													<a href="javascript://" onclick="post_message();" class="post">POST</a>
												</div>

											</div>
										</li>
									</ul>
									
									<?php echo $this->Form->end(); ?>									
									<ul class="messages-secion-evnts all_messages mrgn-top15" style="max-height:277px; min-height: 277px;">
									
										<li>
											<span>&nbsp;</span>
											<p style="text-align:center;"><img src="<?php echo $this->webroot.'images/loading.gif'; ?>" alt=""/></p>
											<label>&nbsp;</label>
										</li>
																	
									</ul>
								</div>
							</div>
						</div>
					</div>			
										
					<div class="msg-pnl-r">
						<div class="">
							<div class="mng-cnter wood mb20 fan-db commn headings">
								<h3>Crossfit Community News (RSS Feed)</h3>
								<ul class="rss_feeds">
									
									<li style="margin-top: 150px; text-align:center; border-bottom:none;">
										<img src="<?php echo $this->webroot.'images/loading.gif'; ?>" alt=""/>
									</li>	
								</ul>
						 </div>												
					</div>				
				</div>
			</div>			
								 
		<section class="events fan-db events_i_follow">
			<div class="head-line"> <h4> Events I Follow </h4></div>
				<div class="events-box messages-secion-inner" style="height: 80px; text-align:center;">
					<img src="<?php echo $this->webroot.'images/loading.gif'; ?>" alt=""/>
				</div>					
		</section>
		
		
		 <section class="events athletes_i_follow">
			 	<div class="head-line"> <h4> Athletes I Follow </h4></div>
			 	<div class="events-box messages-secion-inner" style="height: 80px; text-align:center;">
					<img src="<?php echo $this->webroot.'images/loading.gif'; ?>" alt=""/>
				</div>	
		</section>				
					
			
			<div class="row mb25">
				<div class="social-badges mb25">
							<div class="body-content-box-1">
								<div class="box-1-head">
									<div class="disp-tCell"><span> My Social Network</span> </div>
								</div>
								<div class="messages-secion-inner">
																
									<ul style="width:97%;" class="vticker"> 
										<li style="height: 100px; text-align: center; margin-top:50px;">
											<img src="<?php echo $this->webroot; ?>images/loading.gif" alt="Loading..." />
										</li>									
									</ul>
								</div>
							</div>
						</div>
			</div>	
		</div>
	</div>
</section>

<script type = "text/javascript">

$(document).ready(function(){
	
	$('.description_text').mCustomScrollbar();	
	$('#profile_picture').change(function(){
		validate_img('#ProfileFormIndexForm');	
	});
	get_fan_messages();
	get_rss_feeds();
	get_news_posts('<?php echo $this->webroot.'users/get_page_feeds/'.$user['id']; ?>');
	
	get_events_i_follow('<?php echo $this->webroot.'events/events_i_follow/'.$user['id']; ?>');
	get_athletes_i_follow('<?php echo $this->webroot.'followers/athletes_i_follow/'.$user['id']; ?>');
	
	$('#post_fb').val(0);
	$('#post_fb').removeClass('active');
	$('#post_tw').val(0);
	$('#post_tw').removeClass('active');
	
	<?php if(!empty($badges) && count($badges)>=5) { ?>
	 $(".badges_list").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev"
    });
    <?php } ?>
});

function show_edit_description()
{
	$('#edit_profileForm').hide();
	$('.description_text').hide();
	$('.description_field').show();
	$('#save_profileForm').show();	
}

function submit_profileForm()
{
	var value = $('#profile_description').val();
	$('#ProfileFormIndexForm').submit();
}

function toggle_value(selector_id)
{
	if($('#'+selector_id).val() == '0')
	{
		$('#'+selector_id).val('1');
		//$('.post_links').removeClass('active');
		$('#'+selector_id+'_link').addClass('active');
		
	}else{
		$('#'+selector_id).val('0');
		$('#'+selector_id+'_link').removeClass('active');
	}
}

function post_message()
{	
	var text = $('#post_text').val();
	if(text != "")
	{
			var val_1 = $('#post_fb').val();
			var val_2 = $('#post_tw').val();
			
			if ( val_1 || val_2 )
			{
				var frm = $('#PostForm').serialize();
				showLoading('.all_messages','<?php echo $this->webroot.'images/loading.gif'; ?>')
				$.post('<?php echo $this->webroot.'messages/post_message'; ?>',frm,function(data){
					var resp = data.split('|');
					
					if(resp[0] == 'error')
					{
						$('#postMsg').removeAttr('class').addClass('errorMessage');
					}else if(resp[0] == 'success')
					{
						$('#postMsg').removeAttr('class').addClass('successMessage');
					}
					
					$('#postMsg').html(resp[1]);
					$('#postMsg').show();
					
					get_fan_messages();
					
					$('#post_fb').val(0);
					$('#post_fb_link').removeClass('active');
					$('#post_tw').val(0);
					$('#post_tw_link').removeClass('active');
					
				});
				
			}else{
				alert('Please click either facebook or twitter icon to post messages');
			}
			
	}else{
		alert('Enter text to post');
	}
}

function get_fan_messages()
{
	$.post('<?php echo $this->webroot.'messages/get_fan_messages'; ?>',function(data){
		$('.all_messages').html(data);
	});
}

function get_rss_feeds()
{
	$.post('<?php echo $this->webroot.'info/get_rss_feeds'; ?>',function(data){
		$('.rss_feeds').html(data);
	});
}

CKEDITOR.replace( 'profile_description' ,
	{
		toolbar: [
			{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
			[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
			'/',																					// Line break - next group will be placed in new line.
			{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
		],
		height: '80px',
	});
		
</script>