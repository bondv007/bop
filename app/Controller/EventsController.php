<?php 

App::uses('Controller', 'Controller');

/**
 * Events Controller
 *
 * Purpose : Manage events
 * @project Creators Exchange
 * @since 21 May 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
 
class EventsController extends AppController 
{
	public $name = 'Events';
	public $components = array('RequestHandler');
	public $helpers = array('Html', 'Form', 'Js');
	public $uses = array('Event', 'Eventprice', 'Wod', 'WodMovement', 'Movement', 'EventWod','EventRegistration', 'User','EventScore');
	
	public function beforeFilter()
	{		
		parent::beforeFilter();
		$this->Auth->allow('index', 'event_details', 'event_registration', 'filter_events','event_payment_details','registration_success');
	}
	
	
	/**
	 * Method Name : index
	 * Author Name : Vivek Sharma
	 * Date : 27 May 2014
	 * Description : display all upcoming events on frontend
	 */
	 public function index()
	 {
		// Get all upcoming event locations
		$locations = $this->Event->find('all',array('conditions' => array('Event.start_date >= ' => date('Y-m-d'), 'Event.status' => '1'), 
													'fields' => array('Event.location')));	
		
		$event_locations = array();
		
		if ( !empty($locations) )
		{
			foreach($locations as $loc)
			{
				if ( !in_array( $loc['Event']['location'], $event_locations ) )
				{
					$event_locations[] = $loc['Event']['location'];	
				}
			}
		}										
		
		 $this->paginate = array('conditions' => array('Event.start_date > ' => date("Y-m-d"), 'Event.status' => '1'),
		 						 'limit' => '6',
								  'order' => array('Event.start_date' => 'asc')
							 	);
		
		 $events = $this->paginate('Event');		 
		 $map_data = array(); 
		 
		 if ( !empty($events) )
		 {
			$i=0;
			
			foreach($events as $ev)
			{
				$map_data[$i]['title'] = $ev['Event']['title'];
				$map_data[$i]['address'] = $ev['Event']['location'];
				$map_data[$i]['type'] = $ev['Event']['event_type'];	
				$i++;
			}	
		 } 	
		
		 $this->set('map_data', json_encode($map_data));
		 $this->set('events', $events);
		 $this->set('locations', $event_locations);
	 }
	 
	 
	 /**
	 * Method Name : filter_events
	 * Author Name : Vivek Sharma
	 * Date : 28 May 2014
	 * Description : filter events depending upon type, date, location
	 */
	 public function filter_events()
	 {	
		
		if($this->request->is('post'))
		{			
			$this->layout = 'ajax';
			$data = $this->data;
			
			$conditions = array('Event.start_date >= ' => date('Y-m-d'), 'Event.status' => '1');
			
			// event type filter
			if( isset($data['event_type']) && !empty($data['event_type']) )
			{
				$conditions[] = "`Event.event_type` = '".$data['event_type']."'"; 
			}	
			
			// event location filter
			if( isset($data['event_location']) && !empty($data['event_location']) )
			{
				$conditions[] = "`Event.location` = '".$data['event_location']."'"; 
			}	
			
			// event date filter
			if( isset($data['event_date']) && !empty($data['event_date']) )
			{
				$conditions[] = "`Event.start_date` >= '".$data['event_date']."'"; 
			}	
			
			$this->paginate = array('conditions' => $conditions,
		 						 'limit' => '6',
								  'order' => array('Event.start_date' => 'asc')
							 	);
		
			$events = $this->paginate('Event'); 
			
			$this->set('data',$data);
			$this->set('events', $events);
			$this->render('filtered_events');
		}	
	 }
	 
	
	/**
	 * Method Name : create_event
	 * Author Name : Vivek Sharma
	 * Date : 21 May 2014
	 * Description : used to create new event
	 */
	public function create_event()
	{
		if ( $this->request->is('post') )
		{
			$data=$this->request->data;
			
			$data['Event']['user_id']=$this->Auth->user('id');
			
			//convert duration in days
			if($data['Event']['event_type'] == 'challenge')
			{			
				if($data['Event']['duration_type'] == 'weeks')
				{
					$data['Event']['duration'] = (int)$data['Event']['duration']*7;	
					
				}else if($data['Event']['duration_type'] == 'months')
				{
					$data['Event']['duration'] = (int)$data['Event']['duration']*30;		
				}		
			}
			else
			{
				$data['Event']['duration'] = '';	
			}	
			
			$this->Event->set($data);
			
			if($this->Event->validates())
			{
				$this->Event->create();
				
				if($event=$this->Event->save($data))
				{
					if(!empty($data['Eventprice']))
					{
						$i=0; 
						$event_price = array();
						
						foreach($data['Eventprice'] as $price)
						{
							$event_price[$i] = $price;
							$event_price[$i]['event_id'] = $event['Event']['id'];	
							$i++;
						}	
						
						$this->Eventprice->create();
						$this->Eventprice->saveAll($event_price);						
					}				
					
					if(!empty($data['Wod']))
					{
						$j=0;
						$wod_data = array();
						
						foreach($data['Wod'] as $wod)
						{
							foreach($wod['WodNum'] as $wdnum)
							{
								$weight_class = $wdnum['weight_class_id'];
								$age_group = $wdnum['age_group_id'];
								$wod_date = $wdnum['wod_date'];
								$score_type = $wdnum['score_type'];
								
								$score_sub_type = 'Least';
								
								if ($score_type == 'Time')
									$score_sub_type = $wdnum['score_sub_type'];
								
								foreach($wdnum['Movement'] as $wd)
								{
									$wod_data[$j] = $wd;
									$wod_data[$j]['event_id'] = $event['Event']['id'];
									$wod_data[$j]['weight_class_id'] = $weight_class;
									$wod_data[$j]['age_group_id']  = $age_group;
									$wod_data[$j]['wod_date'] = $wod_date;
									$wod_data[$j]['score_type'] = $score_type;
									$wod_data[$j]['score_sub_type'] = $score_sub_type;
									$j++;
								}
							}
						}								
						
						if(!empty($wod_data))
						{
							$this->EventWod->create();
							$this->EventWod->saveAll($wod_data);	
						}
					}
					
					if(isset($data['People']) && !empty($data['People']))
					{
						$this->Invite_people($event['Event']['id'],$data['People']);	
					}
					
					$this->Session->setFlash(__('Event saved successfully.'),'default',array(),'success');							
					$this->redirect(array('controller'=>'users'));
					
				}else{
					
					$this->Session->setFlash(__('Event not saved. Please try again'),'default',array(),'error');		
				}
			}else{
				
				$this->Session->setFlash(__($this->Event->validationErrors),'default',array(),'error');
			}			
		}	
	
		// get WOD category list
		$this->loadModel('Category');
		$categories = $this->Category->find('list',array('conditions' => array('Category.type' => 'wod') ));
		
		// get WOD types list
		$this->loadModel('WodType');
		$types = $this->WodType->find('list',array('conditions' => array('WodType.parent_id' => 0) ) );
		
		// get movements list
		$movements = $this->Movement->find('list');
		
		$this->set(compact('categories','types', 'movements'));
	}
	
	
	/**
	 * Method Name : add_division_popup
	 * Author Name : Vivek Sharma
	 * Date : 14 July 2014
	 * Description : used to display new division popup
	 */
	public function add_division_popup()
	{
		$this->layout = 'ajax';
		$this->render('add_division_popup');	
	}
	
	
	/**
	 * Method Name : add_division
	 * Author Name : Vivek Sharma
	 * Date : 21 May 2014
	 * Description : used to display new division wod blocks
	 */
	public function add_division()
	{
			$this->layout = 'ajax';
			
			$this->Wod->recursive = 2;
			$this->WodMovement->bindModel(array('belongsTo'=>array('Movement'=>array('className'=>'Movement','foreignKey'=>'movement_id'))));
			$this->Wod->bindModel(array('hasMany'=>array('WodMovement'=>array('className'=>'WodMovement','foreignKey'=>'wod_id'))));
			$wods = $this->Wod->find('all',array('order' => array('Wod.title'=>'asc'),
												'conditions' => array('Wod.wod_save_type' => '1')));
			
			$allwods = array();
			
			
			if( !empty($wods) )
			{
				$i = 0;
				foreach( $wods as $aff)
				{
					if( !in_array($aff['Wod']['id'], $allwods))
					{
						$allwods[$i]['label'] = $aff['Wod']['title'];
						$allwods[$i]['value'] = $aff['Wod']['id'];	
						$i++;
					}	
					
				}
			}
			$this->set('allwods', json_encode($allwods));		
												
			$this->loadModel('WeightClass');
			$weights = $this->WeightClass->find('all');
			
			$this->loadModel('AgeGroup');
			$age_groups = $this->AgeGroup->find('all');
			
			$this->set('weights', $weights);
			$this->set('age_groups', $age_groups);
			$this->set('wods',$wods);
			$this->set('data',$this->data);
			$this->render('add_wod');
	}
	
	
	/**
	 * Method Name : get_wod_details
	 * Author Name : Vivek Sharma
	 * Date : 21 May 2014
	 * Description : used to display wod details and movements
	 */
	 public function get_wod_details()
	 {
			$this->layout = 'ajax';
			$wod_id = $this->data['wod_id'];
			
			$this->Wod->recursive = 2;
			$this->WodMovement->bindModel(array('belongsTo'=>array('Movement'=>array('className'=>'Movement','foreignKey'=>'movement_id'))));
			$this->Wod->bindModel(array('hasMany'=>array('WodMovement'=>array('className'=>'WodMovement','foreignKey'=>'wod_id'))));
			$wod = $this->Wod->find('first',array('conditions'=>array('Wod.id'=>$wod_id)));
			
			$this->set('wod',$wod);	
			$this->set('ctr',$this->data['ctr']);
			$this->set('div',$this->data['div']);
			$this->set('division_sex',$this->data['division_sex']);
			$this->set('division',$this->data['division']);			
			$this->render('wod_details');	
	 }
	 
	 /**
	 * Method Name : get_by_type
	 * Author Name : Vivek Sharma
	 * Date : 21 May 2014
	 * Description : get sub type for WOD Type
	 */
	public function get_by_type() 
	{
		$this->layout = 'ajax';
		$type_id = $this->request->data['Wod']['type_id'];
 		$this->loadModel('WodType');
		$sub_types = $this->WodType->find('list', array(
			'conditions' => array('WodType.parent_id' => $type_id)
			));
		
		$data = '';
		
		foreach ($sub_types as $key => $value)
		{
			$data .= '<option value="'.$value.'">'.$value.'</option>';
		}	
		echo $data; die;
	}
	
	/**
	 * Method Name : save_custom_wod
	 * Author Name : Vivek Sharma
	 * Date : 21 May 2014
	 * Description : save custom WOD created by affiliate
	 */
	public function save_custom_wod()
	{
		if (!empty($this->request->data))
		{
			//pr($this->data); die;
			
			if($this->request->data['Wod']['select_wod'] == '1')
			{
				$response = $this->create_new_custom_wod($this->request->data);
			} else {
				
				//Call function to check if wod already exist			
				$result = $this->check_wod_exist($this->request->data);
				
				if ( $result['flag'] == '0' )
				{
					//Call function to create & save new wod
					$response = $this->create_new_custom_wod($this->request->data);
					
				} else {
					$response = array('status' => 'exist', 'wod_id' => $result['wod_id']);
				}					
			}		
			
			echo json_encode($response); die;
		}	
	}

	
	/**
	 * Method Name : create_new_custom_wod
	 * Author Name : Vivek Sharma
	 * Date : 20 June 2014
	 * Description : create & save new custom wod
	 */
	public function create_new_custom_wod($data)
	{
		$this->Wod->create();
			if ($wod = $this->Wod->save($data))
			{
				$last_inserted_id = $wod['Wod']['id'];
				
				// Save WOD movements
				if ( isset($data['Wod']['movement_category']) && (isset($data['Wod']['movement_option'])) )
				{					
					$movement_data = array();
					
					foreach ($data['Wod']['movement_category'] as $key => $value) {						
						
						$type = $data['Wod']['movement_option'][$key];
						$total_value = 0; $sub_type = '';
						
						if ( $data['Wod']['option_data'][$key] != '')
						{
							$total_value = $data['Wod']['option_data'][$key];
						}
						
						if ( $type == 'distance'){
							
							$sub_type = $data['Wod']['movement_distance'][$key];	
													
						}else if ( $type == 'load'){
							
							$sub_type = $data['Wod']['movement_load'][$key];
						}
						
						$movement_data['WodMovement'][] = array(
															'wod_id' => $last_inserted_id,
															'movement_id' => $value,
															'type' =>  $type,
															'value' => $total_value,
															'sub_type' => $sub_type
														);
					}
					
					$this->WodMovement->saveAll($movement_data['WodMovement']);
				}
								
				$response = array('status' => 'success', 
									'div' => $data['Wod']['div'],
									'ctr' => $data['Wod']['ctr'], 
									'num' => $data['Wod']['num'], 'wod_id' => $wod['Wod']['id'] ,
									'wod_title' => $wod['Wod']['title'], 'division' => $data['Wod']['division'], 
									'division_sex' => $data['Wod']['division_sex']);
							
			}else {
				
				$errors = $this->Wod->validationErrors;
				$response = array('status' => 'error', 'errors' => $errors);
				
			}
		return $response;
	}	
	
	
	/**
	 * Method Name : check_wod_exist
	 * Author Name : Vivek Sharma
	 * Date : 20 June 2014
	 * Description : function to check if wod already exist
	 */
	public function check_wod_exist($data)
	{
		$this->loadModel('WodMovement');
			
		$this->Wod->bindModel(array('hasMany' => array('WodMovement' => array( 'className'=> 'WodMovement', 'foreignKey' => 'wod_id'))));
		$exist = $this->Wod->find('all', array( 'conditions' => array( 'Wod.wod_type' => $data['Wod']['wod_type'], 'Wod.wod_save_type' => '1'),
												'fields' => array('Wod.id') ));
		//pr($exist); die;										
										
		$flag = 0; 	$response = array();									
		if ( !empty($exist) )
		{
			//Loop to check if existing wod have exactly same Wod movement numbers and values
				foreach($exist as $ex)
				{
					if( !empty($ex['WodMovement']) )
					{
						if ( count($ex['WodMovement'] == count($data['Wod']['movement_category'])))
						{
							$ctr = 0;
							foreach($ex['WodMovement'] as $wm)
							{
								for( $i=0; $i<count($data['Wod']['movement_category']); $i++)
								{
									$sb_type = null;	
									if ( $wm['type'] == 'distance'){
										$sb_type = $data['Wod']['movement_distance'][$i];							
									}else if ( $wm['type'] == 'load'){
										$sb_type = $data['Wod']['movement_load'][$i];
									}
									
									if ( ($wm['type'] == $data['Wod']['movement_option'][$i]) && 
													($wm['value'] == $data['Wod']['option_data'][$i]) &&
																($wm['sub_type'] == $sb_type) )
									{
										$ctr++;		
										$wod_id = $ex['Wod']['id'];	
										$response['wod_id'] = $wod_id;				
									}
								}
							}
							
							
							if($ctr == count($data['Wod']['movement_category']))
							{
								$flag = 1;
							}
						}
					}
				}
		}	
		$response['flag'] = $flag;
		
		return $response;
	}	
	
	/**
	 * Method Name : get_people
	 * Author Name : Vivek Sharma
	 * Date : 23 May 2014
	 * Description : get people for event invitation
	 */
	public function get_people()
	{
		$this->layout = 'ajax';
		
		$conditions[] = array('User.id != ' => $this->Auth->user('id'), 'User.status' => STATUS_ACTIVE);
		if( isset( $this->data['keyword']))
		{
			$conditions[] = array( 'OR' => array( 'User.first_name LIKE "%'. $this->data['keyword'] . '%"',
													'User.last_name LIKE "%'. $this->data['keyword'] . '%"'));	
		}
		
		$this->loadModel('User');
		$users = $this->User->find('all',array('conditions' => $conditions,'limit' => 20, 'order' => array('User.first_name asc', 'User.last_name asc')));
		$this->set('users',$users);
		$this->render('people_for_invite');	
	}
	
	/**
	 * Method Name : Invite_people
	 * Author Name : Vivek Sharma
	 * Date : 23 May 2014
	 * Description : Invite people for event
	 */
	public function Invite_people($event_id, $arr)
	{
		return;	
	}	
	
	/**
	 * Method Name : event_details
	 * Author Name : Vivek Sharma
	 * Date : 27 May 2014
	 * Description : display event details
	 */
	 public function event_details($event_id)
	 {
		if ( !empty($event_id) )
		{
			$this->Event->recursive = 2;
			
			$this->EventWod->bindModel(array('belongsTo' => array( 'Wod' => array( 'className' => 'Wod', 'foreignKey' => 'wod_id'))));
			$this->Event->bindModel(array('hasMany' => array('Eventprice' => array('className' => 'Eventprice', 
																					'foreignKey' => 'event_id', 
																					'order' => 'Eventprice.date asc'
																					),
															
															'EventWod' => array('className' => 'EventWod', 
																					'foreignKey' => 'event_id'																					
																					)
															)
											));
			$event = $this->Event->findById($event_id);	
			
			
			/**Check follower or not if logged in*/
			if ( $this->Session->check('Auth.User.id') )
			{
				$this->loadModel('Follower');
				$is_follow = $this->Follower->find('first', array('conditions' => array('Follower.user_id' => $this->Auth->user('id'),
																					'Follower.event_id' => $event_id),
																'fields' => array('Follower.id')));
				
				if ( !empty($is_follow) )
				{
					$this->set('is_follow', '1');
				}
			}
			
			$this->set('event',$event);
			$this->render('event_details');
		}
		else
		{
			$this->redirect(array('controller' => 'events', 'action' => 'index'));	
		}	
	 }
	 
	 /**
	 * Method Name : event_registration
	 * Author Name : Vivek Sharma
	 * Date : 27 May 2014
	 * Description : Registration for event
	 */
	 public function event_registration($event_id = null)
	 {
		if($this->request->is('post') && !empty($this->request->data))
		{
			$details = $this->data['EventRegistration'];
			$user_data = $this->data['User'];
			
			$arr = array();
			$arr['event_id'] = $details['event_id'];
			$arr['team_id'] = '';
			$arr['division'] = $details['division'];
			$arr['affiliate'] = $details['affiliate'];
			
			$user = $this->User->findByEmail($user_data['email']);
			
			if(empty($user) && isset($this->request->data['is_new_register']))
			{
				//check if user already registered for this event
				$registered_already = $this->EventRegistration->findByEmailAndEventId($user_data['email'],$details['event_id']);
				
				if ( empty($registered_already) )
				{
					$user_data['role'] = 'user';
					$user_data['user_type'] = 'athlete';
					$user_data['status'] = STATUS_ACTIVE ;
					
					$this->User->create();
					
					if ($user = $this->User->save($user_data) )
					{
						//update randomly generated user password 
						$lastInsertedId = $user['User']['id']; 
						$random_string = 'password';
						$user_data['password'] = $this->Auth->password($random_string);
						$this->User->saveField('password',$user_data['password']);
						
						
						$event_details = $this->Event->find('first',array('conditions' => array('Event.id' => $details['event_id']),
																		'fields' => array('Event.title')));
						
						/* Send email to user */
						$this->loadModel('Emailtemplate');
						$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 
																									'reply_to', 'subject', 'content'), 
																					'conditions' => array('email_for' => 'Event_registration')));
																					
						$content = $email_content['Emailtemplate']['content'];
					
						$content = str_replace(array('{USERNAME}', '{EVENT}' ,'{EMAIL}', '{PASSWORD}'), array(ucfirst($user['User']['first_name']), $event_details['Event']['title'], $user['User']['email'], $random_string), $content);
						$email_content['Emailtemplate']['content'] = $content;
						
						$email = new CakeEmail('smtp');
						$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
								->to($user['User']['email'])
								->emailFormat('html')
								->subject($email_content['Emailtemplate']['subject'])
								->send($content);
								
						$arr['user_id'] = $user['User']['id']; 		
							
					}else{
						$this->Session->setFlash(__('Please fill the required fields.'),'default',array(),'error');
						$this->redirect(array('controller' => 'users','action' => 'register'));	
					}
					
				}else{
					
					$this->Session->setFlash(__('Athlete already registered for this event.'),'default',array(),'error');
					$this->redirect(array('controller' => 'users','action' => 'register'));	
					
				}
								
								
						
			}else if (!empty($user)){
				
				if ( $user['User']['user_type'] == 'athlete' )
				{
					//check if user already registered for this event
					$registered_already = $this->EventRegistration->findByUserIdAndEventIdAndDivision($user['User']['id'], $details['event_id'], $details['division']);
					
					if ( empty($registered_already) )
					{
						// Update user details
						$this->User->id = $user['User']['id'];
						$this->User->save(array('date_of_birth' => $user_data['date_of_birth'], 'gender' => $user_data['gender']));
						
						$arr['user_id'] = $user['User']['id']; 
					
					}else{
						
						$this->Session->setFlash(__('Athlete already registered for this event.'),'default',array(),'error');
						$this->redirect($this->referer());							
					}
					
				}else{
					$this->Session->setFlash(__('Email id already registered as '. $user['User']['user_type']),'default',array(),'error');
					$this->request->data = $this->data;
					$this->redirect($this->referer());	
				}		
				
			}else{
				
				//check if user already registered for this event
				$registered_already = $this->EventRegistration->findByEmailAndEventId($user_data['email'], $details['event_id']);
				
				if ( empty($registered_already) )
				{
				
					$arr['first_name'] = $user_data['first_name'];
					$arr['last_name'] = $user_data['last_name'];
					$arr['email'] = $user_data['email'];
					$arr['dob'] = $user_data['date_of_birth'];
					$arr['gender'] = $user_data['gender'];
					
				}else{
											
					$this->Session->setFlash(__('Athlete already registered for this event.'),'default',array(),'error');
					$this->redirect(array('controller' => 'users','action' => 'register'));							
				}	
			}
			
			// Save registration information and update total event registrations
			if(isset($arr) && !empty($arr))
			{
				//create user session
				if ( isset($arr['user_id']) && !empty($arr['user_id']) )
				{
					$this->Auth->login($user['User']);	
				}				
								
				//save registration data
				$this->EventRegistration->create();
				$registration = $this->EventRegistration->save($arr);					
				
				$event = $this->Event->find('first',array('conditions' => array('Event.id' => $details['event_id']),
														'fields' => array('Event.number_of_registrations')));
				
				//Increment number of registrations in an event
				$this->Event->id = $details['event_id'];
				$this->Event->saveField('number_of_registrations',((int)$event['Event']['number_of_registrations'] + 1));
				
				$this->redirect(array('controller' => 'events', 'action' => 'event_payment_details', $registration['EventRegistration']['id']));											
			}
		}
		
		if ( !empty($event_id) )
		{	
			$this->Event->recursive = 2;
			$this->EventWod->bindModel(array('belongsTo' => array('Wod' => array('className' => 'Wod', 'foreignKey' => 'wod_id'))));
			$this->Event->bindModel(array('hasMany' => array('Eventprice' => array('className' => 'Eventprice', 'foreignKey' => 'event_id', 
																						'order' => 'Eventprice.date asc'),
															'EventWod' => array('clasName' => 'EventWod', 'foreignKey' => 'event_id'))));
															
			$event = $this->Event->findById($event_id);	
			
			//find all affiliates
			$all_affiliates = $this->User->find('all',array('conditions' => array('User.user_type' => 'affiliate', 'User.status' => '1'),
														'fields' => array('User.first_name', 'User.last_name','User.other_name')));
			
			$affiliates = array();
			
			if( !empty($all_affiliates) )
			{
				foreach( $all_affiliates as $aff)
				{
					if ( !empty($aff['User']['other_name']) )
					{
						if( !in_array($aff['User']['other_name'], $affiliates))
						{
							$affiliates[] = $aff['User']['other_name'];	
						}	
					}else{
						if( !in_array($aff['User']['first_name'].' '.$aff['User']['last_name'], $affiliates))
						{
							$affiliates[] = $aff['User']['first_name'].' '.$aff['User']['last_name'];	
						}	
					}
				}
			}			
			
			$i=0;
			$divisions = $wod_ids = array();
			
			if(!empty($event['EventWod']))
			{					
				foreach($event['EventWod'] as $wod) 
				{
					if ( !in_array($wod['division_type'],$wod_ids) )
					{
						$divisions[$wod['id']] = trim($wod['division_type']);
						$wod_ids[] = $wod['division_type'];
						$i++;	
					}	
					
				}
			}
			
			$this->set('user', $this->Auth->user());
			$this->set('event',$event);
			$this->set('divisions',$divisions);
			$this->set('affiliates', json_encode($affiliates));
			$this->render('event_registration');
		}
		else
		{
			$this->redirect(array('controller' => 'events', 'action' => 'index'));	
		}		
	 }
	 
	 
	 /**
	 * Method Name : event_payment_details
	 * Author Name : Vivek Sharma
	 * Date : 27 May 2014
	 * Description : Payment details for event registration from frontend
	 */
	 
	 public function event_payment_details($register_id = null)
	 {		
		if(!empty($register_id))
		{
			$this->EventRegistration->primaryKey='event_id';	
			$this->EventRegistration->bindModel(array('hasMany' => array('Eventprice' => array('className' => 'Eventprice', 'foreignKey' => 'event_id')),
														'belongsTo' => array('User' => array('className' => 'User', 'foreignKey' => 'user_id'))));
			$details = $this->EventRegistration->findById($register_id);			
			
			
			
			if ( !empty($details['Eventprice']) )
			{
				$cur_date = date('Y-m-d'); 				
				
				$min_diff = getDifference($details['Eventprice'][0]['date'], $cur_date);
				$total_cost =  $details['Eventprice'][0]['price'];
				 
				foreach($details['Eventprice'] as $price)
				{
					$diff =  getDifference($price['date'], $cur_date);
					if ( $diff > 0 && $diff < $min_diff)
					{
						$min_diff = $diff;
						$total_cost = $price['price'];
					}
				}
			}
			$recommended = $this->Event->find('all',array('conditions' => array('Event.start_date >= ' => date('Y-m-d'), 'Event.status' => '1'),
															'limit' => '2' ));	
			
			$this->set('recommended', $recommended);	
		
			
			$this->set('total_cost', $total_cost);
			$this->set('details',$details);
			$this->render('event_payment_details');
		}
		else
		{
			$this->redirect(array('controller' => 'events', 'action' => 'index'));		
		}	
	 }
	 
	 /**
	 * Method Name : registration_success
	 * Author Name : Vivek Sharma
	 * Date : 27 May 2014
	 * Description : Event registration successful page
	 */
	 public function registration_success($register_id = null)
	 {
		if ( !empty($register_id) )
		{
			$this->EventRegistration->bindModel(array('belongsTo' => array('User' => array('className' => 'User', 'foreignKey' => 'user_id'),
																			'Event' => array('className' => 'Event', 'foreignKey' => 'event_id')),
														'hasOne' => array('Payment' => array('className' => 'Payment', 'foreignKey' => 'registration_id'))));
			$details = $this->EventRegistration->findById($register_id);	
			
			$recommended = $this->Event->find('all',array('conditions' => array('Event.start_date >= ' => date('Y-m-d'), 'Event.status' => '1'),
															'limit' => '2' ));	
			
			$this->set('recommended', $recommended);			
			$this->set('details', $details);
		}
	 }	 
	 
	 /**
	 * Method Name : active_events
	 * Author Name : Vivek Sharma
	 * Date : 30 May 2014
	 * Description : List active events of affiliate
	 */
	 public function active_events()
	 {
		$this->paginate = array('conditions' => array('Event.user_id' => $this->Auth->user('id'),'Event.start_date > '=> date('Y-m-d'), 'Event.status' => '1'),
								'limit' => '20',
								'order' => array('Event.start_date' => 'desc'));
		
		$this->set('events', $this->paginate('Event'));
		$this->render('active_events');
	 }


	 /**
	 * Method Name : manage_events
	 * Author Name : Vivek Sharma
	 * Date : 21 August 2014
	 * Description : Manage events
	 */
	 public function manage_events()
	 {
		$allevents = $this->Event->find('all', array('conditions' => array('Event.user_id' => $this->Auth->user('id'), 'Event.status' => '1')));
													
		$past_ev = $active_ev = $future_ev = array();											
		
		if ( !empty($allevents) )
		{
			foreach($allevents as $event)
			{
				if ( $event['Event']['start_date'] < date('Y-m-d') )
				{
					$past_ev[$event['Event']['event_type']][] = $event;
				}else if( $event['Event']['start_date'] == date('Y-m-d') )
				{
					$active_ev[$event['Event']['event_type']][] = $event;
				}else{
					$future_ev[$event['Event']['event_type']][] = $event;
				}
			}
		}
		$this->set(compact('past_ev','active_ev','future_ev'));
		$this->render('manage_events');
	 }

	
	/**
	 * Method Name : event_scores
	 * Author Name : Vivek Sharma
	 * Date : 21 August 2014
	 * Description : manage event scores
	 */
	 public function event_scores($event_id, $division = null)
	 {
	 	
		$this->Event->recursive = 3;
	 	$this->EventRegistration->bindModel(
											array(
												'hasMany' => array(
													'EventScore' => array('className' => 'EventScore', 
																		  'foreignKey' => 'registration_id')
												),
												'belongsTo' => array(
													'User' => array(
																'className' => 'User',
																'foreignKey' => 'user_id',
																'fields' => array('User.id', 'User.first_name', 'User.last_name', 'User.email'),
																'order' => array('User.first_name' => 'asc')
														),
													'EventWod' => array(
															'className' => 'EventWod',
															'foreignKey' => 'division'
												        )
														
												)
											)		
										);
	 	$this->EventWod->bindModel(array(
										'belongsTo' => array(
															'Wod' => array(
																'className' => 'Wod',
																'foreignKey' => 'wod_id',
																'fields' => array('Wod.id','Wod.title')
															)
														)
									));
	 	$this->Event->bindModel(array(
									'hasMany' => array('EventRegistration' => array(
																'className' => 'EventRegistration',
																'foreignKey' => 'event_id',
																'order' => array('EventRegistration.final_score' => 'asc')
													        ),
														'EventWod' => array(
																'className' => 'EventWod',
																'foreignKey' => 'event_id'
															)
													)									
														
								));
	 	$event = $this->Event->find('first', array('conditions' => array('Event.id' => $event_id)));
		
		if ( $event['Event']['start_date'] <= date('Y-m-d') )
		{
			$this->set('is_score_editable', '1');			
		}
		
		
		if ( !empty($division) )
		{
			$this->set('division', $division);
		}
		//pr($event); die;
		$this->set('event', $event);
		$this->render('manage_event_scores'); 
	}
	 
	 
	 /**
	 * Method Name : update_score
	 * Author Name : Vivek Sharma
	 * Date : 21 August 2014
	 * Description : update athlete score of event 
	 */
	 public function update_score($event_id = null)
	 {
	 	if ( !empty($this->data) )
		{	
			$ids = explode("_", $this->data['id']);
			
			if ( $ids[0] == 'register' )
			{
				
				$this->EventRegistration->id = $ids[1];
				$this->EventRegistration->save(array('final_score' => $this->data['value']));				
				
			}else{
				
				$score_exist = $this->EventScore->find('first', array('conditions' => array('registration_id' => $ids[1],
																							'event_wod_id' => $ids[2], 
																							'event_id' => $event_id) ));
					
				if ( empty($score_exist) )
				{
					$arr = array(
							'event_id' => $event_id,
							'registration_id' => $ids[1],
							'event_wod_id' => $ids[2],
							'created' => date('Y-m-d H:i:s'),
							'modified' => date('Y-m-d H:i:s')
					);										
					
					$arr['score'] = trim($this->data['value']);									
						
					$this->EventScore->create();
					$this->EventScore->save($arr);
				
				}else{
					$arr = array('modified' => date('Y-m-d H:i:s'));				
					
					$arr['score'] = trim($this->data['value']);										
						
					$this->EventScore->id = $score_exist['EventScore']['id'];
					$this->EventScore->save($arr);
				}
				
								
			}
		} 
		echo  $this->data['value'];
		die;
	 }


	 /**
	 * Method Name : update_final_score
	 * Author Name : Vivek Sharma
	 * Date : 2 Sept 2014
	 * Description : update_final_score 
	 */
	 public function update_final_score($event_id = null)
	 {
	 	if ( !empty($event_id) )
		{
			$wod_count = $this->EventWod->find('count', array('conditions' => array('EventWod.event_id' => $event_id),
																'group' => array('EventWod.wod_id')));
																
			
													
			$scores = $this->EventScore->find('all', array('conditions' => array('EventScore.event_id' => $event_id)));	
			
			//pr($scores); die;
			$wod_data = array();
			
			if ( !empty($scores) )
			{
				foreach($scores as $sc)
				{
					$wod_data[$sc['EventScore']['event_wod_id']][] = $sc['EventScore'];
				}
			}
			
			//pr($wod_data);die;
			
			$sorted_data = array();
			
			//process data for sort score within a wod
			if ( !empty($wod_data) )
			{				
				foreach($wod_data as $wd)
				{
					$m=0;	
					foreach($wd as $w)
					{
						$wod_sub_type = $this->EventWod->find('first', array('conditions' => array('EventWod.id' => $w['event_wod_id']),
																			 'fields' => array('EventWod.score_type', 'EventWod.score_sub_type')));
						//pr($wod_sub_type); die;
						$wd[$m]['score_type'] = $wod_sub_type['EventWod']['score_type'];
						$wd[$m]['score_sub_type'] = $wod_sub_type['EventWod']['score_sub_type'];
						$m++;
					}						
						
					usort( $wd, "sortIt" );
					$sorted_data[] = $wd;		
				}
			}
			
			//pr($sorted_data); die;
			
			$all_final_scores = array();
			$result_data = array();
			$i = 0;
			
			//create score according to position
			if ( !empty($sorted_data) )
			{					
				foreach($sorted_data as $dat)
				{					
					if ( !empty($dat) )
					{
						$pos = 0;							
						foreach($dat as $pos => $details)
						{								
							$result_data[$details['registration_id']][$details['event_wod_id']] = $details;
							$result_data[$details['registration_id']][$details['event_wod_id']]['wod_score'] = $pos+1;
							$i++;
						}													
					}				
				}
			}
			
			//pr($result_data); die;
			
			if ( !empty($result_data) )
			{
				foreach($result_data as $reg_id => $reg_data)
				{
					foreach($reg_data as $info_data)
					{						
						if ( !isset($all_final_scores[$reg_id]) )
						{
							$all_final_scores[$reg_id] = 0;
						}					
																				
						$all_final_scores[$reg_id] += $info_data['wod_score'];						
					}
				}
			}
			
			//pr($all_final_scores); die;
			
			
			if ( !empty($all_final_scores) )
			{
				foreach($all_final_scores as $rg_id => $rg_score)
				{
					$this->EventRegistration->id = $rg_id;
					$this->EventRegistration->save(array('final_score' => $rg_score));
				}
			}
			echo 'success'; die;			
		}
		die;
	 }
	
	 /**
	 * Method Name : open_scoring
	 * Author Name : Vivek Sharma
	 * Date : 22 August 2014
	 * Description : toggle scoring edit 
	 */
	 public function toggle_scoring($event_id,$val)
	 {
	 	if ( $val == '1' )
		{
			$scoring_status = 'Open';
			$html = '<button class="red" onclick="toggle_scoring(0);">Close Scoring</button><input type="hidden" id="editable_val" value="0"/>';
				
		}else if ( $val == '0' )
		{
			$scoring_status = 'Closed';
			$html = '';
		}
		
		$this->Event->id = $event_id;
		$this->Event->save(array('scoring_status' => $scoring_status));
		
		echo $html; die;
	 }
	 
	 
	 /**
	 * Method Name : edit_event
	 * Author Name : Vivek Sharma
	 * Date : 30 May 2014
	 * Description : used to edit event
	 */
	 public function edit_event($event_id = null)
	 {
		if ( !empty($event_id) )
		{
			$this->Event->recursive = 3; 
			
			$this->EventWod->primaryKey = 'wod_id';
			
			$this->WodMovement->bindModel(array('belongsTo' => array('Movement' => array('className' => 'Movement', 'foreignKey' => 'movement_id'))));
			$this->EventWod->bindModel(array('hasMany' => array('WodMovement' => array('className' => 'WodMovement', 'foreignKey' => 'wod_id')),
											'belongsTo' => array('Wod' => array('className' => 'Wod', 'foreignKey' => 'wod_id'))));
			$this->Event->bindModel(array('hasMany' => array('EventWod' => array('className' =>'EventWod', 'foreignKey' => 'event_id'),
														'Eventprice' => array('className' => 'Eventprice', 'foreignKey' => 'event_id'))));
			$event = $this->Event->find('first', array('conditions' => array('Event.id' => $event_id)));
		
			if ( !empty($event) )
			{
				//Only allow event creator to edit event
				if ( $event['Event']['user_id'] == $this->Auth->user('id') ) 
				{
					$evWods = array(); $i=0;
					
					if ( !empty($event['EventWod']) )
					{
						foreach($event['EventWod'] as $wd)
						{
							$evWods[$wd['division_type']]['division_sex'] = $wd['division_sex'];
							$evWods[$wd['division_type']]['eventwod_id'] = $wd['id']; 
							$evWods[$wd['division_type']]['details'][$wd['wod_id']]['division_type'] = $wd['division_type'];
							$evWods[$wd['division_type']]['details'][$wd['wod_id']]['division_sex'] = $wd['division_sex'];
							$evWods[$wd['division_type']]['details'][$wd['wod_id']]['data'] = $wd;
														
							$i++;
						}
					}					
					
					$allwods = $this->Wod->find('all',array('order' => array('Wod.title'=>'asc')));
										
					// get WOD category list
					$this->loadModel('Category');
					$categories = $this->Category->find('list',array('conditions' => array('Category.type' => 'wod') ));
					
					// get WOD types list
					$this->loadModel('WodType');
					$types = $this->WodType->find('list',array('conditions' => array('WodType.parent_id' => 0) ) );
					
					// get movements list
					$movements = $this->Movement->find('list');
					
					$this->set(compact('categories','types', 'movements'));
					
					
					$this->loadModel('WeightClass');
					$weights = $this->WeightClass->find('all');
					
					$this->loadModel('AgeGroup');
					$age_groups = $this->AgeGroup->find('all');
					
					$this->set('weights', $weights);
					$this->set('age_groups', $age_groups);
									
					$this->set('allwods', $allwods);
					$this->set('eventWod', $evWods);
					$this->request->data = $event;
					$this->set('event',$event);	
					$this->render('edit_event');	
					
				} else {
					
					$this->Session->setFlash(__('You are not authorized to access that page.'),'default',array(),'error');
					$this->redirect(array('controller' => 'events', 'action' => 'index'));		
				}				
					
			} else {
				$this->redirect(array('controller' => 'events', 'action' => 'index'));	
			}			
			
		} else {
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}	
				 
	 }	 
	 
	 
	 /**
	 * Method Name : update_event
	 * Author Name : Vivek Sharma
	 * Date : 2 June 2014
	 * Description : used to save updated event
	 */
	 public function update_event()
	 {
		if ( !empty($this->request->data) )
		{			
			$data = $this->data;			
			$data['Event']['user_id']=$this->Auth->user('id');
			
			//Convert duration in days
			if($data['Event']['event_type'] == 'challenge')
			{			
				if($data['Event']['duration_type'] == 'weeks')
				{
					$data['Event']['duration'] = (int)$data['Event']['duration']*7;	
					
				}else if($data['Event']['duration_type'] == 'months')
				{
					$data['Event']['duration'] = (int)$data['Event']['duration']*30;		
				}		
			}
			else
			{
				$data['Event']['duration'] = '';	
			}			
			
			if ( empty($data['Event']['picture']) || empty($data['Event']['picture']['tmp_name']) || $data['Event']['picture']['size'] > 0)
			{
				unset($data['Event']['picture']);	
			}
			
			$this->Event->set($data);			
			
			if($this->Event->validates())
			{
				$event_id = $data['Event']['id'];
				unset($data['Event']['id']);
				
				$this->Event->id = $event_id;								
				
				if($event=$this->Event->save($data))
				{
					if(!empty($data['Eventprice']))
					{
						//delete old event pricing
						$this->Eventprice->deleteAll(array('Eventprice.event_id'=>$event_id),false);
						
						$i=0; 
						$event_price = array();
						
						foreach($data['Eventprice'] as $price)
						{
							$event_price[$i] = $price;
							$event_price[$i]['event_id'] = $event['Event']['id'];	
							$i++;
						}	
						
						$this->Eventprice->create();
						$this->Eventprice->saveAll($event_price);						
					}				
					
					if(!empty($data['Wod']))
					{
						$j=0;
						$wod_data = array();
						
						foreach($data['Wod'] as $wod)
						{
							foreach($wod['WodNum'] as $wdnum)
							{
								foreach($wdnum['Movement'] as $wd)
								{
									$wod_data[$j] = $wd;
									$wod_data[$j]['event_id'] = $event['Event']['id'];
									$j++;
								}
							}
						}									
						
						if(!empty($wod_data))
						{							
							$this->EventWod->deleteAll(array('EventWod.event_id'=>$event_id),false);
							
							$this->EventWod->create();
							$this->EventWod->saveAll($wod_data);	
						}
					}
					
					if(isset($data['People']) && !empty($data['People']))
					{
						$this->Invite_people($event['Event']['id'],$data['People']);	
					}
					
					$this->Session->setFlash(__('Event saved successfully.'),'default',array(),'success');							
					$this->redirect(array('controller'=>'users'));
					
				}else{
					
					$this->Session->setFlash(__('Event not saved. Please try again'),'default',array(),'error');		
				}	
			}	
		 }
		 		 
		}
		
		
	   /**
		* Method Name : update_event
		* Author Name : Vivek Sharma
		* Date : 2 June 2014
		* Description : used to save updated event
		*/
		
		public function delete_event_wod()
		{
			$eventWod_id = $this->data['id'];
			
			if ( !empty($eventWod_id) )
			{
				$this->EventWod->delete($id);
			}		
			die;
		}
		
		/**
		 * Method Name : manage_registrations	 
		 * Author Name : Vivek Sharma
		 * Date : 2 June 2014
		 * Description : List athletes registered for event
		 */
		
		public function manage_registrations($event_id)
		{			
			$this->paginate = array('conditions' => array('EventRegistration.event_id' => $event_id),
								'limit' => '20',
								'joins'=>array(
										
										array('table'=>'users', 'alias'=>'User', 'type'=>'inner', 'conditions'=>array('User.id = EventRegistration.user_id'))
								 ),
								'order' => array('User.first_name' => 'asc'),
								'fields'=>array('EventRegistration.*', 'User.*')
								);
			
			$users = $this->paginate('EventRegistration');
			$this->set('users', $users);		
			
			$this->render('manage_registrations');				
		}
	
	
		/**
		 * Method Name : event_registration_feeds	 
		 * Author Name : Vivek Sharma
		 * Date : 4 July 2014
		 * Description : get registration feeds
		 */
		public function event_registration_feeds($event_id = 0)
		{
			$this->layout = 'ajax';
			
			if ( $event_id == 0 )
			{			
				$events = $this->Event->find('list', array('conditions' => array('Event.user_id' => $this->Auth->user('id')),
															'fields' => array('Event.id', 'Event.title'),
															'order' => array('Event.start_date' => 'asc')));
			}else{
				$events = array($event_id => 1);
			}
			
			$users = array();	
			if ( !empty($events) )
			{
				$operator = '';
				if ( count($events) > 1 )
				{
					$operator = ' IN ';
				}
				$this->EventRegistration->bindModel(array(
												'belongsTo' => array(
														'User' => array(
																'className' => 'User',
																'foreignKey' => 'user_id'	
														)
												)
										)
						);
				$users = $this->EventRegistration->find('all', array('conditions' => array('EventRegistration.event_id '.$operator => array_keys($events)),
																		'fields' => array('User.username', 'User.first_name', 'User.last_name'																							
																							)
																	));	
				
			}	
													
			$this->set('users', $users);
			$this->render('event_registration_feeds');
			
		}
		
		
		
		/**
		 * Method Name : post_news	 
		 * Author Name : Vivek Sharma
		 * Date : 4 July 2014
		 * Description : post event news
		 */
		public function post_news()
		{
			if ( !empty($this->request->data) )
			{
				$data = $this->data;
				$data['Customfeed']['content'] = nl2br($data['Customfeed']['content']);
				$data['Customfeed']['user_id'] = $this->Auth->user('id');
				$data['Customfeed']['created'] = date('Y-m-d H:i:s');
				
				if ( isset($data['Customfeed']['is_public']) && $data['Customfeed']['is_public'] == '1' )
				{
					$data['Customfeed']['is_public'] = 'Yes';
				}else{
					$data['Customfeed']['is_public'] = 'No';
				}
				
				$this->loadModel('Customfeed');
				
				$this->Customfeed->create();
				$arr = $this->Customfeed->save($data);
				
				$event = $this->Event->find('first', array('conditions' => array('Event.id' => $arr['Customfeed']['event_id']),
															'fields' => array('Event.title')));
				
				$this->EventRegistration->bindModel(array(
											'belongsTo' => array(
													'User' => array(
															'className' => 'User',
															'foreignKey' => 'user_id'	
													)
											)
									)
					);
				$users = $this->EventRegistration->find('all', array('conditions' => array('EventRegistration.event_id ' => $arr['Customfeed']['event_id']),
																		'fields' => array('User.username', 'User.first_name', 'User.last_name','User.email'																							
																							)
																	));	
				if ( !empty($users) )
				{
					foreach($users as $us)
					{
						/* Send email to user */
						$this->loadModel('Emailtemplate');
						$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 
																									'reply_to', 'subject', 'content'), 
																					'conditions' => array('email_for' => 'Event_message')));
																					
						$content = $email_content['Emailtemplate']['content'];
					
						$content = str_replace(array('{USERNAME}', '{EVENT}' ,'{MESSAGE}'), array(ucfirst($us['User']['first_name']), $event['Event']['title'] , nl2br($arr['Customfeed']['content'])), $content);
						$email_content['Emailtemplate']['content'] = $content;
						
						$email = new CakeEmail('smtp');
						$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
								->to($us['User']['email'])
								->emailFormat('html')
								->subject($email_content['Emailtemplate']['subject'])
								->send($content);	
					}
				}
			}
			
			die;	
		}

	/**
	 * Method Name : nearby_events
	 * Author Name : Vivek Sharma
	 * Date : 24 July 2014
	 * Description : display all nearby events of athlete
	 */
	public function nearby_events()
	{
		$this->loadModel('Event');
				
		$events = $this->Event->find('all', array('conditions' => array('Event.status' => 1, 'Event.start_date > ' => date('Y-m-d'))));
		
		$nearby_events = array();
		
		$this->loadmodel('AthleteProfile');
		$profile = $this->AthleteProfile->findByUserId($this->Auth->user('id'));
		//pr($events); die;
		if ( !empty($profile) && !empty($profile['AthleteProfile']['latitude']))
		{
			if ( !empty($events) )
			{
				foreach($events as $ev)
				{
					$distance = getDistance($profile['AthleteProfile']['latitude'], $profile['AthleteProfile']['longitude'], $ev['Event']['latitude'], $ev['Event']['longitude']);
					
					if ( $distance < 50 )
						$nearby_events[] = $ev;
									
				}
			}
		}	

		$this->set('nearby_events', $nearby_events);
		$this->render('nearby_events');	
	}

	
	/**
	 * Method Name : my_events
	 * Author Name : Vivek Sharma
	 * Date : 24 July 2014
	 * Description : display all events of athlete
	 */
	public function my_events()
	{
		$this->loadModel('Event');
		$this->loadModel('EventRegistration');
		
		$this->EventRegistration->bindModel(array('belongsTo' => array('Event' => array('className' => 'Event', 'foreignKey' => 'event_id'))));
		$events = $this->EventRegistration->find('all', array('conditions' => array('EventRegistration.user_id' => $this->Auth->user('id'))));
		
									
		$this->set('events', $events);
		$this->render('my_events');	
	}
	
	
	/**
	 * Method Name : follow
	 * Author Name : Vivek Sharma
	 * Date : 26 August 2014
	 * Description : Follow event
	 */
	 public function follow()
	 {
	 	$event_id = $this->data['event_id'];
		$user_id = $this->data['user_id'];
		
		$this->loadModel('Follower');
		$exist = $this->Follower->find('first', array('conditions' => array('Follower.user_id' => $user_id, 'Follower.event_id' => $event_id)));
		
		if ( empty($exist) )
		{
			$this->Follower->create();
			$this->Follower->save(array('user_id' => $user_id, 'event_id' => $event_id, 'created' => date('Y-m-d H:i:s')));
		}
		echo 'success'; die;	 	
	 }
	 
	 /**
	 * Method Name : unfollow
	 * Author Name : Vivek Sharma
	 * Date : 26 August 2014
	 * Description : Unfollow event
	 */
	 public function unfollow()
	 {
	 	$event_id = $this->data['event_id'];
		$user_id = $this->data['user_id'];
		
		$this->loadModel('Follower');
		$exist = $this->Follower->find('first', array('conditions' => array('Follower.user_id' => $user_id, 'Follower.event_id' => $event_id)));
		
		if ( !empty($exist) )
		{
			$this->Follower->delete($exist['Follower']['id']);
		}
		
		echo 'success'; die;	 	
	 }
	 
	  /**
	 * Method Name : events I follow
	 * Author Name : Vivek Sharma
	 * Date : 26 August 2014
	 * Description : events which i follow
	 */
	public function events_i_follow($user_id = null)
	{
		if ( !empty($user_id) )
		{
			$this->layout = 'ajax';
			$this->loadModel('Follower');
			$this->loadModel('Event');
			
			$this->Follower->bindModel(array('belongsTo' => array('Event' => array('className' => 'Event', 'foreignKey' => 'event_id'))));
			$data = $this->Follower->find('all', array('conditions' => array('Follower.user_id' => $user_id, 'Follower.event_id IS NOT NULL')));
			$this->set('events', $data);
			
			$this->render('events_i_follow');
		}
	}
}
