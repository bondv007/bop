<?php

class AboutusController extends AppController 
{
	var $name = 'Aboutus';
	var $uses = array('Aboutus');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
	}
	
	/**
	 * Purpose : TO DISPLAY ABOUT US PAGE
	 * Created on : 2 May 2014
	 * Author : Nitin
	*/
	function index()
	{
		$row_video = $this->Aboutus->findByType('top_video');
		$result_block = $this->Aboutus->find('all', array('conditions' => array('Aboutus.type' => 'block'), 'order' => array('Aboutus.id' => 'desc')));
		$result_block_big = $this->Aboutus->find('all', array('conditions' => array('Aboutus.type' => 'block_big'), 'order' => array('Aboutus.id' => 'desc')));
		$result_sponsor = $this->Aboutus->find('all', array('conditions' => array('Aboutus.type' => 'sponsor'), 'order' => array('Aboutus.id' => 'desc')));
		$result_team = $this->Aboutus->find('all', array('conditions' => array('Aboutus.type' => 'team'), 'order' => array('Aboutus.id' => 'desc')));
		
		//TO GET THE BLOCK
		$this->loadModel('Block');
		$row_blk_ourcompany = $this->Block->get_block('aboutus_ourcompany');

		$this->set(compact('errors', 'row_video', 'result_block', 'result_block_big', 'result_sponsor', 'result_team', 'row_blk_ourcompany'));
	}
	
	/**
	 * Purpose : TO ADD VIDEO
	 * Created on : 2 May 2014
	 * Author : Nitin
	*/
	function admin_video()
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;

		$row = $this->Aboutus->findByType('top_video');
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if(!$error_flag)
			{
				$data_arr['Aboutus']['id'] = $row['Aboutus']['id'];
				if($this->Aboutus->save($data_arr))
				{
					$this->Session->setFlash(__('Updated successfully.'), 'flash_success');

					$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_video'));
				}
				else
				{
					$errors[] = "Error while operation, please try again.";
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}
		else
		{	
			$this->data = $row;
		}

		$this->set('view_title', 'Manage Video');
		$this->set(compact('errors', 'row'));
		$this->render('admin_video');
	}
	
	/**
	 * Purpose : FOR ADMIN TO LIST CERTIFICATES
	 * Input : 
	 * Created on : 31-Dec-2013
	 * Author : Nitin
	*/			
	function admin_blocklist() 
	{
		$cond_arr = array('Aboutus.type' => array('block', 'block_big'));

		if(count($this->params->query))
		{
			$srch_arr = $this->params->query;
			if(!empty($srch_arr['title']))
			{
				$cond_arr['or'] = array('Aboutus.title like' => '%'.$srch_arr['title'].'%');
			}
		}

		$this->paginate = array(
			'fields' => array('Aboutus.*'),
			'conditions' => $cond_arr, //array of conditions
			'order' => array('Aboutus.id' => 'desc'), //string or array defining order
			'limit' => (!empty($this->params->query['count'])?$this->params->query['count']:ADMIN_NUM_PER_PAGE),
			'offset' => 0
		);
		
		$result_arr = $this->paginate('Aboutus');
		
		$ARR_ABOUTUS_BLOCK_TYPE = Configure::read('ARR_ABOUTUS_BLOCK_TYPE');

		$this->set('view_title', 'Manage Blocks');
		$this->set(compact('result_arr', 'ARR_ABOUTUS_BLOCK_TYPE'));
	}

	/**
	 * Purpose : TO ADD CHANNEL
	 * Created on : 16 Oct 2013
	 * Author : Nitin
	*/
	function admin_blockadd()
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;

		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if($this->Aboutus->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_ABOUTUS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Aboutus']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					if(empty($data_arr['Aboutus']['type']))
					{
						$data_arr['Aboutus']['type'] = 'block';
					}
					
					if($data_arr['Aboutus']['type'] == 'block_big')
					{
						$data_arr['Aboutus']['desc'] = $data_arr['Aboutus']['content'];
					}
					
					if($this->Aboutus->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array(), $data_arr['Aboutus']['type']);
						}
						
						$this->Session->setFlash(__('Added successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_blocklist'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}

		$ARR_ABOUTUS_BLOCK_TYPE = Configure::read('ARR_ABOUTUS_BLOCK_TYPE');

		$this->set('view_title', 'Add Block');
		$this->set(compact('errors', 'ARR_ABOUTUS_BLOCK_TYPE'));
		$this->render('admin_blockform');
	}

	/**
	 * Purpose : TO ADD CHANNEL
	 * Created on : 16 Oct 2013
	 * Author : Nitin
	*/
	function admin_blockedit($id)
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		$this->Aboutus->id = $id;
		$row = $this->Aboutus->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if($this->Aboutus->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_ABOUTUS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Aboutus']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					if(empty($data_arr['Aboutus']['type']))
					{
						$data_arr['Aboutus']['type'] = 'block';
					}
					
					if($data_arr['Aboutus']['type'] == 'block_big')
					{
						$data_arr['Aboutus']['desc'] = $data_arr['Aboutus']['content'];
					}
					
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['Aboutus']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array('id' => $row['Aboutus']['id']), array(), $row['Aboutus']['type']);
						if(empty($_FILES['filename']['name']) && !empty($data_arr['Aboutus']['img_del']))
						{
							$data_arr['Aboutus']['filename'] = '';
						}
					}

					if($this->Aboutus->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array(), $data_arr['Aboutus']['type']);
						}
						
						$this->Session->setFlash(__('Updated successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_blocklist'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}
		else
		{
			if($row['Aboutus']['type'] == 'block_big')
			{
				$row['Aboutus']['content'] = $row['Aboutus']['desc'];
			}
					
			$this->data = $row;
		}

		$ARR_ABOUTUS_BLOCK_TYPE = Configure::read('ARR_ABOUTUS_BLOCK_TYPE');

		$this->set('view_title', 'Edit Block');
		$this->set(compact('errors', 'row', 'ARR_ABOUTUS_BLOCK_TYPE'));
		$this->render('admin_blockform');
	}
	
	/**
	 * Purpose : FOR ADMIN TO LIST CERTIFICATES
	 * Input : 
	 * Created on : 31-Dec-2013
	 * Author : Nitin
	*/			
	function admin_sponsorlist() 
	{
		$cond_arr = array('Aboutus.type' => 'sponsor');

		if(count($this->params->query))
		{
			$srch_arr = $this->params->query;
			if(!empty($srch_arr['title']))
			{
				$cond_arr['or'] = array('Aboutus.title like' => '%'.$srch_arr['title'].'%');
			}
		}

		$this->paginate = array(
			'fields' => array('Aboutus.*'),
			'conditions' => $cond_arr, //array of conditions
			'order' => array('Aboutus.id' => 'desc'), //string or array defining order
			'limit' => (!empty($this->params->query['count'])?$this->params->query['count']:ADMIN_NUM_PER_PAGE),
			'offset' => 0
		);
		
		$result_arr = $this->paginate('Aboutus');
		
		$ARR_STATUS = Configure::read('ARR_STATUS');

		$this->set('view_title', 'Manage Sponsors');
		$this->set(compact('result_arr', 'ARR_STATUS'));
	}

	/**
	 * Purpose : TO ADD CHANNEL
	 * Created on : 16 Oct 2013
	 * Author : Nitin
	*/
	function admin_sponsoradd()
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;

		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if($this->Aboutus->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_ABOUTUS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Aboutus']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					$data_arr['Aboutus']['type'] = 'sponsor';
					if($this->Aboutus->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array(), 'sponsor');
						}
						
						$this->Session->setFlash(__('Added successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_sponsorlist'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}

		$this->set('view_title', 'Add Sponsor');
		$this->set(compact('errors'));
		$this->render('admin_sponsorform');
	}

	/**
	 * Purpose : TO ADD CHANNEL
	 * Created on : 16 Oct 2013
	 * Author : Nitin
	*/
	function admin_sponsoredit($id)
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		$this->Aboutus->id = $id;
		$row = $this->Aboutus->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if($this->Aboutus->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_ABOUTUS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Aboutus']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['Aboutus']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array('id' => $row['Aboutus']['id']), array(), 'sponsor');
						if(empty($_FILES['filename']['name']) && !empty($data_arr['Aboutus']['img_del']))
						{
							$data_arr['Aboutus']['filename'] = '';
						}
					}

					if($this->Aboutus->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array(), 'sponsor');
						}
						
						$this->Session->setFlash(__('Updated successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_sponsorlist'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}
		else
		{
			$this->data = $row;
		}

		$this->set('view_title', 'Edit Sponsor');
		$this->set(compact('errors', 'row'));
		$this->render('admin_sponsorform');
	}

	/**
	 * Purpose : FOR ADMIN TO LIST CERTIFICATES
	 * Input : 
	 * Created on : 31-Dec-2013
	 * Author : Nitin
	*/			
	function admin_teamlist() 
	{
		$cond_arr = array('Aboutus.type' => 'team');

		if(count($this->params->query))
		{
			$srch_arr = $this->params->query;
			if(!empty($srch_arr['title']))
			{
				$cond_arr['or'] = array('Aboutus.title like' => '%'.$srch_arr['title'].'%');
			}
		}

		$this->paginate = array(
			'fields' => array('Aboutus.*'),
			'conditions' => $cond_arr, //array of conditions
			'order' => array('Aboutus.id' => 'desc'), //string or array defining order
			'limit' => (!empty($this->params->query['count'])?$this->params->query['count']:ADMIN_NUM_PER_PAGE),
			'offset' => 0
		);
		
		$result_arr = $this->paginate('Aboutus');
		
		$ARR_STATUS = Configure::read('ARR_STATUS');

		$this->set('view_title', 'Manage Team Members');
		$this->set(compact('result_arr', 'ARR_STATUS'));
	}

	/**
	 * Purpose : TO ADD CHANNEL
	 * Created on : 16 Oct 2013
	 * Author : Nitin
	*/
	function admin_teamadd()
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;

		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if($this->Aboutus->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_ABOUTUS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Aboutus']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					$data_arr['Aboutus']['type'] = 'team';
					if($this->Aboutus->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array(), 'team');
						}
						
						$this->Session->setFlash(__('Added successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_teamlist'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}

		$this->set('view_title', 'Add Team Member');
		$this->set(compact('errors'));
		$this->render('admin_teamform');
	}

	/**
	 * Purpose : TO ADD CHANNEL
	 * Created on : 16 Oct 2013
	 * Author : Nitin
	*/
	function admin_teamedit($id)
	{
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		$this->Aboutus->id = $id;
		$row = $this->Aboutus->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Aboutus->set($data_arr);

			if($this->Aboutus->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_ABOUTUS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Aboutus']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['Aboutus']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array('id' => $row['Aboutus']['id']), array(), 'team');
						if(empty($_FILES['filename']['name']) && !empty($data_arr['Aboutus']['img_del']))
						{
							$data_arr['Aboutus']['filename'] = '';
						}
					}

					if($this->Aboutus->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array(), 'team');
						}
						
						$this->Session->setFlash(__('Updated successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'aboutus', 'action' => 'admin_teamlist'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Aboutus->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}
		else
		{
			$this->data = $row;
		}

		$this->set('view_title', 'Edit Team Member');
		$this->set(compact('errors', 'row'));
		$this->render('admin_teamform');
	}

	/**
	 * Purpose : FOR ADMIN TO MAKE ACTION LIKE ACTIVE, INACTIVE AND DELETE
	 * Created on : 31-Dec-2013
	 * Author : Nitin
	*/
	function admin_manage_actions()
	{
		if(count($this->params['data']))
		{
			$message = '';

			$ids = $this->params['data']['list'];
			if(!empty($ids))
			{
				$task = $this->params['data']['task'];

				if($task == "delete")
				{
					$this->unlink_thumbs(UPLOAD_ABOUTUS_DIR, 'Aboutus', 'filename', array('Aboutus.id' => $ids));

					$this->Aboutus->deleteAll(array('Aboutus.id' => $ids), true);
					
					$message = 'Deleted successfully.';
				}
				elseif($task == "active")
				{
					$this->Aboutus->updateAll(array('Aboutus.status' => "1"), array('Aboutus.id' => $ids));
					$message = 'Activated successfully.';
				}
				elseif($task == "inactive")
				{
					$this->Aboutus->updateAll(array('Aboutus.status' => "2"), array('Aboutus.id' => $ids));
					$message = 'Inactivated successfully.';
				}

				$this->Session->setFlash($message, 'flash_success');
			}

			$this->redirect($this->referer());
		}
	}

}
?>
