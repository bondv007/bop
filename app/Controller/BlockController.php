<?php
/**
* Author : Nitin
* Creation Date : 28th Dec 2012
* Description : FOR Block (list, edit)
*/
class BlockController extends AppController 
{
	var $name = 'Block';
	var $uses = array('Block');
	
	function beforeFilter()
	{
		parent::beforeFilter();
	}

	/**
	 * Purpose : TO LIST THE BLOCKS
	 * Created on : 19-Sep-2013
	 * Author : Nitin
	*/	
	function admin_list()
	{
		$result_arr = $this->paginate('Block');
		
		$view_title = 'Manage Blocks';
		$this->set(compact('result_arr', 'view_title'));
		$this->render('admin_list');
	}

	/**
	 * Purpose : TO ADD BLOCK
	 * Created on : 19-Sep-2013
	 * Author : Nitin
	*/
	function admin_edit($id)
	{
		$errors = '';
		$error_flag = false;
		$this->Block->id = $id;
		
		if(!empty($this->data))
		{
			$this->Block->save($this->data);			
			$this->Session->setFlash(__('Updated successfully.'), 'flash_success');
			$this->redirect('list');
		}
		else
		{
			$this->data = $this->Block->read();
		}

		$this->set('view_title', 'Edit Block');
		$this->set('errors', $errors);
		$this->render('admin_form');
	}

}
?>
