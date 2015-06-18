<?php 

App::uses('Controller', 'Controller');

/**
 * Breed Controller
 *
 * Purpose : Manage Breed
 * @project Best of Pedigree
 * @since 18 June, 2015
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
class BreedsController extends AppController 
{
	public $uses = array('Breed');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	
	/**
	 * Method Name : admin_manage	 
	 * Author Name : Vivek Sharma
	 * Date : 18 June 2015
	 * Description : manage breed
	 */
	public function admin_manage() {
		
		$this->Breed->recursive = 0;
		
		$conditions = "Breed.status != 2";
		if ( !empty($this->request->query['keyword']))
		{
			$keyword = strtolower(trim($this->request->query['keyword']));
			$conditions	.= " AND ( LOWER(Breed.title)) LIKE '%" . $keyword . "%' ";
		}
		
		$this->paginate = array(
			'conditions' => $conditions,
			'order' => 'Breed.name asc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		
		$breed = $this->paginate('Breed');
		$this->set('breed', $breed);		
	}
	
	/**
	 * Method Name : admin_add
	 * Author Name : Vivek Sharma
	 * Date : 18 June 2015
	 * Description : add breed 
	 */
    public function admin_add()
    {
		if ($this->request->is('post'))
		{
			$errors = array();
			$add_errors = array();
			$error_flag = false;
	
			if(!empty($this->data))
			{
				$data_arr = $this->data;
				
				$this->Breed->set($data_arr);
	
				if($this->Breed->validates() && !$error_flag)
				{
					if(!empty($_FILES['filename']['name']))
					{
						$config['upload_path'] = UPLOAD_BREED_DIR;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']	= 1200;
						$config['encrypt_name'] = true;
	
						$this->Upload->initializes($config);
	
						if ($this->Upload->do_upload('filename'))
						{
							$imgdata_arr = $this->Upload->data();
							$data_arr['Breed']['filename'] = $imgdata_arr['file_name'];
						}
						else
						{
							$errors[] = $this->Upload->display_errors();
							$error_flag = true;
						}
					}
	
					if(!$error_flag)
					{
						
						if($this->Breed->save($data_arr))
						{
							if(!empty($_FILES['filename']['name']))
							{
								$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_BREED_DIR, 'Breed', 'filename', array(), 'breed');
							}
							
							$this->Session->setFlash(__('Breed added successfully'),'default',array(),'success');
	
							$this->redirect(array('controller' => 'breeds', 'action' => 'manage', 'admin' => true));
						}
						else
						{
							$errors[] = "Error while operation, please try again.";
						}
					}
				}
				else
				{
					$errors = $this->News->validationErrors;
					$errors = array_merge($errors, $add_errors);
				}
			}
		}				
    }
	
	
	/**
	 * Method Name : admin_view	 
	 * Author Name : Vivek Sharma
	 * Date : 18 June 2015
	 * Description : view breed 
	 */
    public function admin_view($id = null)
    {
		$this->Breed->id = $id;
		if (!$this->Breed->exists())
		{
			throw new NotFoundException(__('No Breed found'));
		}
		
		$breed = $this->Breed->read(null, $id);
		$this->set('breed', $breed);
    }
	
	
	/**
	 * Method Name : admin_edit	 
	 * Author Name : Vivek Sharma
	 * Date : 18 June 2015
	 * Description : edit breed
	 */
    public function admin_edit($id = null)
    {
		$this->Breed->id = $id;
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		
		$row = $this->Breed->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Breed->set($data_arr);

			if($this->Breed->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_BREED_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Breed']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['Breed']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_BREED_DIR, 'Breed', 'filename', array('id' => $row['Breed']['id']), array(), 'breed');
						if(empty($_FILES['filename']['name']) && !empty($data_arr['Breed']['img_del']))
						{
							$data_arr['Breed']['filename'] = '';
						}
					}

					if($this->Breed->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_BREED_DIR, 'Breed', 'filename', array(), 'breed');
						}
						
						$this->Session->setFlash(__('Breed updated successfully'),'default',array(),'success');
	
						$this->redirect(array('controller' => 'breeds', 'action' => 'manage', 'admin' => true));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->News->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}
		else
		{
			$this->data = $row;
		}
		
		$this->render('admin_add');
    }
	
	
	/**
	 * Method Name : admin_delete	 
	 * Author Name : Vivek Sharma
	 * Date : 18 June 2015
	 * Description : delete Breed 
	 */
    public function admin_delete($id = null)
    {
		$this->Breed->id = $id;
		if (!$this->Breed->exists())
		{
			throw new NotFoundException(__('No Breed found'));
		}
		if ($this->Breed->delete())
		{
			$this->Session->setFlash(__('Breed deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'manage', 'admin' => true));
		}
		$this->Session->setFlash(__('Breed was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index', 'admin' => true));
    }
	
	
	
	
}
	