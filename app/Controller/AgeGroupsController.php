<?php
App::uses('AppController', 'Controller');
/**
 * AgeGroups Controller
 *
 * @property AgeGroup $AgeGroup
 */
class AgeGroupsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AgeGroup->recursive = 0;
		$this->set('ageGroups', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AgeGroup->exists($id)) {
			throw new NotFoundException(__('Invalid age group'));
		}
		$options = array('conditions' => array('AgeGroup.' . $this->AgeGroup->primaryKey => $id));
		$this->set('ageGroup', $this->AgeGroup->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AgeGroup->create();
			if ($this->AgeGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The age group has been saved'),'default',array(),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The age group could not be saved. Please, try again.'),'default',array(),'error');
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
		if (!$this->AgeGroup->exists($id)) {
			throw new NotFoundException(__('Invalid age group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AgeGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The age group has been saved'),'default',array(),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The age group could not be saved. Please, try again.'),'default',array(),'error');
			}
		} else {
			$options = array('conditions' => array('AgeGroup.' . $this->AgeGroup->primaryKey => $id));
			$this->request->data = $this->AgeGroup->find('first', $options);
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
		$this->AgeGroup->id = $id;
		if (!$this->AgeGroup->exists()) {
			throw new NotFoundException(__('Invalid age group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AgeGroup->delete()) {
			$this->Session->setFlash(__('Age group deleted'),'default',array(),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Age group was not deleted'),'default',array(),'error');
		$this->redirect(array('action' => 'index'));
	}
}
