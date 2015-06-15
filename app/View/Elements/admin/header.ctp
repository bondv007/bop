<div id="header">
    <div id="head_lt">
		<!--Logo Start from Here-->
		<span class="floatleft logo">
			<?php 
				//echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'logo.png', array('title' => "Best of Pedigree", 'alt' => "Best of Pedigree", 'style' => "margin-top:-26px;")), '/admin/', array('escape' => false));
			?>
		</span>
		<!--Logo end  Here-->
    </div>
<?php
	if(!empty($SESS_ADMIN_USERID))
	{
	?>
		<div id="head_rt">Welcome <span><?php echo $SESS_ADMIN_USERNAME; ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo date('d M, Y H:i A');?></div>
	<?php
	}
?>
</div>

<?php
	if(!empty($SESS_ADMIN_USERID))
	{
?>
<div class="menubg">
	<div class="nav">
		<ul id="navigation">
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Dashboard', '/admin/'); ?>
			</li>
			<li onmouseover="this.className='hov'" onmouseout="this.className=''">
				<?php echo $this->Html->link('Manage', array('controller' => 'users', 'action' => 'manage','admin' => true), array('title' => 'Users Listing')); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Manage Users', array('controller' => 'users', 'action' => 'manage','admin' => true), array('title' => 'Users Listing')); ?></a></li>
						<li><?php echo $this->Html->link('Manage News', array('controller' => 'news', 'action' => 'manage','admin' => true), array('title' => 'Users Listing')); ?></a></li>
					
					</ul>
				</div>
			</li>
			<!--<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('WOD Dictionary', array('controller' => 'wods', 'action' => 'admin_index')); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Manage movement', array('controller' => 'movements', 'action' => 'index','admin' => true)); ?></a></li>
						<li><?php echo $this->Html->link('Manage Category', array('controller' => 'categories', 'action' => 'index','admin' => true)); ?></a></li>
						<li><?php echo $this->Html->link('Manage WOD Type', array('controller' => 'movements', 'action' => 'wod_type_index','admin' => true)); ?></a></li>
						<li><?php echo $this->Html->link('Add WOD Dictionary', array('controller' => 'wods', 'action' => 'add','admin' => true), array('title' => 'Add Page')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Weight Class', array('controller' => 'WeightClasses', 'action' => 'index','admin' => true), array('title' => 'Weight Class')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Age Groups', array('controller' => 'AgeGroups', 'action' => 'index','admin' => true), array('title' => 'Age Group')); ?></a></li>
						
					</ul>
				</div>
			</li>
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Manage About Us', array('controller' => 'aboutus', 'action' => 'admin_teamlist')); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Manage Video', array('controller' => 'aboutus', 'action' => 'admin_video')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Blocks', array('controller' => 'aboutus', 'action' => 'admin_blocklist')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Sponsors', array('controller' => 'aboutus', 'action' => 'admin_sponsorlist')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Team Members', array('controller' => 'aboutus', 'action' => 'admin_teamlist')); ?></a></li>
					</ul>
				</div>
			</li>
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Static Pages', array('controller' => 'pages', 'action' => 'admin_index')); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Static Pages', array('controller' => 'pages', 'action' => 'admin_index'), array('title' => '')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Blocks', array('controller' => 'block', 'action' => 'admin_list'), array('title' => '')); ?></a></li>
					</ul>
				</div>
			</li>
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Faq', array('controller' => 'faqs', 'action' => 'admin_index')); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Add Faq', array('controller' => 'pages', 'action' => 'admin_add'), array('title' => 'Add Page')); ?></a></li>
					</ul>
				</div>
			</li>
			
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Tutorials', array('controller' => 'tutorials', 'action' => 'admin_index')); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Manage Categories', array('controller' => 'tutorials', 'action' => 'admin_category_index'), array('title' => 'Manage Categories')); ?></a></li>
						<li><?php echo $this->Html->link('Manage Tutorials', array('controller' => 'tutorials', 'action' => 'admin_index'), array('title' => 'Manage Tutorials')); ?></a></li>
						<li><?php echo $this->Html->link('Add Tutorial', array('controller' => 'tutorials', 'action' => 'admin_add'), array('title' => 'Add Tutorial')); ?></a></li>
					</ul>
				</div>
			</li>
			
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Other', 'javascript:void(0)'); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Email template', array('controller' => 'emailtemplates'), array('title' => 'Add Page')); ?></a></li>
						<li><?php echo $this->Html->link('Affiliate of the month', array('controller' => 'affiliate','action' => 'admin_affiliate_of_month'), array('title' => 'Manage affiliate of the month')); ?></a></li>
						<li><?php echo $this->Html->link('Athlete of the month', array('controller' => 'athlete','action' => 'admin_athlete_of_month'), array('title' => 'Manage athlete of the month')); ?></a></li>
					</ul>
				</div>
			</li>-->
			<li onmouseout="this.className=''" onmouseover="this.className='hov'">
				<?php echo $this->Html->link('Settings', 'javascript:void(0)'); ?>
				<div class="sub">
					<ul>
						<li><?php echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'change_password','admin' => true), array('title' => 'Change Password')); ?></a></li>
					</ul>
				</div>
			</li>					
		</ul>
	</div>
	<div class="logout"><?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'logout.gif'), array('controller' => 'users', 'action' => 'admin_logout'), array('escape' => false)); ?></div>
</div>
<?php
	}
?>
