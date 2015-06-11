<?php

App::uses('AppController', 'Controller');

/**
 * Wods Controller(Workout of the day)
 *
 * @since 6 August 2013
 * @version Cake Php 2.3.8
 * @author Bhanu Prakash Pandey
 */
class WodsController extends AppController
{


/**
 * admin_index method
 * @param:
 * @return void
 */
    public function admin_index()
    {
    	$conditions = array();
		if ( !empty($this->request->query['keyword']))
		{
			$keyword = strtolower(trim($this->request->query['keyword']));
			$conditions	= "( LOWER(Wod.title) LIKE '%" . $keyword . "%' OR LOWER(Category.title) LIKE '%" . $keyword . "%' OR LOWER(WodType.title) LIKE '%" . $keyword . "%')";
		}
		
		$this->paginate = array(
			'fields' => array('Wod.*','Category.title','WodType.title'),
			'joins' => array(
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 	'left',
					'conditions' => array('Wod.category_id = Category.id')
				),
				array(
					'table' => 'wod_types',
					'alias' => 'WodType',
					'type'	=>	'left',
					'conditions' => array('Wod.type_id = WodType.id')
				)
			),
			'conditions' => $conditions,
			'order' => 'Wod.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		$wods = $this->paginate('Wod');
		$this->set('wods', $wods);
    }

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
    public function admin_view($id = null)
    {
		$this->Wod->id = $id;
		if (!$this->Wod->exists())
		{
			throw new NotFoundException(__('Invalid wod found'));
		}
		$wod = $this->Wod->find('first',array(
								'fields' => array('Wod.*','Category.title','WodType.title'),
								'joins' => array(
									array(
										'table' => 'categories',
										'alias' => 'Category',
										'conditions' => array('Wod.category_id = Category.id')
									),
									array(
										'table' => 'wod_types',
										'alias' => 'WodType',
										'conditions' => array('Wod.type_id = WodType.id')
									)
								),
							)
						);
		$this->loadModel('WodMovement');
		$wod_movements = $this->WodMovement->find('all',array(
			'fields' => array('*'),
			'joins' => array(
					array(
						'table' => 'movements',
						'alias' => 'Movement',
						'type' => 'left',
						'conditions' => array('WodMovement.movement_id = Movement.id')
					)
			),
			'conditions' => array('WodMovement.wod_id' => $id) )
		);
		$this->set('wod', $wod);
		$this->set('wod_movements', $wod_movements);
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
			$data = $this->request->data['Wod'];
			$this->loadModel('WodMovement');
			
			$this->Wod->bindModel(array('hasMany' => array('WodMovement' => array( 'className'=> 'WodMovement', 'foreignKey' => 'wod_id'))));
			$exist = $this->Wod->find('all', array( 'conditions' => array( 'Wod.wod_type' => $this->data['Wod']['wod_type']),
													'fields' => array('Wod.id', 'Wod.adjusted_criteria', 'Wod.adjusted_criteria_value') ));
			
			$adjusted_criteria = $adjusted_value = '';
			if(isset($this->data['Wod']['adjusted_criteria']))
				$adjusted_criteria = $this->data['Wod']['adjusted_criteria'];
			
			if(isset($this->data['Wod']['adjusted_criteria_value']))
				$adjusted_criteria = $this->data['Wod']['adjusted_criteria_value'];
			
												
			$flag = 0; 										
			if ( !empty($exist) )
			{
				//Loop to check if existing wod have exactly same Wod movement numbers and values
				foreach($exist as $ex)
				{
					if( !empty($ex['WodMovement']) && 
											$ex['Wod']['adjusted_criteria'] == $adjusted_criteria && 
												$ex['Wod']['adjusted_criteria_value'] == $adjusted_value) 
																
					{
						if ( count($ex['WodMovement'] == count($this->data['Wod']['movement_category'])))
						{
							$ctr = 0;
							foreach($ex['WodMovement'] as $wm)
							{
								for( $i=0; $i<count($this->data['Wod']['movement_category']); $i++)
								{
									$sb_type = '';	
									if ( $wm['type'] == 'distance'){
										$sb_type = $this->request->data['Wod']['movement_distance'][$i];							
									}else if ( $wm['type'] == 'load'){
										$sb_type = $this->request->data['Wod']['movement_load'][$i];
									}
									
									if ( ($wm['type'] == $this->data['Wod']['movement_option'][$i]) && 
													($wm['value'] == $this->data['Wod']['option_data'][$i]) &&
																($wm['sub_type'] == $sb_type) )
									{
										$ctr++;				
									}
								}
							}
							
							//count of movements equal to existing wod movement count or not.
							if($ctr == count($this->data['Wod']['movement_category']))
							{
								$flag = 1;
							}
						}
					}
				}
			}
			
		
			
			if ( $flag == 0)
			{			
				$this->Wod->create();
				if ($this->Wod->save($this->request->data))
				{
					$last_inserted_id = $this->Wod->getLastInsertID();
					// Save WOD movements
					if ( isset($this->request->data['Wod']['movement_category']) && (isset($this->request->data['Wod']['movement_option'])) )
					{
						
						$movement_data = array();
						foreach ($this->request->data['Wod']['movement_category'] as $key => $value) {
							$type = $this->request->data['Wod']['movement_option'][$key];
							$movment_id = $value; 
							$value = 0;
							$sub_type = '';
							if ( $this->request->data['Wod']['option_data'][$key] != '')
							{
								$value = $this->request->data['Wod']['option_data'][$key];
							}
							
							if ( $type == 'distance'){
								$sub_type = $this->request->data['Wod']['movement_distance'][$key];							
							}else if ( $type == 'load'){
								$sub_type = $this->request->data['Wod']['movement_load'][$key];
							}
							$movement_data['WodMovement'][] = array(
															'wod_id' => $last_inserted_id,
															'movement_id' => $movment_id,
															'type' =>  $type,
															'value' => $value,
															'sub_type' => $sub_type
														);
						}
						$this->WodMovement->saveAll($movement_data['WodMovement']);
						
					}
					$this->Session->setFlash(__('The WOD has been saved successfully'),'default',array(),'success');
					$this->redirect(array ('action' => 'index'));
				}
				else
				{
					$errors = $this->Wod->validationErrors;
					$this->set('invalidfields', $errors);
					
				}
			}else{
				$this->Session->setFlash(__('A similar Wod already exist. Please fill adjusted criteria to add a new Wod.'),'default',array(),'error');
				//pr($data); die;
				$this->set('data',$data);
			}

		}
		// get WOD category list
		$this->loadModel('Category');
		$categories = $this->Category->find('list',array('conditions' => array('Category.type' => 'wod') ));
		
