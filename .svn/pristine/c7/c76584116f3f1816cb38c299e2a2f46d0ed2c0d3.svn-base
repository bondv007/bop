<?php
App::uses('AppController', 'Controller');
/**
 * WeightClasses Controller
 *
 * @property WeightClass $WeightClass
 */
class WeightClassesController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->WeightClass->recursive = 0;
		$this->set('weightClasses', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->WeightClass->exists($id)) {
			throw new NotFoundException(__('Invalid weight class'));
		}
		$options = array('conditions' => array('WeightClass.' . $this->WeightClass->primaryKey => $id));
		$this->set('weightClass', $this->WeightClass->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->WeightClass->create();
			if ($this->WeightClass->save($this->request->data)) {
				$this->Session->setFlash(__('The weight class has been saved'),'default',array(),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The weight class could not be saved. Please, try again.'),'default',array(),'error');
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->WeightClass->exists($id)) {
			throw new NotFoundException(__('Invalid weight class'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->WeightClass->save($this->request->data)) {
				$this->Session->setFlash(__('The weight class has been saved'),'default',array(),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The weight class could not be saved. Please, try again.'),'default',array(),'error');
			}
		} else {
			$options = array('conditions' => array('WeightClass.' . $this->WeightClass->primaryKey => $id));
			$this->request->data = $this->WeightClass->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->WeightClass->id = $id;
		if (!$this->WeightClass->exists()) {
			throw new NotFoundException(__('Invalid weight class'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->WeightClass->delete()) {
			$this->Session->setFlash(__('Weight class deleted'),'default',array(),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Weight class was not deleted'),'default',array(),'error');
		$this->redirect(array('action' => 'index'));
	}
}
