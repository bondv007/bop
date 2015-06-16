<?php 

App::uses('Controller', 'Controller');

/**
 * Colors Controller
 *
 * Purpose : Manage Pet colors 
 * @project Best of Pedigree
 * @since 16 June, 2015
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
class ColorsController extends AppController 
{
	public $uses = array('PetColors');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	
	/**
	 * Method Name : admin_manage	 
	 * Author Name : Vivek Sharma
	 * Date : 16 June 2015
	 * Description : manage colors
	 */
	 public function admin_manage() {
	 	
	 	$this->PetColors->recursive = 0;
		
		$conditions = "";
		if ( !empty($this->request->query['keyword']))
		{
			$keyword = strtolower(trim($this->request->query['keyword']));
			$conditions	.= " AND ( LOWER(PetColors.name)) LIKE '%" . $keyword . "%' ";
		}
		
		$this->paginate = array(
			'conditions' => $conditions,
			'order' => 'PetColors.name asc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		
		$colors = $this->paginate('PetColors');
		$this->set('colors', $colors);	
			
	 }
	 
	 
	 /**
	 * Method Name : admin_add
	 * Author Name : Vivek Sharma
	 * Date : 16 June 2015
	 * Description : add colors 
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
				
				$this->PetColors->set($data_arr);
	
				if($this->PetColors->validates() && !$error_flag)
				{
					if(!empty($_FILES['filename']['name']))
					{
						$config['upload_path'] = UPLOAD_COLORS_DIR;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']	= 1200;
						$config['encrypt_name'] = true;
	
						$this->Upload->initializes($config);
	
						if ($this->Upload->do_upload('filename'))
						{
							$imgdata_arr = $this->Upload->data();
							$data_arr['PetColors']['filename'] = $imgdata_arr['file_name'];
						}
						else
						{
							$errors[] = $this->Upload->display_errors();
							$error_flag = true;
						}
					}
	
					if(!$error_flag)
					{
						
						if($this->PetColors->save($data_arr))
						{
							if(!empty($_FILES['filename']['name']))
							{
								$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_COLORS_DIR, 'PetColors', 'filename', array(), 'petcolors');
							}
							
							$this->Session->setFlash(__('Pet Color added successfully'),'default',array(),'success');
	
							$this->redirect(array('controller' => 'colors', 'action' => 'manage', 'admin' => true));
						}
						else
						{
							$errors[] = "Error while operation, please try again.";
						}
					}
				}
				else
				{
					$errors = $this->PetColors->validationErrors;
					$errors = array_merge($errors, $add_errors);
				}
			}
		}
				
    }


	/**
	 * Method Name : admin_view	 
	 * Author Name : Vivek Sharma
	 * Date : 16 June 2015
	 * Description : view pet colors 
	 */
    public function admin_view($id = null)
    {
		$this->PetColors->id = $id;
		if (!$this->PetColors->exists())
		{
			throw new NotFoundException(__('No Pet Color found'));
		}
		
		$color = $this->PetColors->read(null, $id);
		$this->set('color', $color);
    }
	
	
	/**
	 * Method Name : admin_edit	 
	 * Author Name : Vivek Sharma
	 * Date : 16 June 2015
	 * Description : edit news
	 */
    public function admin_edit($id = null)
    {
		$this->PetColors->id = $id;
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		
		$row = $this->PetColors->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->PetColors->set($data_arr);

			if($this->PetColors->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_COLORS_DIR;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= 1200;
					$config['encrypt_name'] = true;

					$this->Upload->initializes($config);

					if ($this->Upload->do_upload('filename'))
					{
						$imgdata_arr = $this->Upload->data();
						$data_arr['Tutorial']['filename'] = $imgdata_arr['file_name'];
					}
					else
					{
						$errors[] = $this->Upload->display_errors();
						$error_flag = true;
					}
				}

				if(!$error_flag)
				{
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['PetColors']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_COLORS_DIR, 'PetColors', 'filename', array('id' => $row['PetColors']['id']), array(), 'petcolors');
						if(empty($_FILES['filename']['name']) && !empty($data_arr['PetColors']['img_del']))
						{
							$data_arr['PetColors']['filename'] = '';
						}
					}

					if($this->PetColors->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_COLORS_DIR, 'PetColors', 'filename', array(), 'petcolors');
						}
						
						$this->Session->setFlash(__('Pet Color updated successfully'),'default',array(),'success');
	
						$this->redirect(array('controller' => 'colors', 'action' => 'manage', 'admin' => true));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->PetColors->validationErrors;
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
	 * Date : 13 June 2015
	 * Description : delete Pet Color
	 */
    public function admin_delete($id = null)
    {
		$this->PetColors->id = $id;
		if (!$this->PetColors->exists())
		{
			throw new NotFoundException(__('No Pet Color found'));
		}
		if ($this->PetColors->delete())
		{
			$this->Session->setFlash(__('Pet Color deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'manage', 'admin' => true));
		}
		$this->Session->setFlash(__('Pet Color was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index', 'admin' => true));
    }
	 
	 
}
	