		// get WOD types list
		$this->loadModel('WodType');
		$types = $this->WodType->find('list',array('conditions' => array('WodType.parent_id' => 0) ) );
		
		// get movements list
		$this->loadModel('Movement');
		$movements = $this->Movement->find('list');
		
		$this->set(compact('categories','types', 'movements'));
    }

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null)
    {
    	$this->loadModel('WodMovement');
		$this->Wod->id = $id;
		if (!$this->Wod->exists())
		{
			throw new NotFoundException(__('Invalid Wod Found'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			
			$data = $this->request->data['Wod'];
			$this->loadModel('WodMovement');
			
			$this->Wod->bindModel(array('hasMany' => array('WodMovement' => array( 'className'=> 'WodMovement', 'foreignKey' => 'wod_id'))));
			$exist = $this->Wod->find('all', array( 'conditions' => array( 'Wod.wod_type' => $this->data['Wod']['wod_type']),
													'fields' => array('Wod.id', 'Wod.adjusted_criteria', 'Wod.adjusted_criteria_value') ));
			
			$adjusted_criteria = $adjusted_value = '';
			if(isset($this->data['Wod']['adjusted_criteria']))
				$adjusted_criteria = $this->data['Wod']['adjusted_criteria'];
			
			if(isset($this->data['Wod']['adjusted_criteria_value']))
				$adjusted_criteria = $this->data['Wod']['adjusted_criteria_value'];
			
											
			$flag = 0; 										
			if ( !empty($exist) )
			{
				//Loop to check if existing wod have exactly same Wod movement numbers and values
				foreach($exist as $ex)
				{
					if( !empty($ex['WodMovement']) && 
											$ex['Wod']['adjusted_criteria'] == $adjusted_criteria && 
												$ex['Wod']['adjusted_criteria_value'] == $adjusted_value) 
																
					{
						if ( count($ex['WodMovement'] == count($this->data['Wod']['movement_category'])))
						{
							$ctr = 0;
							foreach($ex['WodMovement'] as $wm)
							{
								for( $i=0; $i<count($this->data['Wod']['movement_category']); $i++)
								{
									$sb_type = '';	
									if ( $wm['type'] == 'distance'){
										$sb_type = $this->request->data['Wod']['movement_distance'][$i];							
									}else if ( $wm['type'] == 'load'){
										$sb_type = $this->request->data['Wod']['movement_load'][$i];
									}
									
									if ( ($wm['type'] == $this->data['Wod']['movement_option'][$i]) && 
													($wm['value'] == $this->data['Wod']['option_data'][$i]) &&
																($wm['sub_type'] == $sb_type) )
									{
										$ctr++;				
									}
								}
							}
							
							//count of movements equal to existing wod movement count or not.
							if($ctr == count($this->data['Wod']['movement_category']))
							{	
								$flag = 1;
							}
						}
					}
				}
			}

			if ( $flag == 0)
			{
			
				if ($this->Wod->save($this->request->data))
				{
					// Save WOD movements
					if ( isset($this->request->data['Wod']['movement_category']) && (isset($this->request->data['Wod']['movement_option'])) )
					{					
						$this->WodMovement->deleteAll(array('WodMovement.wod_id' => $this->request->data['Wod']['id']));
						$movement_data = array();
						foreach ($this->request->data['Wod']['movement_category'] as $key => $value) {
							$type = $this->request->data['Wod']['movement_option'][$key];
							$movment_id = $value; 
							$value = 0;
							$sub_type = '';
							if ( $this->request->data['Wod']['option_data'][$key] != '')
							{
								$value = $this->request->data['Wod']['option_data'][$key];
							}
							
							if ( $type == 'distance'){
								$sub_type = $this->request->data['Wod']['movement_distance'][$key];							
							}else if ( $type == 'load'){
								$sub_type = $this->request->data['Wod']['movement_load'][$key];
							}
							
							$movement_data['WodMovement'][] = array(
															'wod_id' => $this->request->data['Wod']['id'],
															'movement_id' => $movment_id,
															'type' =>  $type,
															'value' => $value,
															'sub_type' => $sub_type
														);
						}
						$this->WodMovement->saveAll($movement_data['WodMovement']);
					}
					$this->Session->setFlash(__('The WOD has been updated successfully'),'default',array(),'success');
					$this->redirect(array ('action' => 'index'));
				}
				else
				{
					$errors = $this->Wod->validationErrors;
					$this->set('invalidfields', $errors);
				}
			
			}else{
				$this->Session->setFlash(__('A similar Wod already exist. Please fill adjusted criteria to add a new Wod.'),'default',array(),'error');
				
				$this->set('data',$data);
			}
		}
		else
		{
			$this->request->data = $this->Wod->read(null, $id);			
		}
		// get WOD category list
		$this->loadModel('Category');
		$categories = $this->Category->find('list',array('conditions' => array('Category.type' => 'wod') ));
		
		// get WOD types list
		$this->loadModel('WodType');
		$types = $this->WodType->find('list',array('conditions' => array('WodType.parent_id' => 0) ) );
		
		// get movements list
		$this->loadModel('Movement');
		$movements = $this->Movement->find('list');
		
		//$this->WodMovement->bindModel(array('belongsTo' => array('Movement' => array('className' => 'Movement', 'foreignKey' => 'movement_id'))));
		$wod_movements = $this->WodMovement->find('all',array('conditions' => array('WodMovement.wod_id' => $id) ));
		//pr($wod_movements); die;
		$this->set(compact('categories','types', 'movements','wod_movements'));
    }

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null)
    {
		$this->Wod->id = $id;
		if (!$this->Wod->exists())
		{
			throw new NotFoundException(__('Invalid Wod found'));
		}
		if ($this->Wod->delete())
		{
			$this->loadModel('WodMovement');
			$this->WodMovement->deleteAll(array('WodMovement.wod_id' => $id));
			$this->Session->setFlash(__('WOD deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('WOD was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index'));
    }
	
	
		


	/**
	 * Method Name : admin_weight_class_index
	 * Author Name : Vivek Sharma
	 * Date : 14 July 2014
	 * Description : manage weight class
	 */
	public function admin_weight_class_index()
	{
		$this->loadModel('WeightClass');
		$weights = $this->paginate('WeightClass');
		$this->set('weights', $weights);
		$this->render('admin_weight_class_index');
	}


}
