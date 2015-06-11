<!-- Slider -->
<?php
	if(!empty($row_video['Aboutus']['desc']))
	{
?>
	<section class="athlt-profile-top row">
		<div class="page-mid">
			<div class="athlt-banner-main row">
				<?php echo $row_video['Aboutus']['desc'] ?>
			</div>
		</div>
	</section>
<?php
	}
?>
	<!-- Slider End -->
	
	<!-- MId Section -->
	<section class="body-content-bg ptb25 row">
		<div class="page-mid">
			<div class="body-content-mn row mt10">
				
				<div class="row">
			<?php
				if(!empty($result_block))
				{
					foreach($result_block as $row_block)
					{
			?>
					<div class="aboutus-feature">
						<div class="colum">
						<?php
							if(!empty($row_block['Aboutus']['filename']) && file_exists(UPLOAD_ABOUTUS_DIR.$row_block['Aboutus']['filename']))
							{
						?>
							<div class="image">
								<?php echo $this->Html->image($this->Img->getImage(UPLOAD_ABOUTUS_DIR.$row_block['Aboutus']['filename'], 290, 190, true, true), array('alt' => $row_block['Aboutus']['title'], 'title' => $row_block['Aboutus']['title']));?>
							</div>
						<?php
							}
						?>
							<div class="content">
								<h3><?php echo $row_block['Aboutus']['title'] ?></h3>
								<p><?php echo nl2br($row_block['Aboutus']['desc']) ?></p>
							</div>
						</div>
					</div>
			<?php
					}
				}

				if(!empty($result_block_big))
				{
			?>
					<div class="aboutus-content">
				<?php
					$cnt_block_big = 0;
					foreach($result_block_big as $row_block_big)
					{
						$cnt_block_big++;
				?>
						<div class="row <?php echo ((($cnt_block_big%2) == 0)?'odd':'') ?>">
						<?php
							if(!empty($row_block_big['Aboutus']['filename']) && file_exists(UPLOAD_ABOUTUS_DIR.$row_block_big['Aboutus']['filename']))
							{
						?>
							<div class="image">
								<?php echo $this->Html->image($this->Img->getImage(UPLOAD_ABOUTUS_DIR.$row_block_big['Aboutus']['filename'], 290, 250, true, true), array('alt' => $row_block_big['Aboutus']['title'], 'title' => $row_block_big['Aboutus']['title']));?>
							</div>
						<?php
							}
						?>
							<h2><?php echo $row_block_big['Aboutus']['title'] ?></h2>
							<p><?php echo nl2br($row_block_big['Aboutus']['desc']) ?></p>
						</div>
				<?php
					}
				?>
					</div>
			<?php
				}


				if(!empty($result_sponsor))
				{
			?>
				<div class="about-sponcer">
					<h2>Sponsors</h2>
					<div class="inner-sponer">
						<ul>
			<?php
					$cnt_sponsor = 0;
					foreach($result_sponsor as $row_sponsor)
					{
						echo '<li class="'.((($cnt_sponsor%4) == 0)?'last':'').'"><a href="'.make_http_url($row_sponsor['Aboutus']['url']).'" target="_blank">'.$this->Html->image($this->Img->getImage(UPLOAD_ABOUTUS_DIR.$row_sponsor['Aboutus']['filename'], 221, 145, true, true), array('alt' => $row_sponsor['Aboutus']['title'], 'title' => $row_sponsor['Aboutus']['title'])).'</a></li>';
					}
			?>
						</ul>						
					</div>
				</div>
			<?php
				}
				
				if(!empty($result_team))
				{
			?>
				<div class="about-team">
					<h2>Our Team</h2>						
					<div class="inner-sponer">
			<?php
					$cnt_team = 0;
					foreach($result_team as $row_team)
					{
			?>
						<div class="colum">
						<?php
							if(!empty($row_team['Aboutus']['filename']) && file_exists(UPLOAD_ABOUTUS_DIR.$row_team['Aboutus']['filename']))
							{
						?>
							<div class="image">
							<?php 
								echo $this->Html->image($this->Img->getImage(UPLOAD_ABOUTUS_DIR.$row_team['Aboutus']['filename'], 290, 250, true, true), array('url' => array(), 'alt' => $row_team['Aboutus']['title'], 'title' => $row_team['Aboutus']['title']));
							
								echo $this->Html->link('Read More', array(), array('title' => $row_team['Aboutus']['title'], 'class' => 'read-more'));
							?>
							</div>
						<?php
							}
						?>
							<h3><?php echo $row_team['Aboutus']['title'] ?></h3>
						</div>
			<?php
					}
			?>
					</div>
				</div>
			<?php
				}
				
				if(!empty($row_blk_ourcompany) && !empty($row_blk_ourcompany['Block']['content']))
				{
			?>
				<div class="about-company">
					<h2><?php echo $row_blk_ourcompany['Block']['title'] ?></h2>						
					<div class="inner-sponer"><?php echo $row_blk_ourcompany['Block']['content'] ?></div>
				</div>
			<?php
				}
			?>
			</div>
		</div>
	</section>
	<!-- MId Section End -->
