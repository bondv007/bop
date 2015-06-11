<?php
$this->Paginator->options(array (
    'update' => '#main-container',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array ('buffer' => true)),
    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array ('buffer' => true)),
));
?>
	<div class="row">
    <div class="floatleft mtop10"><h2><?php echo __('Manage Pages'); ?></h2></div>
    <p class="floatright">
	<?php
	echo $this->Html->link('<span>'.__('Add Pages').'</span>', array('controller' => 'pages','action' => 'add','admin' => true),array('class'=>'black_btn','escape'=>false));
	?>
	</p>
</div>
    
    <div class="row mtop15">
    <?php 
    echo $this->Session->flash('success');
    echo $this->Session->flash('error');
    ?>
    
    <div class="row">
	<?php echo $this->Form->create('Page'); ?>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" class="listing">
            <tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th align="left"><?php echo $this->Paginator->sort('title'); ?></th>
		<th align="left"><?php echo $this->Paginator->sort('slug'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	    <?php foreach ($pages as $page): ?>
    	    <tr>
    		<td align="center" valign="middle"><?php echo h($page['Page']['id']); ?>&nbsp;</td>
    		<td align="left" valign="middle"><?php echo ($page['Page']['title']); ?>&nbsp;</td>
    		<td align="left" valign="middle"><?php echo ($page['Page']['slug']); ?>&nbsp;</td>
    		<td align="center" valign="middle"><?php echo h($page['Page']['created']); ?>&nbsp;</td>
    		<td align="center">
			<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'view.gif'), array ('action' => 'view', $page['Page']['id']), array ('escape' => false)); ?>&nbsp;
			<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'edit.gif'), array ('action' => 'edit', $page['Page']['id']), array ('escape' => false)); ?>&nbsp;
			<?php echo $this->Html->link($this->Html->image(ADMIN_IMAGES_PATH.'cancel.png'), array('action' => 'delete', $page['Page']['id']), array('escape' => false), "Are you sure you wish to delete this record?");?>
			</td>
    	<?php endforeach; ?>
	    <tr align='right'>
		<td colspan="9" align="left" class="bordernone">
		    <div class="floatleft mtop7">            
		    	<div class="pagination">
			    <?php
			    echo $this->Paginator->prev('< ' . __('previous'), array (), null, array ('class' => 'prev disabled'));
			    echo $this->Paginator->numbers(array ('separator' => ''));
			    echo $this->Paginator->next(__('next') . ' >', array (), null, array ('class' => 'next disabled'));
			    ?>
				</div>
			</div>
		</td>
	    </tr>
        </table><?php echo $this->Form->end(); ?>

    </div>


</div>
<?php
echo $this->Js->writeBuffer();
?>
