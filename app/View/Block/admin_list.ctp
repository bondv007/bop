<?php $this->Paginator->options(array('url' => array('?' => $this->params->query)));

	$this->Html->scriptBlock('function chg_rec_per_page(num)
		{
			var url = \''.$this->Paginator->url(array_merge($this->passedArgs, array('count' => ''))).'\'+num
			window.location = url;
		}', array('inline' => false));
?>
<h1><?php echo $view_title ?></h1>
<div class="row mtop30">
	<form name="frm_user" id="frm_user" action="<?php echo $this->Html->url(array('controller' => 'category', 'action' => 'manage_actions')); ?>" method="post" onsubmit="return CheckUserAction(this)">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
			<tr>
				<th width="75%" align="left" nowrap="nowrap">Heading</th>
				<th width="20%" align="left" nowrap="nowrap">Modified</th>
				<th width="5%" align="center" nowrap="nowrap">Edit</th>
			</tr>
			<?php 
			if(count($result_arr))
			{			
				$i=1;
				$bgClass="";
				foreach($result_arr as $row_arr)
				{
					$row = $row_arr['Block'];
					//$page++;
					if($i%2==0)
						$bgClass = "oddRow";
					else
						$bgClass = "evenRow";

			?>
				<tr class="<?=$bgClass?>">
					<td align="left"><?php echo $row['heading'];?></td>
					<td align="left"><?php echo formatDateTime($row['modified']); ?></td>
					<td align="center"><?php echo $this->Html->link('<img src="'.ADMIN_IMAGES_PATH.'edit_icon.gif" title="Edit" border="0"/>', 'edit/'.$row['id'], array('escape' => false)) ?></td>
				</tr> 
			<?php
					$i++; 
				}
			}
			else
			{
			?>
				<tr class="redtext">
					<td align="center" colspan="3">No record found</td>
				</tr>
			<?php
			}
			?>
		</table>
	</form>
</div>
