<?php $this->Paginator->options(array('url' => array('?' => $this->params->query)));?>
<h1><?php echo $view_title ?></h1>
<div class="row mtop15">
	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
		<tr valign="top">
		  <td align="left" class="searchbox">
			<div class="floatleft">
				<?php echo $this->Form->create(null, array('url' => array('controller' => 'aboutus', 'action' => 'sponsorlist', 'admin' => true), 'name' => 'frm_srch', 'id' => 'frm_srch', 'type' => 'get', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => false))) ?>
				  <table width="100%" cellpadding="4" cellspacing="2" >
					  <tr>
						  <td width="20%">Name</td>
						  <td width="30%"><?php echo $this->Form->input('title', array('name' => 'title', 'class' => 'input', 'style' => "width: 300px;", 'value' => (!empty($this->params->query['title'])?$this->params->query['title']:''), 'required' => false)); ?></td>
						 <td colspan="2" align="center"><div class="black_btn2"><span class="upper"><input type="submit" class="search_btne" value="Search" name=""></span></div></td>
					</tr>						  
				  </table>
				</form>
			</div>
			<div class="floatright top5">
				<?php echo $this->Html->link('<span>Add Sponsor</span>', array('controller' => 'aboutus', 'action' => 'sponsoradd'), array('class' => 'blue_btn', 'escape' => false)) ?>
			</div>
		  </td>
	  </tr>
	</table>
</div>

<div class="row mtop30">
	<form name="frm_user" id="frm_user" action="<?php echo $this->Html->url(array('controller' => 'aboutus', 'action' => 'manage_actions')); ?>" method="post" onsubmit="return CheckUserAction(this)">
		<br clear="all" /><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
			<tr>
				<th width="10%" align="left" nowrap="nowrap">#ID</th>
				<th width="50%" align="left" nowrap="nowrap">Name</th>
				<th width="15%" align="center" nowrap="nowrap">On</th>
				<th width="5%" align="center" nowrap="nowrap">Edit</th>
				<th width="10%" align="center" nowrap="nowrap"><input type="checkbox" name="checkall" id="checkall" onclick="checkAll(this);" /></th>
			</tr>
			<?php 
			if(count($result_arr))
			{
				//pr($result_arr);
			
				$i=1;
				$bgClass="";
				foreach($result_arr as $row_arr)
				{
					$row = $row_arr['Aboutus'];
					//$page++;
					if($i%2==0)
						$bgClass = "oddRow";
					else
						$bgClass = "evenRow";

				?>
				<tr class="<?=$bgClass?>">
					<td align="left"><?php echo $row['id'];?></td>
					<td align="left"><?php echo $row['title']; ?></td>
					<td align="left"><?php echo formatDateTime($row['created']);?></td>
					<td align="center">
						<?php echo $this->Html->image(ADMIN_IMAGES_PATH.'edit_icon.gif', array('url'=>array('controller'=>'aboutus', 'action'=>'sponsoredit', $row['id'], 'admin'=>true))); ?>
					</td>
					<td align="center"><input type="checkbox" name="list[]" value="<?php echo $row['id'];?>"/></td>
				</tr> 
			<?php
					$i++; 
				}
			?>
			<tr>
                <td colspan="5" align="left" class="bordernone">
					<div class="floatleft mtop7">
						<div class="pagination">
							<?php echo $this->Paginator->prev("<< Previous", null, null, array('class' => 'disabled')); ?>
							<?php echo $this->Paginator->numbers(); ?>
							<?php echo $this->Paginator->next("Next >>", null, null, array('class' => 'disabled')); ?>
							<!-- prints X of Y, where X is current page and Y is number of pages -->
						</div>
					</div>
					<div class="floatright">
						<div class="floatleft">
						<span class="redtext top5" id="err_status" style="float:left;"></span> &nbsp;&nbsp;
						<select name="task" id="task" class="select-small" >
							<option value="">Select Option</option>
							<option value="delete">Delete</option>
						 </select>
						</div>

						<div class="floatleft mleft10"><input type="submit" class="submit_btn" value="" name="Search"></div>
                   </div>
				</td>
			</tr>
			<?php
			} else{
			?>
				<tr class="redtext">
					<td align="center" colspan="5">No record found</td>
				</tr>
			<?php }?>
		</table>
	</form>
</div>
