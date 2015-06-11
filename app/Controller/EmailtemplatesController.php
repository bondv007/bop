<?php
/**
* Emailtemplates Controller for manipulating Email templates.
* Created By: Santosh Gupta
* Created On: 19-08-2013
* */

App::uses('AppController', 'Controller');

class EmailtemplatesController extends AppController
{
	/**
	* Controller name
	* @var string
	*/
	public $name = 'Emailtemplates';
	
	/**
	 * Method Name : admin_index
	 * Author Name : Santosh Gupta
	 * Date : 19-08-2013
	 * Description : Function for listing the email templates in admin section
	 */
	
	function admin_index()
	{
		
		$this->loadModel('Emailtemplate');
		$condition = array();
		if(!empty($this->request->query))
		{
			$query =  $this->request->query['q'];
			$condition = array('or' => 
				array(
				  'first_name LIKE' => '%'.$query.'%', 
				  'last_name LIKE' => '%'.$query.'%', 
				  'email LIKE' => '%'.$query.'%'
				)
			);
		}
		$this->paginate = array(
			'limit' => 10,
			'order' => array('Emailtemplate.id' => 'desc'),
			'conditions' => $condition,
		);
		$this->layout = 'admin';
		$users = $this->paginate('Emailtemplate');
		$this->set('emailtemplates',$users);
		$this->set('loggedIn', $this->Auth->loggedIn());
	}
	
	
	/**
	 * Method Name : admin_add
	 * Author Name : Santosh Gupta
	 * Date : 20-08-2013
	 * Description : Function for adding the email template for admin section
	 */
	
	function admin_add()
	{
		$this->loadModel('Emailtemplate');
		if ( $this->request->isPost() )
		{
			if (!empty($this->request->data))
			{
				$this->Emailtemplate->save($this->request->data);
				$this->Session->setFlash(__('Email template added successfully'),'default',array(),'success');
				$referer = array ('controller' => 'emailtemplates', 'action' => 'admin_index' , 'admin' => true);
				$this->redirect($referer);
			}
		}
			
		$this->set('loggedIn', $this->Auth->loggedIn());
	}
	
   /**
	 * Method Name : admin_edit
	 * Author Name : Santosh Gupta
	 * Date : 19-08-2013
	 * Description : Function for editing the email template for admin section
	 */
	
	function admin_edit($id = null)
	{
		$this->loadModel('Emailtemplate');
		if (!empty($id))
		{
			if (!empty($this->request->data))
			{
				$this->Emailtemplate->save($this->request->data);
				$this->Session->setFlash(__('Email template updated successfully'),'default',array(),'success');
				$referer = array ('controller' => 'emailtemplates', 'action' => 'admin_index' , 'admin' => true);
				$this->redirect($referer);
			}
		
			$this->Emailtemplate->id = $id;
			if ($this->request->is('get'))
			{
				$this->request->data = $this->Emailtemplate->read();
			}
			$this->layout = 'admin';
			
			$email = $this->Emailtemplate->find('first', array('conditions'=>array('id'=>$id)));
		}
		else
		{
			$this->Session->setFlash(__('Please select email template to edit'),'default',array(),'error');
			$referer = array ('controller' => 'emailtemplates', 'action' => 'admin_index' , 'admin' => true);
			$this->redirect($referer);
		}
		$this->set('loggedIn', $this->Auth->loggedIn());
	}
	
	/**
	 * Method Name : admin_edit
	 * Author Name : Santosh Gupta
	 * Date : 19-08-2013
	 * Description : Function for editing the email template for admin section
	 */
    public function admin_delete($id = null)
    {
		$this->Emailtemplate->id = $id;
		if (!$this->Emailtemplate->exists())
		{
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Emailtemplate->delete())
		{
			$this->Session->setFlash(__('Email template deleted'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('Email template was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index'));
    }
}
