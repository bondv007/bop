<?php

App::uses('AppController', 'Controller');

/**
 * Faqs Controller
 *
 * @since 2 August 2013
 * @version Cake Php 2.3.8
 * @author Bhanu Prakash Pandey
 * @property Faq $Faq
 */
class FaqsController extends AppController
{

/**
  * index :- Faqs list for frontend
  * @param:
  * @return:
  *
*/
	public function index()
	{
		$this->Faq->recursive = 0;
		$title_for_layout = __('Help');
		$this->set('faqs', $this->paginate());
		$this->set('title_for_layout', $title_for_layout);
	}

/**
 * admin_index method
 * @param:
 * @return void
 */
    public function admin_index()
    {
		$this->Faq->recursive = 0;
		$this->paginate = array(
			'order' => 'Faq.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		$faqs = $this->paginate('Faq');
		$this->set('faqs', $faqs);
    }

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
    public function admin_view($id = null)
    {
		$this->Faq->id = $id;
		if (!$this->Faq->exists())
		{
			throw new NotFoundException(__('Invalid Faq found'));
		}
		$this->set('faq', $this->Faq->read(null, $id));
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
			$this->Faq->create();
			if ($this->Faq->save($this->request->data))
			{
				$this->Session->setFlash(__('The faq has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Faq->validationErrors;
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
		$this->Faq->id = $id;
		if (!$this->Faq->exists())
		{
			throw new NotFoundException(__('Invalid Faq Found'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->Faq->save($this->request->data))
			{
				$this->Session->setFlash(__('The faq has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Faq->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
		else
		{
			$this->request->data = $this->Faq->read(null, $id);
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
		$this->Faq->id = $id;
		if (!$this->Faq->exists())
		{
			throw new NotFoundException(__('Invalid Faq found'));
		}
		if ($this->Faq->delete())
		{
			$this->Session->setFlash(__('Faq deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('Faq was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index'));
    }



}
