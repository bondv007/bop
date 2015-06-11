<?php 

App::uses('Controller', 'Controller');

/**
 * Tutorials Controller
 *
 * Purpose : Manage Tutorials
 * @project Crossfit
 * @since 25 June, 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
class TutorialsController extends AppController 
{
	
	public $uses = array('Tutorial', 'TutorialCategory');
	
	/**
	 * Method Name : index	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : display tutorial page on frontend
	 */
	public function index()
    {
    	$this->TutorialCategory->bindModel(array(
									'hasMany' => array(
												'Tutorial' => array(
																'className' => 'Tutorial',
																'foreignKey' => 'category_id'
														)		
											)
									));
    	$categories = $this->TutorialCategory->find('all', array('order' => array('TutorialCategory.created' => 'asc')));
    	//pr($categories); die;
		$this->set('categories', $categories);
	}
	
	
	/**
	 * Method Name : display_tutorials_list	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : list tutorials 
	 */
	 public function display_tutorials_list()
	 {
	 	$this->layout = 'ajax';
	 	$id = $this->data['id'];
		
		if ( !empty($id) )
		{
			$this->Tutorial->primaryKey = 'category_id';
			$this->TutorialCategory->bindModel(array(
									'hasMany' => array(
												'Tutorial' => array(
																'className' => 'Tutorial',
																'foreignKey' => 'category_id'
														)		
											)
									));
			$category = $this->TutorialCategory->find('first', array('conditions' => array('TutorialCategory.id' => $id)));
			
			$this->set('category', $category);
		}
		$this->render('display_tutorials_list');
	 }
	 
	 
	 /**
	 * Method Name : view_tutorial	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : list tutorials 
	 */
	 public function view_tutorial($id)
	 {
	 	if(!empty($id))
		{
			$tutorial = $this->Tutorial->find('first', array('conditions' => array('Tutorial.id' => $id)));
			if(!empty($tutorial))
			{
				
				$this->TutorialCategory->bindModel(array(
									'hasMany' => array(
												'Tutorial' => array(
																'className' => 'Tutorial',
																'foreignKey' => 'category_id'
														)		
											)
									));
		    	$categories = $this->TutorialCategory->find('all', array('order' => array('TutorialCategory.created' => 'asc')));
		    	//pr($categories); die;
				$this->set('categories', $categories);
				$this->set('tutorial', $tutorial);
				$this->render('view_tutorial');
				
			}else{
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->redirect(array('action' => 'index'));
		}
	 }
	 
	
	/**
	 * Method Name : admin_index	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : list tutorials 
	 */
	public function admin_index()
    {
		$this->Tutorial->recursive = 0;
		$this->paginate = array(
			'order' => 'Tutorial.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		$this->Tutorial->bindModel(array('belongsTo' => array('TutorialCategory' => array('className' => 'TutorialCategory',
																						 'foreignKey' => 'category_id'))));
		$tutorials = $this->paginate('Tutorial');
		$this->set('tutorials', $tutorials);
    }

	/**
	 * Method Name : admin_view	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : view tutorials 
	 */
    public function admin_view($id = null)
    {
		$this->Tutorial->id = $id;
		if (!$this->Tutorial->exists())
		{
			throw new NotFoundException(__('Invalid Tutorial found'));
		}
		
		$this->Tutorial->bindModel(array('belongsTo' => array('TutorialCategory' => array('className' => 'TutorialCategory',
																						 'foreignKey' => 'category_id'))));
		$tutorial = $this->Tutorial->read(null, $id);
	
		$categories = $this->TutorialCategory->find('list', array('fields' => array('TutorialCategory.id', 'TutorialCategory.name')));
		$this->set('categories', $categories);
		$this->set('tutorial', $tutorial);
    }

	/**
	 * Method Name : admin_add
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : add tutorials 
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
				
				$this->Tutorial->set($data_arr);
	
				if($this->Tutorial->validates() && !$error_flag)
				{
					if(!empty($_FILES['filename']['name']))
					{
						$config['upload_path'] = UPLOAD_TUTORIAL_DIR;
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
						
						if($this->Tutorial->save($data_arr))
						{
							if(!empty($_FILES['filename']['name']))
							{
								$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_TUTORIAL_DIR, 'Tutorial', 'filename', array(), 'tutorial');
							}
							
							$this->Session->setFlash(__('Added successfully.'), 'flash_success');
	
							$this->redirect(array('controller' => 'tutorials', 'action' => 'admin_index'));
						}
						else
						{
							$errors[] = "Error while operation, please try again.";
						}
					}
				}
				else
				{
					$errors = $this->Tutorial->validationErrors;
					$errors = array_merge($errors, $add_errors);
				}
			}
		}
		
		$categories = $this->TutorialCategory->find('list', array('fields' => array('TutorialCategory.id', 'TutorialCategory.name')));
		$this->set('categories', $categories);
    }

	/**
	 * Method Name : admin_edit	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : edit tutorials 
	 */
    public function admin_edit($id = null)
    {
		$this->Tutorial->id = $id;
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		
		$row = $this->Tutorial->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->Tutorial->set($data_arr);

			if($this->Tutorial->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_TUTORIAL_DIR;
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
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['Tutorial']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_TUTORIAL_DIR, 'Tutorial', 'filename', array('id' => $row['Tutorial']['id']), array(), 'tutorial');
						if(empty($_FILES['filename']['name']) && !empty($data_arr['Tutorial']['img_del']))
						{
							$data_arr['Tutorial']['filename'] = '';
						}
					}

					if($this->Tutorial->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_TUTORIAL_DIR, 'Tutorial', 'filename', array(), 'tutorial');
						}
						
						$this->Session->setFlash(__('Updated successfully.'), 'flash_success');

						$this->redirect(array('controller' => 'tutorials', 'action' => 'admin_index'));
					}
					else
					{
						$errors[] = "Error while operation, please try again.";
					}
				}
			}
			else
			{
				$errors = $this->Tutorial->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}
		else
		{
			$this->data = $row;
		}
		
		$categories = $this->TutorialCategory->find('list', array('fields' => array('TutorialCategory.id', 'TutorialCategory.name')));
		$this->set('categories', $categories);
		$this->render('admin_add');
    }

	/**
	 * Method Name : admin_delete	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : delete tutorials 
	 */
    public function admin_delete($id = null)
    {
		$this->Tutorial->id = $id;
		if (!$this->Tutorial->exists())
		{
			throw new NotFoundException(__('Invalid Tutorial found'));
		}
		if ($this->Tutorial->delete())
		{
			$this->Session->setFlash(__('Tutorial deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('Tutorial was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index', 'admin' => true));
    }
	
	
	/**
	 * Method Name : admin_category_index	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : list tutorial categories 
	 */
	public function admin_category_index()
    {
		$this->TutorialCategory->recursive = 0;
		$this->paginate = array(
			'order' => 'TutorialCategory.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		$categories = $this->paginate('TutorialCategory');
		$this->set('categories', $categories);
    }


	/**
	 * Method Name : admin_category_add
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : add tutorial category 
	 */
    public function admin_category_add()
    {
		if ($this->request->is('post'))
		{
			$this->TutorialCategory->create();
			if ($this->TutorialCategory->save($this->request->data))
			{
				$this->Session->setFlash(__('The Tutorial category has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'category_index', 'admin' => true));
			}
			else
			{
				$errors = $this->TutorialCategory->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
    }

	/**
	 * Method Name : admin_category_edit	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : edit tutorial category 
	 */
    public function admin_category_edit($id = null)
    {
		$this->TutorialCategory->id = $id;
		if (!$this->TutorialCategory->exists())
		{
			throw new NotFoundException(__('Invalid Tutorial Category'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->TutorialCategory->save($this->request->data))
			{
				$this->Session->setFlash(__('The Tutorial category has been saved successfully'),'default',array(),'success');
				$this->redirect(array ('action' => 'category_index', 'admin' => true));
			}
			else
			{
				$errors = $this->TutorialCategory->validationErrors;
				$this->set('invalidfields', $errors);
			}
		}
		else
		{
			$this->request->data = $this->TutorialCategory->read(null, $id);
		}
    }

	/**
	 * Method Name : admin_category_delete	 
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : delete tutorial category 
	 */
    public function admin_category_delete($id = null)
    {
		$this->TutorialCategory->id = $id;
		if (!$this->TutorialCategory->exists())
		{
			throw new NotFoundException(__('Invalid Tutorial category'));
		}
		if ($this->TutorialCategory->delete())
		{
			$this->Session->setFlash(__('Tutorial category deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'category_index', 'admin' => true));
		}
		$this->Session->setFlash(__('Tutorial category was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'category_index', 'admin' => true));
    }
	
	
}