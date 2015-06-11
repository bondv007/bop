<?php

App::uses('AppController', 'Controller');

/**
 * Movements Controller
 *
 * @since 7 August 2013
 * @version Cake Php 2.3.8
 * @author Bhanu Prakash Pandey
 */
class MovementsController extends AppController
{


/**
 * admin_index method
 * @param:
 * @return void
 */
    public function admin_index()
    {
		$this->Movement->recursive = 0;
		$this->paginate = array(
			'order' => 'Movement.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		$movements = $this->paginate('Movement');
		$this->set('movements', $movements);
    }

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
    public function admin_view($id = null)
    {
		$this->Movement->id = $id;
		if (!$this->Movement->exists())
		{
			throw new NotFoundException(__('Invalid Movement found'));
		}
		$this->set('movement', $this->Movement->read(null, $id));
    }

/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add()
    {
		if ($this->request->is('post'))
		{
			$this->Movement->create();
			if ($this->Movement->save($this->request->data))
			{
				$this->Session->setFlash(__('The Movement has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Movement->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
    }

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null)
    {
		$this->Movement->id = $id;
		if (!$this->Movement->exists())
		{
			throw new NotFoundException(__('Invalid Movement Found'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->Movement->save($this->request->data))
			{
				$this->Session->setFlash(__('The Movement has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Movement->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
		else
		{
			$this->request->data = $this->Movement->read(null, $id);
		}
    }

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null)
    {
		$this->Movement->id = $id;
		if (!$this->Movement->exists())
		{
			throw new NotFoundException(__('Invalid Movement found'));
		}
		if ($this->Movement->delete())
		{
			$this->Session->setFlash(__('Movement deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('Movement was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index'));
    }

/**
 * admin_wod_type_index method
 * @param:
 * @return void
 */
    public function admin_wod_type_index()
    {
		$this->loadModel('WodType');
		$conditions = array();
		//$this->WodType->paginate = array('threaded');	
		$this->paginate = array(
			'findType' => 'threaded',
			'order' => 'WodType.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);	
		//$this->paginate['findType'] = 'threaded';
		//$this->paginate['limit'] = ADMIN_PAGE_LIMIT;
		$wod_types = $this->paginate('WodType',$conditions);//pr($wod_types);die;
		$this->set('wod_types', $wod_types);
    }


/**
 * admin_wod_type_add method
 *
 * @return void
 */
    public function admin_wod_type_add()
    {
    	$this->loadModel('WodType');
		if ($this->request->is('post'))
		{			
			$this->WodType->create();
			if ( $this->request->data['WodType']['parent_id'] == '')
			{
				$this->request->data['WodType']['parent_id'] = 0;
			}
			if ($this->WodType->save($this->request->data))
			{
				$this->Session->setFlash(__('WOD type has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'wod_type_index'));
			}
			else
			{
				$errors = $this->WodType->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
		$types = $this->WodType->find('list',array('conditions' => array('parent_id' => 0) ));		
		$this->set('types',$types);
    }

/**
 * admin_wod_type_edit method
 *
 * @param string $id
 * @return void
 */
    public function admin_wod_type_edit($id = null)
    {
    	$this->loadModel('WodType');
		$this->WodType->id = $id;
		if (!$this->WodType->exists())
		{
			throw new NotFoundException(__('Invalid WOD type Found'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ( $this->request->data['WodType']['parent_id'] == '')
			{
				$this->request->data['WodType']['parent_id'] = 0;
			}
			if ($this->WodType->save($this->request->data))
			{
				$this->Session->setFlash(__('WOD type has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'wod_type_index'));
			}
			else
			{
				$errors = $this->WodType->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
		else
		{
			$this->request->data = $this->WodType->read(null, $id);
		}
		$types = $this->WodType->find('list',array('conditions' => array('parent_id' => 0) ));		
		$this->set('types',$types);
    }

/**
 * admin_wod_type_delete method
 *
 * @param string $id
 * @return void
 */
    public function admin_wod_type_delete($id = null)
    {
    	$this->loadModel('WodType');
		$this->WodType->id = $id;
		if (!$this->WodType->exists())
		{
			throw new NotFoundException(__('Invalid WOD type found'));
		}
		if ($this->WodType->delete())
		{
			$this->Session->setFlash(__('WOD type deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'wod_type_index'));
		}
		$this->Session->setFlash(__('WOD type was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'wod_type_index'));
    }
	/**
	 * get sub type for the WOD types
	 */
	public function admin_get_by_type() 
	{
		$this->layout = 'ajax';
		$type_id = $this->request->data['Wod']['type_id'];
 		$this->loadModel('WodType');
		$sub_types = $this->WodType->find('list', array(
			'conditions' => array('WodType.parent_id' => $type_id)
			));
 
		$this->set('sub_types',$sub_types);	
		$this->render('get_by_type');
	}

}
