<?php 

App::uses('Controller', 'Controller');

/**
 * Affiliate Controller
 *
 * Purpose : Manage Affiliate
 * @project Crossfit
 * @since 4 June 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
 
class AffiliateController extends AppController 
{
	public $name = 'Affiliate';
	public $components = array('RequestHandler','Uploader');
	public $helpers = array('Html', 'Form', 'Js');
	public $uses = array('User','AffiliateProfile','Region','Coach','Athlete','Badge');
	
	public function beforeFilter()
	{		
		parent::beforeFilter();	
		$this->Auth->allow(array('index','filter_affiliates','accept_coach_invite','decline_coach_invite','accept_athlete_invite','decline_athlete_invite'));	
	}
	
	
	/**
	 * Method Name : index	 
	 * Author Name : Vivek Sharma
	 * Date : 29 August 2014
	 * Description : affiliate tab on frontend
	 */
	 public function index()
	 {
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
											'AffiliateProfile' => array('className' => 'AffiliateProfile', 
																		'foreignKey' => 'user_id'																		
																		)
									)	
								));
								
		$allaffiliates = $this->User->find('all',array(
							'conditions' => array('User.user_type' => 'affiliate','User.status' => '1'),
							'fields' => array('id','username','first_name','last_name','other_name','photo')							
						));
		
		//pr($allaffiliates); die;
			
		$affiliates = $regions = $map_data = $countries = array();
						
		if ( !empty($allaffiliates) )
		{
			$i = 0; $other_region = array();
			
			foreach($allaffiliates as $aff)
			{
				if ( isset($aff['AffiliateProfile']['Region']['name']) )
				{
					$affiliates[$aff['AffiliateProfile']['Region']['name']][] = $aff;
					$regions[$aff['AffiliateProfile']['Region']['id']] = $aff['AffiliateProfile']['Region']['name'];
					
					if ( !empty($aff['AffiliateProfile']['country']) && !in_array($aff['AffiliateProfile']['country'], $countries) )
					{
						$countries[] =  $aff['AffiliateProfile']['country'];
					}
					
					if ( isset($aff['AffiliateProfile']['location']) && !empty($aff['AffiliateProfile']['location']) )
					{
						$map_data[$i]['title'] = $aff['User']['other_name'];
						$map_data[$i]['address'] = $aff['AffiliateProfile']['location'];
						$map_data[$i]['region'] = $aff['AffiliateProfile']['Region']['name'];	
						$map_data[$i]['region_id'] = $aff['AffiliateProfile']['Region']['id'];	
						$map_data[$i]['country'] = $aff['AffiliateProfile']['country'];	
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
					$affiliates['Affiliates from Other Regions'][] = $other; 
			}

		}
		//pr($countries); die;
		$this->set('affiliates', $affiliates);
		$this->set('countries', $countries);
		$this->set('regions', $regions);
		$this->set('map_data', json_encode($map_data));
		
		/***Affiliate of the month***/
		$this->PersonOfMonth->recursive = 3;
		
		$cur_year = date('Y');
		$max_year = $cur_year + 1;
				
		$this->PersonOfMonth->bindModel(array(
										'belongsTo' => array(
												'User' => array('className' => 'User', 
																'foreignKey' => 'user_id',
																'fields' => array('id','username','other_name','first_name',
																				'last_name','photo','profile_description'))
										)	
									));
 		
		$data = $this->PersonOfMonth->find('all',array(
							'conditions' => array('PersonOfMonth.user_type' => 'Affiliate',
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
	 * Method Name : filter_affiliates	 
	 * Author Name : Vivek Sharma
	 * Date : 29 August 2014
	 * Description : filter affiliates on countries
	 */
	 public function filter_affiliates()
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
													'AffiliateProfile' => array('className' => 'AffiliateProfile', 
																				'foreignKey' => 'user_id',
																				'conditions' => array('region_id' => $this->data['region'])																		
																				)
															)	
										));
										
				$allaffiliates = $this->User->find('all',array(
									'conditions' => array('User.user_type' => 'affiliate','User.status' => '1'),
									'fields' => array('id','username','first_name','last_name','other_name','photo')							
								));		
				
					
				$affiliates = $regions = $map_data = $countries = array();
								
				if ( !empty($allaffiliates) )
				{
					$i = 0; $other_region = array();
					
					foreach($allaffiliates as $aff)
					{
						if ( isset($aff['AffiliateProfile']['Region']['name']) )
						{
							$affiliates[$aff['AffiliateProfile']['Region']['name']][] = $aff;																	
						
						}else{					
							$other_region[] = $aff;								
						}								
					}
					
					if ( !empty($other_region) )
					{
						foreach($other_region as $other)
							$affiliates['Affiliates from Other Regions'][] = $other; 
					}
					
				}
				
				$this->set('affiliates', $affiliates);	
				$this->render('filtered_affiliates');	
		 }
		
	 }
	 
	 
	 /**
	 * Method Name : admin_affiliate_of_month	 
	 * Author Name : Vivek Sharma
	 * Date : 29 August 2014
	 * Description : manage affiliate of the month
	 */
	 public function admin_affiliate_of_month()
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
		
		$this->AffiliateProfile->bindModel(array(
										'belongsTo' => array(
												'Region' => array('className' => 'Region', 'foreignKey' => 'region_id')
										)	
									));
		
		$this->User->bindModel(array(
									'hasOne' => array(
											'AffiliateProfile' => array('className' => 'AffiliateProfile', 
																		'foreignKey' => 'user_id'																		
																		)
									)	
								));
		
		$this->PersonOfMonth->bindModel(array(
										'belongsTo' => array(
												'User' => array('className' => 'User', 
																'foreignKey' => 'user_id',
																'fields' => array('id','username','other_name','first_name','last_name','photo'))
										)	
									));
 		
		$data = $this->PersonOfMonth->find('all',array(
							'conditions' => array('PersonOfMonth.user_type' => 'Affiliate',
												  'PersonOfMonth.date >= ' => $cur_year.'-00-00',
												  'PersonOfMonth.date < ' => $max_year.'-00-00'),
							'order' => array('PersonOfMonth.date' => 'desc')
						));
		
		
		$this->set('year', $cur_year);
		$this->set('data',$data);
		$this->render('admin_manage_affiliate_of_month');	
	 }


	/**
	 * Method Name : admin_add_affiliate_of_month	 
	 * Author Name : Vivek Sharma
	 * Date : 29 August 2014
	 * Description : add affiliate of the month
	 */
	 public function admin_add_affiliate_of_month()
	 {
			
		if ( $this->request->is('Post') && !empty($this->request->data) )
		{
			$data = $this->data['PersonOfMonth'];
			
			//check if affiliate exist or not
			$affiliate = $this->User->find('first', array('conditions' => array('User.other_name' => $data['user_id'],
																				'User.user_type' => 'affiliate',
																				'User.status' => '1'),
														'fields' => array('User.id')
												));
			
			if ( !empty($affiliate) )
			{
				$data['user_id'] = $affiliate['User']['id'];
				$date =  $data['year'].'-'.str_pad($data['month'], 2, '0', STR_PAD_LEFT).'-'.'01'; 			
				$this->loadModel('PersonOfMonth');				
				
				//check if person of month already set for that month
				$already = $this->PersonOfMonth->find('first', array('conditions' => array('PersonOfMonth.user_type' => 'Affiliate',
																							'PersonOfMonth.date' => $date)));
			    if ( !empty($already) )
				{
					$this->PersonOfMonth->id = $already['PersonOfMonth']['id'];
					$this->PersonOfMonth->save(array('user_id' => $data['user_id']));
				
				}else{
					
					$this->PersonOfMonth->create();
					$this->PersonOfMonth->save(array('user_id' => $data['user_id'], 
													 'user_type' => 'Affiliate', 
													 'date' => $date, 
													 'last_updated' => date('Y-m-d H:i:s')));
				}
				
				$this->Session->setFlash(__('Affiliate of month added successfully'),'default',array(),'success');				
				$this->redirect(array('action' => 'affiliate_of_month', 'admin' => true));	
				
			}else{
				
				$this->Session->setFlash(__('Affiliate does not exist'),'default',array(),'error');			
				$this->redirect($this->referer());				
 			}		
			
		}	
	 		
		$affiliates = $this->User->find('list', array('conditions' => array('User.user_type' => 'affiliate', 'User.status' => '1'),
														'fields' => array('User.id', 'User.other_name')));
		
		$this->set('affiliates', json_encode($affiliates));
		 
	 	$months = array();	 	
		for ($m=1; $m<=12; $m++) {
		     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
		     $months[$m] = $month;
		}
		
		$this->set('months', $months);
	 }


	/**
	 * Method Name : admin_delete_affiliate_of_month	 
	 * Author Name : Vivek Sharma
	 * Date : 7 October 2014
	 * Description : delete athlete of the month
	 */
	 public function admin_delete_affiliate_of_month($id = null)
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
	 * Method Name : admin_get_all_affiliates	 
	 * Author Name : Vivek Sharma
	 * Date : 3 October 2014
	 * Description : get all affiliate names
	 */
	 public function admin_get_all_affiliates()
	 {
	 	$key = $this->request->query['term'];		
		
	 	$affiliates = $this->User->find('list', array('conditions' => array('User.other_name LIKE ' => '%'.$key.'%',
	 																		 'User.user_type' => 'affiliate',
																			 'User.status' => '1'),
														'fields' => array('User.id', 'User.other_name')));
		
		echo json_encode($affiliates);
		die;												
		
	 }
	 
	
	/**
	 * Method Name : manage_profile	 
	 * Author Name : Vivek Sharma
	 * Date : 4 June 2014
	 * Description : used to manage affiliate profile
	 */
	 public function manage_profile()
	 {
		if ( !empty($this->request->data) )
		{	
			$data = $this->data;
			
			$username_exist = $this->User->find('count', array('conditions' => array('User.username' => $data['User']['username'],
																						'User.id != ' => $data['User']['id'])));
			
			if(empty($username_exist))
			{
				if ( empty($data['AffiliateProfile']['id']) )
				{
					$this->AffiliateProfile->create();	
				
				} else {
					
					$data['AffiliateProfile']['last_modified'] = date('Y-m-d H:i:s');
					$this->AffiliateProfile->id = $data['AffiliateProfile']['id'];
				}
							
				$this->AffiliateProfile->save($data['AffiliateProfile']);				
				
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
	
		$this->User->bindModel(array('hasOne' => array('AffiliateProfile' => array('className' => 'AffiliateProfile', 'foreignKey' => 'user_id'))));
		$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));		
	
		$coaches = $regions = array();		
		
		$this->Coach->bindModel(array('belongsTo' => array('User' => array('className' => 'User', 'foreignKey' => 'user_id'))));
		$allcoaches = $this->Coach->find('all',array('conditions' => array('Coach.affiliate_id' => $user_id,'Coach.user_id != '=>'','Coach.status' => 'Approved')));
		
		if ( !empty($allcoaches) )
		{
			foreach($allcoaches as $ach)
			{
				$coaches[$ach['Coach']['id']] = $ach['User']['first_name'].' '.$ach['User']['last_name'];	
			}	
		}		
		
		$regions = $this->Region->find('list',array('order' => array('Region.name' => 'asc')));
		
		$this->request->data = $user; 
		
		$this->set('affiliate_profile_id',$user['AffiliateProfile']['id']);
		$this->set('regions', $regions);
		$this->set('coaches',$coaches);				
		$this->set('user', $user);	
		
		$this->render('manage_profile');				
					
	 }	 
	 
	 
	 /**
	 * Method Name : manage_coaches	 
	 * Author Name : Vivek Sharma
	 * Date : 4 June 2014
	 * Description : used to manage coaches
	 */
	 public function manage_coaches()
	 {
		
		$this->paginate = array(
							'conditions' => array('Coach.affiliate_id' => $this->Auth->user('id')),
							'limit' => '20',
							'order' => array('Coach.first_name' => 'asc')
							
						);
		
		$coaches = $this->paginate('Coach');
		$this->set('coaches', $coaches);
		$this->render('manage_coaches');
	 }
	 
	 
	 /**
	 * Method Name : add_coach	 
	 * Author Name : Vivek Sharma
	 * Date : 4 June 2014
	 * Description : used to add new coaches
	 */
	 public function add_coach()
	 {
		$conditions = array('User.id != ' => $this->Auth->user('id'));

		//This section handles search filters
		if(isset($_GET['filter']))
		{
			$conditions = array_merge($conditions, array('User.'.$_GET['filter'].' Like ' => $_GET['search_keyword'].'%'));
		}	
				
		$this->paginate = array('limit'=>'10', 'conditions'=>$conditions);

		$users = $this->paginate('User');
		
		$already = $this->Coach->find('list',array('conditions'=>array('Coach.affiliate_id'=>$this->Auth->user('id')),
													'fields'=>array('Coach.user_id','Coach.email')));
		
		
		$this->set('already',$already);
		$this->set('users',$users);
		$this->set('affiliate_id',$this->Auth->user('id'));
		$this->render('add_coach');	
	 }
	 
	 
	  /**
	 * Method Name : connect_coach	 
	 * Author Name : Vivek Sharma
	 * Date : 10 June 2014
	 * Description : used to connect with exising coach on gameON 
	 */
	 public function connect_coach($id='')
	 {
	 			
	 		$already = $this->Coach->find('all', array('conditions' => array('Coach.user_id' => $id, 'Coach.affiliate_id' => $this->Auth->user('id'))));
																				
			//pr($already); die;																		
			
			if ( empty($already) )
			{
				$data = array('Coach' => array('affiliate_id' => $this->Auth->user('id')));				
				$user_already = $this->User->find('first',array('conditions'=>array('User.id'=>$id),
																'fields' => array('User.id','User.email','User.first_name','User.last_name','User.photo')));
				
				$data['Coach']['user_id'] = $user_already['User']['id'];
				$data['Coach']['first_name'] = $user_already['User']['first_name'];
				$data['Coach']['last_name'] = $user_already['User']['last_name'];
				$data['Coach']['email'] = $user_already['User']['email'];				
				$data['Coach']['photo'] = $user_already['User']['photo'];
				$data['Coach']['status'] = 'Pending';
				$data['Coach']['token'] = String::uuid();

				$this->Coach->create();
				$coach = $this->Coach->save($data);
				
				$affiliate_name = $this->Auth->user('first_name');	
				
				/* Send email to user */
				$this->loadModel('Emailtemplate');
				$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'Invite_gameon_coach')));
				$content = $email_content['Emailtemplate']['content'];
				$accept_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'accept_coach_invite', $coach['Coach']['token']), true).'">Click here </a>';
				$decline_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'decline_coach_invite', $coach['Coach']['token']), true).'">Click here </a>';
				
				$content = str_replace(array('{USERNAME}', '{ACCEPT_LINK}', '{DECLINE_LINK}', '{AFFILIATE}','{IMAGE}','{PROFILE_LINK}'), array(ucfirst($coach['Coach']['first_name']),$accept_url, $decline_url, $affiliate_name,'',''), $content);
				$email_content['Emailtemplate']['content'] = $content;
						
				
				$email = new CakeEmail('smtp');
				$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
					->to($coach['Coach']['email'])
					->emailFormat('html')
					->subject($email_content['Emailtemplate']['subject'])
					->send($content);	
					
				$this->Session->setFlash(__('An invitation has been sent to user. You will be informed if he/she accepts your invitation to connect as coach.'),'default',array(),'success');
				$this->redirect(array('action' => 'manage_coaches'));	
				
			} else {
				
				$this->Session->setFlash(__('You have already invited/added this user as coach earlier.'),'default',array(),'error');
				$this->redirect(array('action' => 'manage_coaches'));	
			}
			$this->redirect(array('action' => 'manage_coaches'));					
	 }
	 
	 
	 /**
	 * Method Name : add_new_coach	 
	 * Author Name : Vivek Sharma
	 * Date : 10 June 2014
	 * Description : used to add and connect with new coach
	 */
	 public function add_new_coach()
	 {
	 	if ( !empty($this->request->data) )
		{			
			$data = $this->data;
			
			$coach_already = $this->Coach->find('first',array('conditions'=>array('Coach.email'=>$data['Coach']['email'],'Coach.affiliate_id'=>$this->Auth->user('id'))));
			
			if( empty($coach_already) )
			{
				$user_already = $this->User->find('first',array('conditions'=>array('User.email'=>$data['Coach']['email']),
																	'fields' => array('User.id','User.email','User.first_name','User.last_name','User.photo')));
				
				if ( !empty($user_already) )
				{
					$data['Coach']['user_id'] = $user_already['User']['id'];
				}		
	
				
				$data['Coach']['status'] = 'Pending';
				$data['Coach']['token'] = String::uuid();
							
				$this->Coach->create();
				
				$coach = $this->Coach->save($data);
				
				$affiliate_name = $this->Auth->user('first_name');	
				
				/* Send email to user */
				$this->loadModel('Emailtemplate');
				$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'Invite_gameon_coach')));
				$content = $email_content['Emailtemplate']['content'];
				$accept_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'accept_coach_invite', $coach['Coach']['token']), true).'" style="background: none repeat scroll 0 0 #555;color: #fff;
    padding: 3px; text-decoration: none;">Accept</a>';
				$decline_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'decline_coach_invite', $coach['Coach']['token']), true).'" style="background: none repeat scroll 0 0 #555;color: #fff;
    padding: 3px; text-decoration: none;">Decline</a>';
				
				$image = '<img src="'.SITE_URL.'files/coach/'.$coach['Coach']['id'].'/thumb_'.$coach['Coach']['photo'].'" alt=""/>';
				
				$profile_link = '<p>Profile Link: <a href="'.$coach['Coach']['profile_link'].'">'.$coach['Coach']['profile_link'].'</a></p>';
				
				$content = str_replace(array('{USERNAME}', '{ACCEPT_LINK}', '{DECLINE_LINK}', '{AFFILIATE}','{IMAGE}','{PROFILE_LINK}'), array(ucfirst($coach['Coach']['first_name'].' '.$coach['Coach']['last_name']), $accept_url, $decline_url, $affiliate_name, $image, $profile_link), $content);
				$email_content['Emailtemplate']['content'] = $content;
				
				//pr($content); die;
				
				$email = new CakeEmail('smtp');
				$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
					->to($coach['Coach']['email'])
					->emailFormat('html')
					->subject($email_content['Emailtemplate']['subject'])
					->send($content);	
					
				$this->Session->setFlash(__('An invitation has been sent to user. You will be informed if he/she accepts your invitation to connect as coach.'),'default',array(),'success');
				$this->redirect(array('action' => 'manage_coaches'));
			
			} else {
				$this->Session->setFlash(__('This User is already connected as Coach.'),'default',array(),'error');
				$this->redirect(array('action' => 'manage_coaches'));
			}
		}
	 	$this->set('affiliate_id',$this->Auth->user('id'));
	 }	
	 
		 
	
	 
	 /**
	 * Method Name : accept_coach_invite	 
	 * Author Name : Vivek Sharma
	 * Date : 4 June 2014
	 * Description : accept coach invitation
	 */
	 public function accept_coach_invite($key='')
	 {
		if ( !empty($key) )
		{
			$coach = $this->Coach->find('first',array('conditions' => array('Coach.token' => $key)));
			
			if ( !empty($coach) )
			{
				if ( $coach['Coach']['status'] == 'Pending' )
				{
					$this->Coach->id = $coach['Coach']['id'];
					$this->Coach->save(array('status' => 'Approved'));	
					
					$affiliate = $this->User->findById($coach['Coach']['affiliate_id'],array('first_name','last_name','email'));
					
					/* Send email to user */
					$this->loadModel('Emailtemplate');
					$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'response_coach_invitation')));
					$content = $email_content['Emailtemplate']['content'];
					
					$content = str_replace(array('{USERNAME}', '{COACH}', '{RESPONSE}'), array(ucfirst($affiliate['User']['first_name']), $coach['Coach']['first_name']. ' ' . $coach['Coach']['last_name'], 'accepted' ), $content);
					$email_content['Emailtemplate']['content'] = $content;
					
					$email = new CakeEmail('smtp');
					$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
						->to($affiliate['User']['email'])
						->emailFormat('html')
						->subject($email_content['Emailtemplate']['subject'])
						->send($content);
						
					$user = $this->User->find('first',array('conditions'=>array('User.email'=>$coach['Coach']['email'])));
					
					if ( empty($user) )
					{
						$arr = array(); 	
						$arr['User'] = $coach['Coach'];
						$password = mt_rand(10000000, 999999999);
						
						$arr['User']['password'] = $this->Auth->password($password);
						$arr['User']['user_type'] = 'coach';
						$arr['User']['role'] = 'user';
						$arr['User']['status'] = 1;
						$arr['User']['created'] = $arr['modified'] = date('Y-m-d H:i:s');
						
						
						$this->User->create();
						$user = $this->User->save($arr);
						
									
						/* Send email to user */
						
						$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'Registration_details')));
						$content = $email_content['Emailtemplate']['content'];
						$content = str_replace(array('{USERNAME}','{EMAIL}','{PASSWORD}'), array(ucfirst($user['User']['first_name']),$user['User']['email'],$password), $content);
						$email_content['Emailtemplate']['content'] = $content;
						
						//~ die;
						$user_email = new CakeEmail('smtp');
						
						
						$user_email->from(array (ADMIN_EMAIL => APPLICATION_NAME));
						$user_email->to($user['User']['email']);
						$user_email->emailFormat('html');
						$user_email->subject($email_content['Emailtemplate']['subject']);
						$user_email->send($content);				
						
					}
					
					$user_id = $user['User']['id'];
					//Update user id in athlete table 
					$this->Coach->id = $coach['Coach']['id'];
					$this->Coach->save(array('user_id'=>$user_id));
					
					
					$message = 'approved';
					
				} else {
					
					$message = 'already';						
				}
			} else {
				$message = 'invalid';	
			}	
		} else {
			$message = 'invalid';	
		}	
		
		$this->set('message',$message);
		$this->set('type','coach');
		$this->render('invitation_response_page');
	 }
	 
	 /**
	 * Method Name : decline_coach_invite	 
	 * Author Name : Vivek Sharma
	 * Date : 4 June 2014
	 * Description : accept coach invitation
	 */
	 public function decline_coach_invite($key='')
	 {
		if ( !empty($key) )
		{
			$coach = $this->Coach->find('first',array('conditions' => array('Coach.token' => $key)));
			
			if ( !empty($coach) )
			{
				if ( $coach['Coach']['status'] == 'Pending' )
				{
					$this->Coach->id = $coach['Coach']['id'];
					$this->Coach->save(array('status' => 'Declined'));	
					
					$affiliate = $this->User->findById($coach['Coach']['affiliate_id'],array('first_name','last_name','email'));
					
					/* Send email to user */
					$this->loadModel('Emailtemplate');
					$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'response_coach_invitation')));
					$content = $email_content['Emailtemplate']['content'];
					
					$content = str_replace(array('{USERNAME}', '{COACH}', '{RESPONSE}'), array(ucfirst($affiliate['User']['first_name']), $coach['Coach']['first_name']. ' ' . $coach['Coach']['last_name'], 'declined' ), $content);
					$email_content['Emailtemplate']['content'] = $content;
					
					$email = new CakeEmail('smtp');
					$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
						->to($affiliate['User']['email'])
						->emailFormat('html')
						->subject($email_content['Emailtemplate']['subject'])
						->send($content);
					
					
					$message = 'declined';
					
				} else {
					
					$message = 'already';						
				}
			} else {
				$message = 'invalid';	
			}	
		} else {
			$message = 'invalid';	
		}	
		
		$this->set('message',$message);
		$this->set('type','coach');
		$this->render('invitation_response_page');
		
	 }
	 
	 
	 
	 /**
	 * Method Name : manage_athletes	 
	 * Author Name : Vivek Sharma
	 * Date : 9 June 2014
	 * Description : used to manage coaches
	 */
	 public function manage_athletes()
	 {
		
		$this->paginate = array(
							'conditions' => array('Athlete.affiliate_id' => $this->Auth->user('id')),
							'limit' => '20',
							'order' => array('Athlete.first_name' => 'asc')
							
						);
		
		$athletes = $this->paginate('Athlete');
		$this->set('athletes', $athletes);
		$this->render('manage_athletes');
	 } 
	 
	 /**
	 * Method Name : add_athlete	 
	 * Author Name : Vivek Sharma
	 * Date : 9 June 2014
	 * Description : used to connect with athletes
	 */
	 public function add_athlete()
	 {
		$conditions = array('User.id != ' => $this->Auth->user('id'), 'User.user_type' => 'athlete');

		//This section handles search filters
		if(isset($_GET['filter']))
		{
			$conditions = array_merge($conditions, array('User.'.$_GET['filter'].' Like ' => $_GET['search_keyword'].'%'));
		}	

		$this->paginate = array('limit'=>'10', 'conditions'=>$conditions);

		$users = $this->paginate('User');
		
		$already = $this->Athlete->find('list',array('conditions'=>array('Athlete.affiliate_id'=>$this->Auth->user('id')),
													'fields'=>array('Athlete.user_id','Athlete.email')));
		
	
		$this->set('already',$already);
		
		$this->set('users',$users);
		$this->set('affiliate_id',$this->Auth->user('id'));
		$this->render('add_athlete');	
	 }


	 /**
	 * Method Name : connect_athlete	 
	 * Author Name : Vivek Sharma
	 * Date : 10 June 2014
	 * Description : used to connect with exising athletes on gameON 
	 */
	 public function connect_athlete($id='')
	 {
	 			
	 		$already = $this->Athlete->find('all', array('conditions' => array('Athlete.user_id' => $id, 'Athlete.affiliate_id' => $this->Auth->user('id'))));
																				
			//pr($already); die;																		
			
			if ( empty($already) )
			{
				$data = array('Athlete' => array('affiliate_id' => $this->Auth->user('id')));				
				$user_already = $this->User->find('first',array('conditions'=>array('User.id'=>$id),
																'fields' => array('User.id','User.email','User.first_name','User.last_name','User.photo')));
				
				$data['Athlete']['user_id'] = $user_already['User']['id'];
				$data['Athlete']['first_name'] = $user_already['User']['first_name'];
				$data['Athlete']['last_name'] = $user_already['User']['last_name'];
				$data['Athlete']['email'] = $user_already['User']['email'];				
				$data['Athlete']['photo'] = $user_already['User']['photo'];
				$data['Athlete']['status'] = 'Pending';
				$data['Athlete']['token'] = String::uuid();

				$this->Athlete->create();
				$athlete = $this->Athlete->save($data);
				
				$affiliate_name = $this->Auth->user('first_name');	
				
				/* Send email to user */
				$this->loadModel('Emailtemplate');
				$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'Invite_gameon_athlete')));
				$content = $email_content['Emailtemplate']['content'];
				$accept_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'accept_athlete_invite', $athlete['Athlete']['token']), true).'">Click here </a>';
				$decline_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'decline_athlete_invite', $athlete['Athlete']['token']), true).'">Click here </a>';
				
				$content = str_replace(array('{USERNAME}', '{ACCEPT_LINK}', '{DECLINE_LINK}', '{AFFILIATE}','{IMAGE}','{PROFILE_LINK}'), array(ucfirst($athlete['Athlete']['first_name'].' '.$athlete['Athlete']['last_name']),$accept_url, $decline_url, $affiliate_name,'',''), $content);
				$email_content['Emailtemplate']['content'] = $content;
				
				$email = new CakeEmail('smtp');
				$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
					->to($athlete['Athlete']['email'])
					->emailFormat('html')
					->subject($email_content['Emailtemplate']['subject'])
					->send($content);	
					
				$this->Session->setFlash(__('An invitation has been sent to user. You will be informed if he/she accepts your invitation to connect as athlete.'),'default',array(),'success');
				$this->redirect(array('action' => 'manage_athletes'));	
				
			} else {
				
				$this->Session->setFlash(__('You have already invited/added this user as athlete earlier.'),'default',array(),'error');
				$this->redirect(array('action' => 'manage_athletes'));	
			}
			$this->redirect(array('action' => 'manage_athletes'));					
	 }
	
	/**
	 * Method Name : add_new_athlete	 
	 * Author Name : Vivek Sharma
	 * Date : 10 June 2014
	 * Description : used to add and connect with new athlete
	 */
	 public function add_new_athlete()
	 {
	 	if ( !empty($this->request->data) )
		{			
			$data = $this->data;
			
			$athlete_already = $this->Athlete->find('first',array('conditions'=>array('Athlete.email'=>$data['Athlete']['email'],'Athlete.affiliate_id'=>$this->Auth->user('id'))));
			
			if( empty($coach_already) )
			{
				
				$user_already = $this->User->find('first',array('conditions'=>array('User.email'=>$data['Athlete']['email']),
																	'fields' => array('User.id','User.email','User.first_name','User.last_name','User.photo')));
				
				if ( !empty($user_already) )
				{
					$data['Athlete']['user_id'] = $user_already['User']['id'];
				}		
				
				$data['Athlete']['status'] = 'Pending';
				$data['Athlete']['token'] = String::uuid();
	
				$this->Athlete->create();
				$athlete = $this->Athlete->save($data);
				
				$affiliate_name = $this->Auth->user('first_name');	
				
				/* Send email to user */
				$this->loadModel('Emailtemplate');
				$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'Invite_gameon_athlete')));
				$content = $email_content['Emailtemplate']['content'];
				$accept_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'accept_athlete_invite', $athlete['Athlete']['token']), true).'" style="background: none repeat scroll 0 0 #555;color: #fff;
    padding: 3px; text-decoration: none;">Accept</a>';
				$decline_url = '<a href="'.Router::url(array('controller' => 'affiliate', 'action' => 'decline_athlete_invite', $athlete['Athlete']['token']), true).'" style="background: none repeat scroll 0 0 #555;color: #fff;
    padding: 3px; text-decoration: none;">Decline</a>';		
				
				
				$image = '<img src="'.SITE_URL.'files/athlete/'.$athlete['Athlete']['id'].'/thumb_'.$athlete['Athlete']['photo'].'" alt="'.$athlete['Athlete']['first_name'].' '.$athlete['Athlete']['last_name'].'"/>';
				
				$profile_link = '<p>Profile Link: <a href="'.$athlete['Athlete']['profile_link'].'">'.$athlete['Athlete']['profile_link'].'</a></p>';
				
				
				
				$content = str_replace(array('{USERNAME}', '{ACCEPT_LINK}', '{DECLINE_LINK}', '{AFFILIATE}','{IMAGE}','{PROFILE_LINK}'), array(ucfirst($athlete['Athlete']['first_name'].' '.$athlete['Athlete']['last_name']),$accept_url, $decline_url, $affiliate_name, $image, $profile_link), $content);
				$email_content['Emailtemplate']['content'] = $content;
				
				$email = new CakeEmail('smtp');
				$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
					->to($athlete['Athlete']['email'])
					->emailFormat('html')
					->subject($email_content['Emailtemplate']['subject'])
					->send($content);	
					
				$this->Session->setFlash(__('An invitation has been sent to user. You will be informed if he/she accepts your invitation to connect as athlete.'),'default',array(),'success');
				$this->redirect(array('action' => 'manage_athletes'));
			
			}else{
				$this->Session->setFlash(__('You are already connected to this user as athlete earlier.'),'default',array(),'error');
				$this->redirect(array('action' => 'manage_athletes'));	
			}
		}
	 	$this->set('affiliate_id',$this->Auth->user('id'));
	 }	
	
	
		 
	 
	 /**
	 * Method Name : accept_athlete_invite	 
	 * Author Name : Vivek Sharma
	 * Date : 9 June 2014
	 * Description : accept athlete invitation
	 */
	 public function accept_athlete_invite($key='')
	 {
		if ( !empty($key) )
		{
			$athlete = $this->Athlete->find('first',array('conditions' => array('Athlete.token' => $key)));
			
			if ( !empty($athlete) )
			{
				if ( $athlete['Athlete']['status'] == 'Pending' )
				{
					$this->Athlete->id = $athlete['Athlete']['id'];
					$this->Athlete->save(array('status' => 'Approved'));	
					
					$affiliate = $this->User->findById($athlete['Athlete']['affiliate_id'],array('first_name','last_name','email'));
					
					/* Send email to user */
					$this->loadModel('Emailtemplate');
					$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'response_athlete_invitation')));
					$content = $email_content['Emailtemplate']['content'];
					
					$content = str_replace(array('{USERNAME}', '{ATHLETE}', '{RESPONSE}'), array(ucfirst($affiliate['User']['first_name']), $athlete['Athlete']['first_name']. ' ' . $athlete['Athlete']['last_name'], 'accepted' ), $content);
					$email_content['Emailtemplate']['content'] = $content;
					
					$email = new CakeEmail('smtp');
					$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
						->to($affiliate['User']['email'])
						->emailFormat('html')
						->subject($email_content['Emailtemplate']['subject'])
						->send($content);
						
					$user = $this->User->find('first',array('conditions'=>array('User.email'=>$athlete['Athlete']['email'])));
					
					if ( empty($user) )
					{
						$arr = array(); 	
						$arr['User'] = $athlete['Athlete'];
						$password = mt_rand(10000000, 999999999);
						
						$arr['User']['password'] = $this->Auth->password($password);
						$arr['User']['user_type'] = 'athlete';
						$arr['User']['role'] = 'user';
						$arr['User']['status'] = 1;
						$arr['User']['created'] = $arr['modified'] = date('Y-m-d H:i:s');
						
						
						$this->User->create();
						$user = $this->User->save($arr);
						
									
						/* Send email to user */
						
						$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'Registration_details')));
						$content = $email_content['Emailtemplate']['content'];
						$content = str_replace(array('{USERNAME}','{EMAIL}','{PASSWORD}'), array(ucfirst($user['User']['first_name']),$user['User']['email'],$password), $content);
						$email_content['Emailtemplate']['content'] = $content;
						
						//~ die;
						$user_email = new CakeEmail('smtp');
						
						
						$user_email->from(array (ADMIN_EMAIL => APPLICATION_NAME));
						$user_email->to($user['User']['email']);
						$user_email->emailFormat('html');
						$user_email->subject($email_content['Emailtemplate']['subject']);
						$user_email->send($content);				
						
					}
					
					$user_id = $user['User']['id'];
					//Update user id in athlete table 
					$this->Athlete->id = $athlete['Athlete']['id'];
					$this->Athlete->save(array('user_id'=>$user_id));
					
					$message = 'approved';
					
				} else {
					
					$message = 'already';						
				}
			} else {
				$message = 'invalid';	
			}	
		} else {
			$message = 'invalid';	
		}	
		
		$this->set('message',$message);
		$this->set('type','athlete');
		$this->render('invitation_response_page');
	 }
	 
	 /**
	 * Method Name : decline_athlete_invite	 
	 * Author Name : Vivek Sharma
	 * Date : 9 June 2014
	 * Description : accept athlete invitation
	 */
	 public function decline_athlete_invite($key='')
	 {
		if ( !empty($key) )
		{
			$athlete = $this->Athlete->find('first',array('conditions' => array('Athlete.token' => $key)));
			
			if ( !empty($athlete) )
			{
				if ( $athlete['Athlete']['status'] == 'Pending' )
				{
					$this->Athlete->id = $athlete['Athlete']['id'];
					$this->Athlete->save(array('status' => 'Declined'));	
					
					$affiliate = $this->User->findById($athlete['Athlete']['affiliate_id'],array('first_name','last_name','email'));
					
					/* Send email to user */
					$this->loadModel('Emailtemplate');
					$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 'reply_to', 'subject', 'content'), 'conditions' => array('email_for' => 'response_athlete_invitation')));
					$content = $email_content['Emailtemplate']['content'];
					
					$content = str_replace(array('{USERNAME}', '{ATHLETE}', '{RESPONSE}'), array(ucfirst($affiliate['User']['first_name']), $athlete['Athlete']['first_name']. ' ' . $athlete['Athlete']['last_name'], 'declined' ), $content);
					$email_content['Emailtemplate']['content'] = $content;
					
					$email = new CakeEmail('smtp');
					$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
						->to($affiliate['User']['email'])
						->emailFormat('html')
						->subject($email_content['Emailtemplate']['subject'])
						->send($content);
					
					
					$message = 'declined';
					
				} else {
					
					$message = 'already';						
				}
			} else {
				$message = 'invalid';	
			}	
		} else {
			$message = 'invalid';	
		}	
		
		$this->set('message',$message);
		$this->set('type','coach');
		$this->render('invitation_response_page');
		
	 }

	
	 /**
	 * Method Name : manage_badges	 
	 * Author Name : Vivek Sharma
	 * Date : 9 June 2014
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
	 * Date : 9 June 2014
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
