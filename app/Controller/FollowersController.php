<?php 

App::uses('Controller', 'Controller');

/**
 * Followers Controller
 *
 * Purpose : Manage follows
 * @project Crossfit
 * @since 1 July 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
 
class FollowersController extends AppController 
{
	public $name = 'Followers';
	public $components = array('RequestHandler','Uploader');
	public $helpers = array('Html', 'Form', 'Js');
	public $uses = array('Follower', 'User','Badge','FanProfile','Region');
	
	public function beforeFilter()
	{		
		parent::beforeFilter();
		
	}
	
	
	/**
	 * Method Name : follow
	 * Author Name : Vivek Sharma
	 * Date : 1 July 2014
	 * Description : Follow user
	 */
	 public function follow()
	 {
	 	$following_id = $this->data['following_id'];
		$user_id = $this->data['user_id'];
		
		$exist = $this->Follower->find('first', array('conditions' => array('Follower.user_id' => $user_id, 'Follower.following_id' => $following_id)));
		
		if ( empty($exist) )
		{
			$this->Follower->create();
			$this->Follower->save(array('user_id' => $user_id, 'following_id' => $following_id, 'created' => date('Y-m-d H:i:s')));
			
			$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id),
													'fields' => array('User.first_name', 'User.last_name', 'User.email')));
													
			
			$arr = array('from_id' => $user_id, 'to_id' => $following_id, 'from_first_name' => $user['User']['first_name'], 
							'from_last_name' => $user['User']['last_name'], 'from_email' => $user['User']['email'],'subject' => 'New Fan!', 'message' => 'New Fan!',
								'type' => '2','created' => date('Y-m-d H:i:s'));
			
			$this->loadModel('Message');
			$this->Message->create();
			$this->Message->save($arr);
		}
		echo 'success'; die;	 	
	 }
	 
	 /**
	 * Method Name : unfollow
	 * Author Name : Vivek Sharma
	 * Date : 1 July 2014
	 * Description : Unfollow user
	 */
	 public function unfollow()
	 {
	 	$following_id = $this->data['following_id'];
		$user_id = $this->data['user_id'];
		
		$exist = $this->Follower->find('first', array('conditions' => array('Follower.user_id' => $user_id, 'Follower.following_id' => $following_id)));
		
		if ( !empty($exist) )
		{
			$this->loadModel('Message');
			$this->Message->deleteAll(array('Message.type' => '2', 'Message.from_id' => $exist['Follower']['user_id'], 'Message.to_id' => $exist['Follower']['following_id']));
			$this->Follower->delete($exist['Follower']['id']);
		}
		echo 'success'; die;	 	
	 }

	 /**
	 * Method Name : get_athlete_followers
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : get latest 3 followers of athlete
	 */
	 public function get_athlete_followers($user_id)
	 {
	 	$this->Follower->bindModel(array('belongsTo' => array(
	 													'User' => array(
	 															'className' => 'User', 
	 															'foreignKey' => 'user_id',
	 															'fields' => array('User.id','User.first_name', 'User.last_name', 'User.username', 'User.photo')
															)
														)
									));
	 	$followers = $this->Follower->find('all', array('conditions' => array('Follower.following_id' => $user_id),'limit' => 3,'order' => array('Follower.created' => 'desc')));
		
		$data = '';
		
		if ( !empty($followers) )
		{
			foreach($followers as $fr)
			{
				$data.='<li><a href="'.$this->webroot.'profile/'.$fr['User']['username'].'" target="_blank"><img src="'.$this->webroot.'files/'.$fr['User']['id'].'/thumb_'.$fr['User']['photo'].'" alt="" /><span>'.$fr['User']['first_name'].'</span></a></li>';
			}
		}else{
			$data.='<li>No fans yet</li>';
		}
		
		echo $data; die;
	 }
	 
	 
	 /**
	 * Method Name : get_all_followers
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : get all followers
	 */
	 public function get_all_followers($user_id)
	 {
	 	if ( !empty($user_id) )
		{
			$this->Follower->bindModel(array('belongsTo' => array(
	 													'User' => array(
	 															'className' => 'User', 
	 															'foreignKey' => 'user_id',
	 															'fields' => array('User.id','User.first_name', 'User.last_name', 'User.username', 'User.photo')
															)
														)
									));
	 		$followers = $this->Follower->find('all', array('conditions' => array('Follower.following_id' => $user_id),'order' => array('Follower.created' => 'desc')));
			
			//pr($followers); die;
			$this->set('followers', $followers);
			$this->render('all_fans');
		
		}else{
			
			$this->Session->setFlash(__('Invalid request.'),'default',array(),'error');
			$this->redirect($this->referer());
		}
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
		//pr($badges); die;
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
				if ( empty($data['FanProfile']['id']) )
				{
					$this->FanProfile->create();	
				
				} else {
					
					$data['FanProfile']['last_modified'] = date('Y-m-d H:i:s');
					$this->FanProfile->id = $data['FanProfile']['id'];
				}
							
				$this->FanProfile->save($data['FanProfile']);
				
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
	
		$this->User->bindModel(array('hasOne' => array('FanProfile' => array('className' => 'FanProfile', 'foreignKey' => 'user_id'))));
		$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));		
	
		$regions = array();		
				
		$regions = $this->Region->find('list',array('order' => array('Region.name' => 'asc')));
		
		$this->request->data = $user; 
		
		$this->set('fan_profile_id',$user['FanProfile']['id']);
		$this->set('regions', $regions);				
		$this->set('user', $user);	
		
		$this->render('manage_profile');				
					
	 }	 


	 /**
	 * Method Name : athletes_i_follow
	 * Author Name : Vivek Sharma
	 * Date : 26 August 2014
	 * Description : get athletes i follow for fan dashboard display
	 */
	 public function athletes_i_follow($user_id)
	 {
	 	if ( !empty($user_id) )
		{
			$this->layout = 'ajax';				
			$data = $this->set_followers_data($user_id);
			
			$this->set('data', $data);
			$this->render('athletes_i_follow');
		}
	 }


	public function set_followers_data($user_id)
	{
		$this->loadModel('User');
			$this->loadModel('EventRegistration');
			$this->loadModel('Event');
			
			$this->Follower->recursive = 4;
			
			$this->Event->bindModel(array('hasMany' => array('EventRegistration' => array('className' => 'EventRegistration',
																							'foreignKey' => 'event_id',
																							'fields' => array('final_score','user_id')))));
			
			
			
			$this->EventRegistration->bindModel(array('belongsTo' => array('Event' => array('className' => 'Event',
																							'foreignKey' => 'event_id',
																							'fields' => array('Event.id', 'Event.title',
																												'Event.picture','Event.start_date')))));
			
			
			$this->User->bindModel(array('hasMany' => array('EventRegistration' => array('className' => 'EventRegistration',
																						 'foreignKey' => 'user_id',
																				 'conditions' => array('EventRegistration.payment_status' => 'Paid'),
																						 'fields' => array('EventRegistration.event_id',
																						 				'EventRegistration.payment_status',
																										'EventRegistration.final_score')))));		
			
			
			$this->Follower->bindModel(array('belongsTo' => array(
	 													'User' => array(
	 															'className' => 'User', 
	 															'foreignKey' => 'following_id',
	 															'fields' => array('User.id','User.first_name', 
	 																				'User.last_name', 'User.username', 
	 																				'User.photo')
															)
														)
									));
		 	$followers = $this->Follower->find('all', array('conditions' => array('Follower.user_id' => $user_id,'Follower.following_id IS NOT NULL'),
		 													'order' => array('Follower.created' => 'desc')));
			
			
			$data = array();
			
			if ( !empty($followers) )
			{
				$i = 0;
				
				foreach($followers as $fl)
				{
					$data[$i] = $fl;
					
					if ( !empty($fl['User']['EventRegistration']) )
					{
						$j=0;
						foreach($fl['User']['EventRegistration'] as $evr)
						{
							$myscore = $evr['final_score'];
							$data[$i]['User']['EventRegistration'][$j]['is_top_position'] = 1;
							
							if ( !empty($evr['Event']) )
							{
								if ( !empty($evr['Event']['EventRegistration']) )
								{
									foreach($evr['Event']['EventRegistration'] as $rg)
									{
										if ( !empty($rg['final_score']) && $rg['final_score'] < $myscore )
										{
											$data[$i]['User']['EventRegistration'][$j]['is_top_position'] = 0;
											break;
										}
									}
								} 
							}
							$j++; 
						}
					}
					$i++;
				}
			}
			
			
			return $data;
	}


}
	 