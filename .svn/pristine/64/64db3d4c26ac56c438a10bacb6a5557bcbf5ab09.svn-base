<?php

App::uses('AppController', 'Controller');

/**
 * Category Controller
 *
 * @since 7 August 2013
 * @version Cake Php 2.3.8
 * @author Bhanu Prakash Pandey
 */
class CategoriesController extends AppController
{


/**
 * admin_index method
 * @param:
 * @return void
 */
    public function admin_index()
    {
		$this->Category->recursive = 0;
		$this->paginate = array(
			'order' => 'Category.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		$categories = $this->paginate('Category');
		$this->set('categories', $categories);
    }

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
    public function admin_view($id = null)
    {
		$this->Category->id = $id;
		if (!$this->Category->exists())
		{
			throw new NotFoundException(__('Invalid Category found'));
		}
		$this->set('category', $this->Category->read(null, $id));
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
			$this->Category->create();
			if ($this->Category->save($this->request->data))
			{
				$this->Session->setFlash(__('The Category has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Category->validationErrors;
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
		$this->Category->id = $id;
		if (!$this->Category->exists())
		{
			throw new NotFoundException(__('Invalid Category Found'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->Category->save($this->request->data))
			{
				$this->Session->setFlash(__('The Category has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Category->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
		else
		{
			$this->request->data = $this->Category->read(null, $id);
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
		$this->Category->id = $id;
		if (!$this->Category->exists())
		{
			throw new NotFoundException(__('Invalid Category found'));
		}
		if ($this->Category->delete())
		{
			$this->Session->setFlash(__('Category deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('Category was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index'));
    }



}
