<?php 

App::uses('Controller', 'Controller');

/**
 * News Controller
 *
 * Purpose : Manage News
 * @project Best of Pedigree
 * @since 13 June, 2015
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
class NewsController extends AppController 
{
	public $uses = array('News');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	
	/**
	 * Method Name : admin_manage	 
	 * Author Name : Vivek Sharma
	 * Date : 13 June 2015
	 * Description : manage news
	 */
	public function admin_manage() {
		
		$this->News->recursive = 0;
		
		$conditions = "News.status != 2";
		if ( !empty($this->request->query['keyword']))
		{
			$keyword = strtolower(trim($this->request->query['keyword']));
			$conditions	.= " AND ( LOWER(News.title)) LIKE '%" . $keyword . "%' ";
		}
		
		$this->paginate = array(
			'conditions' => $conditions,
			'order' => 'News.id desc',
			'limit' => ADMIN_PAGE_LIMIT
		);
		
		$news = $this->paginate('News');
		$this->set('news', $news);		
	}
	
	
	/**
	 * Method Name : admin_add
	 * Author Name : Vivek Sharma
	 * Date : 25 June 2014
	 * Description : add news 
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
				
				$this->News->set($data_arr);
	
				if($this->News->validates() && !$error_flag)
				{
					if(!empty($_FILES['filename']['name']))
					{
						$config['upload_path'] = UPLOAD_NEWS_DIR;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']	= 1200;
						$config['encrypt_name'] = true;
	
						$this->Upload->initializes($config);
	
						if ($this->Upload->do_upload('filename'))
						{
							$imgdata_arr = $this->Upload->data();
							$data_arr['News']['filename'] = $imgdata_arr['file_name'];
						}
						else
						{
							$errors[] = $this->Upload->display_errors();
							$error_flag = true;
						}
					}
	
					if(!$error_flag)
					{
						
						if($this->News->save($data_arr))
						{
							if(!empty($_FILES['filename']['name']))
							{
								$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_NEWS_DIR, 'News', 'filename', array(), 'news');
							}
							
							$this->Session->setFlash(__('News post added successfully'),'default',array(),'success');
	
							$this->redirect(array('controller' => 'news', 'action' => 'manage', 'admin' => true));
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
	 * Date : 13 June 2015
	 * Description : view news 
	 */
    public function admin_view($id = null)
    {
		$this->News->id = $id;
		if (!$this->News->exists())
		{
			throw new NotFoundException(__('No News found'));
		}
		
		$news = $this->News->read(null, $id);
		$this->set('news', $news);
    }
	
	
	/**
	 * Method Name : admin_edit	 
	 * Author Name : Vivek Sharma
	 * Date : 13 June 2015
	 * Description : edit news
	 */
    public function admin_edit($id = null)
    {
		$this->News->id = $id;
		$errors = array();
		$add_errors = array();
		$error_flag = false;
		
		$row = $this->News->read();
		
		if(!empty($this->data))
		{
			$data_arr = $this->data;

			$this->News->set($data_arr);

			if($this->News->validates() && !$error_flag)
			{
				if(!empty($_FILES['filename']['name']))
				{
					$config['upload_path'] = UPLOAD_NEWS_DIR;
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
					if(!empty($_FILES['filename']['name']) || !empty($data_arr['News']['img_del']))
					{
						$this->unlink_thumbs(UPLOAD_NEWS_DIR, 'News', 'filename', array('id' => $row['News']['id']), array(), 'news');
						if(empty($_FILES['filename']['name']) && !empty($data_arr['News']['img_del']))
						{
							$data_arr['News']['filename'] = '';
						}
					}

					if($this->News->save($data_arr))
					{
						if(!empty($_FILES['filename']['name']))
						{
							$this->create_all_thumbs($imgdata_arr['file_name'], UPLOAD_NEWS_DIR, 'News', 'filename', array(), 'news');
						}
						
						$this->Session->setFlash(__('News post updated successfully'),'default',array(),'success');
	
						$this->redirect(array('controller' => 'news', 'action' => 'manage', 'admin' => true));
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
	 * Date : 13 June 2015
	 * Description : delete news 
	 */
    public function admin_delete($id = null)
    {
		$this->News->id = $id;
		if (!$this->News->exists())
		{
			throw new NotFoundException(__('No News found'));
		}
		if ($this->News->delete())
		{
			$this->Session->setFlash(__('News deleted successfully'),'default',array(),'success');
			$this->redirect(array ('action' => 'manage', 'admin' => true));
		}
		$this->Session->setFlash(__('News was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index', 'admin' => true));
    }
	
			
}
	