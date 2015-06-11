<div class="products row">
    <div class="floatleft mtop10"><h1><?php  echo __('View Workout of the day');?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To WOD').'</span>', array('controller' => 'wods','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
</div>

<div align="center" class="whitebox mtop15 viewMode">
    <table cellspacing="2" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Id'); ?></strong></td>
			<td align="left"><?php echo h($wod['Wod']['id']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Title'); ?></strong></td>
			<td align="left"><?php echo h($wod['Wod']['title']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Description'); ?></strong></td>
			<td align="left"><?php echo $wod['Wod']['description']; ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Details'); ?></strong></td>
			<td align="left"><?php echo $wod['Wod']['details']; ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Category'); ?></strong></td>
			<td align="left"><?php echo $wod['Category']['title']; ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Wod Type'); ?></strong></td>
			<td align="left"><?php echo $wod['WodType']['title']; ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Number of rounds'); ?></strong></td>
			<td align="left"><?php echo $wod['Wod']['rounds']; ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Result Based on'); ?></strong></td>
			<td align="left"><?php echo $wod['Wod']['result_type']; ?></td>
		</tr>
		<tr>
		<td colspan="2">
			<div id="TextBoxesGroup">
				<?php
					if ( !empty($wod_movements) )
					{
						$i = 1;
						foreach ( $wod_movements as $movement )
						{
						?>
						<div id="TextBoxDiv<?php echo $i; ?>">
							<table>
								<tr>
									<td align="left"><strong class="upper">movements</strong></td>
									<td align="left"><?php	echo $movement['Movement']['title']; ?>
									</td>
								</tr>
								<tr>
									<td align="left"><strong class="upper">Options</strong></td>
									<td align="left"><?php
									echo "Type : ". $movement['WodMovement']['type'] ."<br>";
									echo "Value : ". $movement['WodMovement']['value'] ."<br>";									
									?>
									</td>
								</tr>
							</table>
						</div>
						<?php
						$i++;
						}
					}
				?>
			</div>		
		</td>
		</tr>
    </table>
</div>







