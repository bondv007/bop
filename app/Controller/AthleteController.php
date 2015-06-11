<?php 

App::uses('Controller', 'Controller');

/**
 * Athlete Controller
 *
 * Purpose : Manage Athlete
 * @project Crossfit
 * @since 29 July 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
 
class AthleteController extends AppController 
{
	public $name = 'Athlete';
	public $components = array('RequestHandler','Uploader');
	public $helpers = array('Html', 'Form', 'Js');
	public $uses = array('User','AthleteProfile','Region','Athlete','Badge');
	
	public function beforeFilter()
	{		
		parent::beforeFilter();	
		$this->Auth->allow(array('index','filter_affiliates'));	
	}
	
	
	/**
	 * Method Name : index	 
	 * Author Name : Vivek Sharma
	 * Date : 3 October 2014
	 * Description : athlete tab on frontend
	 */
	 public function index()
	 {
	 	$this->loadModel('PersonOfMonth');
	 	$this->loadModel('User');
	 	
		/**find all athletes*/
		
		$this->User->recursive = 2;
		
		$this->AthleteProfile->bindModel(array(
											'belongsTo' => array(
													'Region' => array('className' => 'Region', 'foreignKey' => 'region_id')
											)	
										));
		$this->User->bindModel(array(
									'hasOne' => array(
											'AthleteProfile' => array('className' => 'AthleteProfile', 
																		'foreignKey' => 'user_id'																		
																		)
									)	
								));
								
		$allathletes = $this->User->find('all',array(
							'conditions' => array('User.user_type' => 'athlete','User.status' => '1'),
							'fields' => array('id','username','first_name','last_name','photo')							
						));
		
		//pr($allathletes); die;
			
		$athletes = $regions = $map_data = $countries = array();
						
		if ( !empty($allathletes) )
		{
			$i = 0; $other_region = array();
			
			foreach($allathletes as $aff)
			{
				if ( isset($aff['AthleteProfile']['Region']['name']) )
				{
					$athletes[$aff['AthleteProfile']['Region']['name']][] = $aff;
					$regions[$aff['AthleteProfile']['Region']['id']] = $aff['AthleteProfile']['Region']['name'];
					
					if ( !empty($aff['AthleteProfile']['country']) && !in_array($aff['AthleteProfile']['country'], $countries) )
					{
						$countries[] =  $aff['AthleteProfile']['country'];
					}
					
					if ( isset($aff['AthleteProfile']['address']) && !empty($aff['AthleteProfile']['address']) )
					{
						$map_data[$i]['title'] = $aff['User']['username'];
						$map_data[$i]['address'] = $aff['AthleteProfile']['address'];
						$map_data[$i]['region'] = $aff['AthleteProfile']['Region']['name'];	
						$map_data[$i]['region_id'] = $aff['AthleteProfile']['Region']['id'];	
						//$map_data[$i]['country'] = $aff['AthleteProfile']['country'];	
						$i++;
					}
					
				}else{
					
					if ( !empty($aff['User']['photo']) )
					{
						$other_region[] = $aff;
					}						
				}								
			}

			if ( !empty($other_region) )
			{
				foreach($other_region as $other)
				{
					if ( !empty($aff['User']['photo']) )	
						$athletes['Athletes from Other Regions'][] = $other; 
			
				}
			}
		}
		//pr($map_data); die;
		$this->set('athletes', $athletes);
		$this->set('countries', $countries);
		$this->set('regions', $regions);
		$this->set('map_data', json_encode($map_data));
		
		/***Athlete of the month***/
		$this->PersonOfMonth->recursive = 3;
		
		$cur_year = date('Y');
		$max_year = $cur_year + 1;
				
		$this->PersonOfMonth->bindModel(array(
										'belongsTo' => array(
												'User' => array('className' => 'User', 
																'foreignKey' => 'user_id',
																'fields' => array('id','username','first_name',
																				'last_name','photo','profile_description'))
										)	
									));
 		
		$data = $this->PersonOfMonth->find('all',array(
							'conditions' => array('PersonOfMonth.user_type' => 'Athlete',
												  'PersonOfMonth.date >= ' => $cur_year.'-00-00',
												  'PersonOfMonth.date < ' => $max_year.'-00-00'),
							'order' => array('PersonOfMonth.date' => 'desc')
						));		
				
		
		$months_arr = array(
							date('Y').'-01-'.'01' => 'January',
							date('Y').'-02-'.'01' => 'February',
							date('Y').'-03-'.'01' => 'March',
							date('Y').'-04-'.'01' => 'April',
							date('Y').'-05-'.'01' => 'May',
							date('Y').'-06-'.'01' => 'June',
							date('Y').'-07-'.'01' => 'July',
							date('Y').'-08-'.'01' => 'August',
							date('Y').'-09-'.'01' => 'September',
							date('Y').'-10-'.'01' => 'October',
							date('Y').'-11-'.'01' => 'November',
							date('Y').'-12-'.'01' => 'December'
						);			
			
		$this->set('months_list', $months_arr);		
		$this->set('month_data', $data);
					
	 }
	 
	 
	 /**
	 * Method Name : filter_athletes	 
	 * Author Name : Vivek Sharma
	 * Date : 3 October 2014
	 * Description : filter athlete on region
	 */
	 public function filter_athletes()
	 {
		 if($this->request->is('post'))
		 {
			 	$this->layout = 'ajax';				
					
			 	$this->loadModel('PersonOfMonth');
			 	$this->loadModel('User');
			 	
				/**find all affiliates*/				
				$this->User->recursive = 2;
				
				$this->AffiliateProfile->bindModel(array(
													'belongsTo' => array(
															'Region' => array('className' => 'Region', 'foreignKey' => 'region_id')
													)	
												));
				$this->User->bindModel(array(
											'hasOne' => array(
													'AthleteProfile' => array('className' => 'AthleteProfile', 
																				'foreignKey' => 'user_id',
																				'conditions' => array('region_id' => $this->data['region'])																		
																				)
															)	
										));
										
				$allathletes = $this->User->find('all',array(
									'conditions' => array('User.user_type' => 'affiliate','User.status' => '1'),
									'fields' => array('id','username','first_name','last_name','photo')							
								));		
				
					
				$athletes = $regions = $map_data = $countries = array();
								
				if ( !empty($allathletes) )
				{
					$i = 0; $other_region = array();
					
					foreach($allathletes as $aff)
					{
						if ( isset($aff['AthleteProfile']['Region']['name']) )
						{
							$athletes[$aff['AthleteProfile']['Region']['name']][] = $aff;																	
						
						}else{					
							$other_region[] = $aff;								
						}								
					}
					
					if ( !empty($other_region) )
					{
						foreach($other_region as $other)
							$affiliates['Athletes from Other Regions'][] = $other; 
					}
					
				}
				
				$this->set('athletes', $athletes);	
				$this->render('filtered_athletes');	
		 }
		
	 }
	 
	 
	 /**
	 * Method Name : admin_athlete_of_month	 
	 * Author Name : Vivek Sharma
	 * Date : 3 October 2014
	 * Description : manage athlete of the month
	 */
	 public function admin_athlete_of_month()
	 {
	 	$this->loadModel('PersonOfMonth');
		$this->loadModel('User');
		
		$cur_year = $max_year = date('Y');
		
		if(isset($this->request->query['year']) && !empty($this->request->query['year']) && $this->request->query['year'] != $cur_year)
		{
			$cur_year = $this->request->query['year'];
			
		}else{
			$max_year +=1;
		}
		
		$this->PersonOfMonth->recursive = 3;
		
		$this->AthleteProfile->bindModel(array(
										'belongsTo' => array(
												'Region' => array('className' => 'Region', 'foreignKey' => 'region_id')
										)	
									));
		
		$this->User->bindModel(array(
									'hasOne' => array(
											'AthleteProfile' => array('className' => 'AthleteProfile', 
																		'foreignKey' => 'user_id'																		
																		)
									)	
								));
		
		$this->PersonOfMonth->bindModel(array(
										'belongsTo' => array(
												'User' => array('className' => 'User', 
																'foreignKey' => 'user_id',
																'fields' => array('id','username','first_name','last_name','photo'))
										)	
									));
 		
		$data = $this->PersonOfMonth->find('all',array(
							'conditions' => array('PersonOfMonth.user_type' => 'Athlete',
												  'PersonOfMonth.date >= ' => $cur_year.'-00-00',
												  'PersonOfMonth.date < ' => $max_year.'-00-00'),
							'order' => array('PersonOfMonth.date' => 'desc')
						));
		
		
		$this->set('year', $cur_year);
		$this->set('data',$data);
		$this->render('admin_manage_athlete_of_month');	
	 }


	/**
	 * Method Name : admin_add_athlete_of_month	 
	 * Author Name : Vivek Sharma
	 * Date : 3 October 2014
	 * Description : add athlete of the month
	 */
	 public function admin_add_athlete_of_month()
	 {
			
		if ( $this->request->is('Post') && !empty($this->request->data) )
		{
			$data = $this->data['PersonOfMonth'];
			
			//check if affiliate exist or not
			$athlete = $this->User->find('first', array('conditions' => array('User.id' => $data['user_id'],
																				'User.user_type' => 'athlete',
																				'User.status' => '1'),
														'fields' => array('User.id')
												));
			
			if ( !empty($athlete) )
			{
				$data['user_id'] = $athlete['User']['id'];
				$date =  $data['year'].'-'.str_pad($data['month'], 2, '0', STR_PAD_LEFT).'-'.'01'; 			
				$this->loadModel('PersonOfMonth');				
				
				//check if person of month already set for that month
				$already = $this->PersonOfMonth->find('first', array('conditions' => array('PersonOfMonth.user_type' => 'Athlete',
																							'PersonOfMonth.date' => $date)));
			    if ( !empty($already) )
				{
					$this->PersonOfMonth->id = $already['PersonOfMonth']['id'];
					$this->PersonOfMonth->save(array('user_id' => $data['user_id']));
				
				}else{
					
					$this->PersonOfMonth->create();
					$this->PersonOfMonth->save(array('user_id' => $data['user_id'], 
													 'user_type' => 'Athlete', 
													 'date' => $date, 
													 'last_updated' => date('Y-m-d H:i:s')));
				}
				
				$this->Session->setFlash(__('Athlete of month added successfully'),'default',array(),'success');				
				$this->redirect(array('action' => 'athlete_of_month', 'admin' => true));	
				
			}else{
				
				$this->Session->setFlash(__('Athlete does not exist'),'default',array(),'error');			
				$this->redirect($this->referer());				
 			}		
			
		}	
	 		
		$athletes = $this->User->find('list', array('conditions' => array('User.user_type' => 'athlete', 'User.status' => '1'),
														'fields' => array('User.id', 'User.username')));
		
		$this->set('athletes', json_encode($athletes));
		 
	 	$months = array();	 	
		for ($m=1; $m<=12; $m++) {
		     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
		     $months[$m] = $month;
		}
		
		$this->set('months', $months);
	 }


	/**
	 * Method Name : admin_delete_athlete_of_month	 
	 * Author Name : Vivek Sharma
	 * Date : 7 October 2014
	 * Description : delete athlete of the month
	 */
	 public function admin_delete_athlete_of_month($id = null)
	 {
	 	if ( !empty($id) )
		{
			$this->loadModel('PersonOfMonth');
			
			$data = $this->PersonOfMonth->findById($id);
			if ( !empty($data) )
			{
				$this->PersonOfMonth->delete($id);
				
				$this->Session->setFlash(__('Entry deleted successfully'),'default',array(),'success');
				$this->redirect($this->referer());
				
			}else{
				
				$this->Session->setFlash(__('Invalid Request'),'default',array(),'error');
				$this->redirect($this->referer());
			}
			
			
			
		}else{
			$this->redirect($this->referer());
		}
	 }
	
	
	/**
	 * Method Name : admin_get_all_athletes	 
	 * Author Name : Vivek Sharma
	 * Date : 3 October 2014
	 * Description : get all athletes names
	 */
	 public function admin_get_all_athletes()
	 {
	 	$key = $this->request->query['term'];		
		
		
		
	 	$athletes = $this->User->find('all', array('conditions' => array('OR' => array('LOWER(User.first_name) LIKE ' => '%'.strtolower($key).'%',
																						'LOWER(User.last_name) LIKE ' => '%'.strtolower($key).'%'),
	 																		 'User.user_type' => 'athlete',
																			 'User.status' => '1'),
														'fields' => array('User.id', 'User.first_name', 'User.last_name', 'User.username')));
		
		$results = array();
		
		if ( !empty($athletes) )
		{
			$i=0;
			foreach($athletes as $ath)
			{
				$results[$i]['value'] = $ath['User']['id'];
				$results[$i]['label'] = $ath['User']['first_name'].' '.$ath['User']['last_name'];
				$i++;
			}
		} 
		
		echo json_encode($results);
		die;												
		
	 }
	 
	
	
	/**
	 * Method Name : manage_profile	 
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : used to manage athlete profile
	 */
	 public function manage_profile()
	 {
		if ( !empty($this->request->data) )
		{	
			$data = $this->data;
			//pr($data); die;
			$username_exist = $this->User->find('count', array('conditions' => array('User.username' => $data['User']['username'],
																						'User.id != ' => $data['User']['id'])));
			
			if(empty($username_exist))
			{
				if ( empty($data['AthleteProfile']['id']) )
				{
					$this->AthleteProfile->create();	
				
				} else {
					
					$data['AthleteProfile']['last_modified'] = date('Y-m-d H:i:s');
					$this->AthleteProfile->id = $data['AthleteProfile']['id'];
				}
							
				$this->AthleteProfile->save($data['AthleteProfile']);
				
				if ( isset($data['User']['photo']) )
				{
					if ( empty($data['User']['photo']) || empty($data['User']['photo']['tmp_name']) || $data['User']['photo']['size'] <= 0)
					{
						unset($data['User']['photo']);
							
					}else{
						
						$image = $data['User']['photo'];
						unset($data['User']['photo']);
					}					
				}
				
				$this->User->id = $data['User']['id'];
				$this->User->save($data['User']);
				
				if ( isset($image) )
				{
					$image_array = $image;
					$user_id = $data['User']['id'];
					$image_info = pathinfo($image_array['name']);
					$image_new_name = $image_info['filename'].time().'_'.$user_id;
					
					
					$dest_dir = WWW_ROOT.'files/'.$user_id; 
					
					if (!is_dir($dest_dir))
					{
						mkdir($dest_dir, 0777);
					}
					$dest_dir = $dest_dir.DS;
					$thumbnails = Thumbnail::user_profile_thumbs();	
					$params = array('size'=>'500');
					$size_dimensions = array('width'=>20, 'height'=>20);	
					$this->Uploader->upload($image_array, $dest_dir , array(), $image_new_name, $params, $size_dimensions);	
					
					if ( $this->Uploader->error )
					{
						$file_error = $this->Uploader->errorMessage;
						
						$this->Session->setFlash(__('Error occured while uploading image'),'default',array(),'error');
						$this->Session->setFlash(__($file_error, 'error-messages' ),'default',array(),'error');	
					
					}else{
						$image_new_name = $this->Uploader->filename;
						$source_path = WWW_ROOT.'files'.DS.$user_id.DS.$image_new_name;
						$filedata = array(
							'source_path' => $source_path,
							'dest_dir' => $dest_dir,
							'file_name' => $image_new_name
						);
						$file_dimension = array(
							'width' => $this->request->data['w'],
							'height' => $this->request->data['h'],
							'x' => $this->request->data['x'],
							'y' => $this->request->data['y']
						);
						//pr($filedata); die;
						$this->Uploader->crop( $filedata, $file_dimension, $thumbnails , array('remove'=>false) );
					}
					
					$this->User->id = $data['User']['id'];
					$this->User->saveField('photo',$this->Uploader->filename);
				}
				
				
				$this->redirect(array('controller' => 'users', 'action' => 'profile'));
			}else{
				
				
				$this->Session->setFlash(__('Username already exist.'),'default',array(),'error');
			}
									
		} 		 
		 
		$user_id = $this->Auth->user('id');
	
		$this->User->bindModel(array('hasOne' => array('AthleteProfile' => array('className' => 'AthleteProfile', 'foreignKey' => 'user_id'))));
		$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));		
	
		$regions = array();		
				
		$regions = $this->Region->find('list',array('order' => array('Region.name' => 'asc')));
		
		$this->request->data = $user; 
		
		$this->set('athlete_profile_id',$user['AthleteProfile']['id']);
		$this->set('regions', $regions);				
		$this->set('user', $user);	
		
		$this->render('manage_profile');				
					
	 }	 

	 /**
	 * Method Name : manage_badges	 
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : used to manage badges
	 */
	 public function manage_badges()
	 {
		
		$this->paginate = array(
							'conditions' => array('Badge.user_id' => $this->Auth->user('id')),
							'limit' => '20'							
						);
		
		$badges = $this->paginate('Badge');
		$this->set('badges', $badges);
		$this->render('manage_badges');
	 } 
	 
	 /**
	 * Method Name : add_badge	 
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : used to add a new badge
	 */
	 public function add_badge()
	 {
	 	if ( !empty($this->request->data) )
		{
			$this->Badge->create();
			if($badge = $this->Badge->save($this->data))
			{
				$this->Session->setFlash(__('New Badge saved.'),'default',array(),'success');
				$this->redirect(array('action' => 'manage_badges'));
			}else{
				$this->Session->setFlash(__('Badge not saved.'),'default',array(),'error');
			}		
		}
	 	$this->set('user_id',$this->Auth->user('id'));
	 	$this->render('add_badge');
	 }
	 
	 /**
	 * Method Name : delete_badge	 
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : delete badge
	 */
	 public function delete_badge($id)
	 {
	 	if ( !empty($id) )
		{
			$badge = $this->Badge->findById($id);
			if ( !empty($badge) )
			{
				$this->Badge->delete($id);
				unlink($this->webroot.'files/badges/'.$id);
				$this->Session->setFlash(__('Badge removed successfully.'),'default',array(),'success');
			}else{
				$this->Session->setFlash(__('Badge not found.'),'default',array(),'error');
			}
		}else{
			$this->Session->setFlash(__('Invalid request.'),'default',array(),'error');
		}
		$this->redirect($this->referer());
	 }
	 
}