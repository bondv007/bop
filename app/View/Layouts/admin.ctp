<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('admin-style'),null, array('inline'=>false));
		echo $this->Html->script(array('jquery-1.7.2.min','jquery.validate','admin_validation'), array('inline'=>false));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

<script type="text/javascript">
		var site_url = '<?php echo SITE_URL; ?>';
</script>
	
</head>	

<body class="greybg">
	<!--Wrapper Start from Here-->
	<div id="wrapper">
		<!--Header Start from Here-->
			<?php echo $this->element('/admin/header') ?>
			<?php @$this->Xicom->display_errors($errors); ?>
			<div id="container">
				<?php echo $this->fetch('content'); ?>
				<?php echo $this->element('/admin/footer') ?>
			</div>
			<?php		
				//echo $this->element('sql_dump');
			?>
		<!--Container end Here-->
		
		<!--Wrapper End from Here-->		
	</div>	
</body>
</html>
