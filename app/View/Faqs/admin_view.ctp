<div class="products row">
    <div class="floatleft mtop10"><h1><?php  echo __('View Faq');?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Faq').'</span>', array('controller' => 'faqs','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
</div>

<div align="center" class="whitebox mtop15 viewMode">
    <table cellspacing="2" cellpadding="7" border="0" align="center">
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Id'); ?></strong></td>
			<td align="left"><?php echo h($faq['Faq']['id']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Question'); ?></strong></td>
			<td align="left"><?php echo h($faq['Faq']['question']); ?></td>
		</tr>
		<tr>
			<td align="left"><strong class="upper"><?php echo __('Answer'); ?></strong></td>
			<td align="left"><?php echo $faq['Faq']['answer']; ?></td>
		</tr>
    </table>
</div>







