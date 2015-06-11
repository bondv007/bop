<?php
if ( $SESS_USER_TYPE == USER_ATHLETE )
{
	?>
<section class="athlt-profile-top row">
		<div class="athlt-profile-top-hd row">
			<div class="page-mid">
				<div class="row">
					<h3 class="admin-hd">Athlete Admin Panel <span>/ Signed in as</span>  <span><?php echo $usersession['first_name']." ".$usersession['last_name'];?></span></h3>
					<div class="fRight admin-hd-ryt">
						<select class="sl25">  
							<option> Search athletes, Affilates, Events </option>
							<option> Select </option>
							<option> Select </option>
						</select>
						<select class="sl10">  
							<option> Create Event </option>
							<option> Select </option>
							<option> Select </option>
						</select>
						<a href="#" class="fLeft ml10"> <img class="fLeft" src="images/admin-setting.png" alt=""> </a>
					</div>
				</div>
			</div>
		</div>
		<div class="page-mid">
			<div class="athlt-profile-main row">
				<div class="athlt-profile-lmn">
					<div class="prof-image"> <!--<img src="images/profile1.png" width="100%" alt=""> -->
					<?php 
					if ( $usersession['photo'] != '') 
					{
					?>
						<?php echo $this->Html->image(FRONT_END_USER_IMAGES_PATH.$usersession['id'].'/big_'.$usersession['photo'], array('alt' => $usersession['first_name'],'width'=>'100%')); ?>
					<?php
					}
					else
					{
					?>
						<img src="images/no_image.jpg" width="100%" alt="">
					<?php
					}
					?>
					<a href="#"> Edit </a></div>
					<div class="prof-disc">
						<h3 class="row"><?php echo $usersession['first_name']." ".$usersession['last_name'];?> <a href="#" class="fRight button-blk mt2"> Edit </a></h3>
						<div class="prof-disc-cont">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor convallis odio, in ultrices quam ultrices vitae. Ut pulvinar diam a dapibus vulputate. In id pellentesque est. Nam iaculis posuere purus, eget tincidunt ipsum dignissim a.</p>
							<p>Nullam ut ante pulvinar tortor porttitor aliquet at quis eros.Donec metus dolor, euismod in erat sed, ornare dictum elit. Quisque vitae luctus erat. Ut id faucibus justo. Nunc lobortis consequat metus, at pulvinar arcu. </p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor convallis odio, in ultrices quam ultrices vitae. Ut pulvinar diam a dapibus vulputate. In id pellentesque est. Nam iaculis posuere purus, eget tincidunt ipsum dignissim a.</p>
						</div>
					</div>
					<div class="row mt15">
						<a href="#" class="button-blue mr10"> Edit Page </a>
						<a href="#" class="button-blue mr10"> Create Fantasy Team </a>
						<a href="#" class="button-blue mr10"> Help </a>
					</div>
				</div>
				
				<div class="athlt-profile-rmn">
					<ul>
						<li> <label> Region </label>  <span> Southeast</span></li>
						<li> <label> Box </label>  <span> TBBJ</span></li>
						<li> <label> Gender </label>  <span> Male</span></li>
						<li> <label> Age </label>  <span> 39</span></li>
						<li> <label> Height </label>  <span> 6’4</span></li>
						<li> <label> Weight </label>  <span> 230	</span></li>
					</ul>
					<div class="row">
						<a href="#" class="button-blk fRight mt10 mb10"> Edit </a>
					</div>
					<div class="row profile-scl">
						<a href="#" class="sc1"> &nbsp; </a>
						<a href="#" class="sc2"> &nbsp; </a>
						<a href="#" class="sc3"> &nbsp; </a>
					</div>
				</div>
				
			</div>
		</div>
	</section>
<?php
}
else if ( $SESS_USER_TYPE == USER_AFFILIATE )
{
	?>
	<section class="athlt-profile-top row">
		<div class="athlt-profile-top-hd row">
			<div class="page-mid">
				<div class="row">
					<h3 class="admin-hd">Affiliate Admin Panel <span>/ Signed in as</span>  <span> <?php echo $usersession['first_name']." ".$usersession['last_name'];?> </span></h3>
					<div class="fRight admin-hd-ryt">
						<select class="sl25">  
							<option> Search athletes, Affilates, Events </option>
							<option> Select </option>
							<option> Select </option>
						</select>
						<select class="sl10">  
							<option> Create Event </option>
							<option> Select </option>
							<option> Select </option>
						</select>
						<a href="#" class="fLeft ml10"> <img class="fLeft" src="images/admin-setting.png" alt=""> </a>
					</div>
				</div>
			</div>
		</div>
		<div class="page-mid">
			<div class="athlt-profile-main row">
				<div class="athlt-profile-lmn">
					<div class="prof-image"> <!--<img src="images/profile2.png" width="100%" alt=""> -->
					<?php 
					if ( $usersession['photo'] != '') 
					{
					?>
						<?php echo $this->Html->image(FRONT_END_USER_IMAGES_PATH.$usersession['id'].'/big_'.$usersession['photo'], array('alt' => $usersession['first_name'],'width'=>'100%')); ?>
					<?php
					}
					else
					{
					?>
						<img src="images/no_image.jpg" width="100%" alt="">
					<?php
					}
					?>					
					<a href="#"> Edit </a></div>
					<div class="prof-disc">
						<h3 class="row"><?php echo $usersession['first_name']." ".$usersession['last_name'];?> <a href="#" class="fRight button-blk mt2"> Edit </a></h3>
						<div class="prof-disc-cont">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor convallis odio, in ultrices quam ultrices vitae. Ut pulvinar diam a dapibus vulputate. In id pellentesque est. Nam iaculis posuere purus, eget tincidunt ipsum dignissim a.</p>
							<p>Nullam ut ante pulvinar tortor porttitor aliquet at quis eros.Donec metus dolor, euismod in erat sed, ornare dictum elit. Quisque vitae luctus erat. Ut id faucibus justo. Nunc lobortis consequat metus, at pulvinar arcu. </p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor convallis odio, in ultrices quam ultrices vitae. Ut pulvinar diam a dapibus vulputate. In id pellentesque est. Nam iaculis posuere purus, eget tincidunt ipsum dignissim a.</p>
						</div>
					</div>
					<div class="row mt15">
						<a href="#" class="button-blue mr10"> Edit Page </a>
						<a href="#" class="button-blue mr10"> Create Event </a>
						<a href="#" class="button-blue mr10"> Help </a>
					</div>
				</div>
				
				<div class="athlt-profile-rmn">
					<ul>
						<li> <label> Region </label>  <span> Southeast</span></li>
						<li> <label> League </label>  <span> TBBJ</span></li>
						<li> <label> Coach #1 </label>  <span> John Parera</span></li>
						<li> <label> Coach #2 </label>  <span> Micheal Hasi</span></li>
						<li> <label> Established </label>  <span> 1995</span></li>
						<li> <label> #Athletes </label>  <span> 230</span></li>
						<li> <label> #Fans </label>  <span> 345</span></li>
						<li> <label> Charities </label>  <span> $4,768</span></li>
						<li> <label> Firebreather of the month </label>  <span> <a href="#"> <img src="images/fbom1.png" alt=""></a></span></li>
					</ul>
					<div class="row profile-scl mt10">
						<a href="#" class="sc1"> &nbsp; </a>
						<a href="#" class="sc2"> &nbsp; </a>
						<a href="#" class="sc3"> &nbsp; </a>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<?php
}
else 
{
	?>
	
	<?php
}
?>
