<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * @project Crossfit
 * @since 6 August 2013
 * @version Cake Php 2.3.8
 * @author : Bhanu Prakash Pandey
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('display','home', 'about_us', 'show'));
	}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$title_for_layout = "Crossfit";
		
		$this->loadModel('Event');
		
		$events = $this->Event->find('all', array('conditions' => array('Event.start_date >= ' => date('Y-m-d'), 'Event.status' => 1),
													'order' => array('Event.start_date' => 'asc'),
													'fields' => array('Event.id','Event.event_type','Event.created','Event.title','Event.start_date','Event.location','Event.picture')
												));
		
		$start_month = '';
		$months = $timeline = $competitions = $throwdown = $challenges = array();
		if ( !empty($events) )
		{
			$i = 0;
			foreach($events as $ev)
			{
				$ev_month = date('F',strtotime($ev['Event']['start_date']));	
				 
				
				if ( $i == 0 )
				{
					$start_month = date('m',strtotime($ev['Event']['start_date']));
				}
				
				$timeline[$ev_month][] = $ev;
				if ($ev['Event']['event_type'] == 'competition')
				{
					$competitions[] = $ev;
				}else if($ev['Event']['event_type'] == 'throwdown') 
				{
					$throwdown[] = $ev;
				}
			}
		}
		
		$all_months = array();
		$currentMonth = (int)$start_month;
		$num = 15 - count($events);
		
		for ($x = $currentMonth; $x < $currentMonth + $num; $x++) {
		    $all_months[] = date('F', mktime(0, 0, 0, $x, 0));
		}
		//pr($timeline); die;
		
		$this->loadModel('Challenge');
		$this->loadModel('ChallengePeople');
		
		$this->Challenge->recursive = 2;
		$this->ChallengePeople->bindModel(array('belongsTo' => array('User' => array('className' => 'User', 
																					 'foreignKey' => 'user_id',
																					 'fields' => array('User.username',
																					 					 'User.photo', 
																					 					 'User.id',
																										 'User.first_name',
																										 'User.last_name'
																										)
																					))));
																					
		$this->Challenge->bindModel(array('hasMany' => array('ChallengePeople' => array('className' => 'ChallengePeople', 'foreignKey' => 'challenge_id'))));
		$challenges_data = $this->Challenge->find('all', array('conditions' => array('Challenge.date >= ' => date('Y-m-d'),'Challenge.status' => 'Pending'))); 
		
		if ( !empty($challenges_data) )
		{
			foreach($challenges_data as $ch)
			{
				$flag = 0;
				foreach($ch['ChallengePeople'] as $ppl)
				{
					if ( $ppl['status'] == 'Pending' )
					{
						$flag = 1;
						break;
					}
				}

				if ( $flag == 0 )
				{
					$challenges[] = $ch;
				}
			}
		}

		//pr($all_months);die;
		
		$this->set(compact('title_for_layout','events','competitions','throwdown','challenges','timeline','all_months'));
	}
	
	/**
 * admin_index method
 *
 * @return void
 */
    public function admin_index()
    {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
    }

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
    public function admin_view($id = null)
    {
		$this->Page->id = $id;
		if (!$this->Page->exists())
		{
			throw new NotFoundException(__('Invalid page'));
		}
		$this->set('page', $this->Page->read(null, $id));
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
			
			$this->Page->create();
			if ($this->Page->save($this->request->data))
			{
				$this->Session->setFlash(__('The page has been saved'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Page->validationErrors;
				$this->set('invalidfields', $errors);
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'),'default',array(),'error');
			}
		}
    }

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null)
    {
		$this->Page->id = $id;
		if (!$this->Page->exists())
		{
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->Page->save($this->request->data))
			{
				$this->Session->setFlash(__('The page has been saved'),'default',array(),'success');
				$this->redirect(array ('action' => 'index'));
			}
			else
			{
				$errors = $this->Page->validationErrors;
				$this->set('invalidfields', $errors);
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'),'default',array(),'error');
			}
		}
		else
		{
			$this->request->data = $this->Page->read(null, $id);
		}
    }

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null)
    {
		//~ die("test");
		//~ if (!$this->request->is('post'))
		//~ {
			//~ throw new MethodNotAllowedException();
		//~ }
		$this->Page->id = $id;
		if (!$this->Page->exists())
		{
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Page->delete())
		{
			$this->Session->setFlash(__('Page deleted'),'default',array(),'success');
			$this->redirect(array ('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'),'default',array(),'error');
		$this->redirect(array ('action' => 'index'));
    }
    
   /**
	 * Method Name : index	 
	 * Author Name : Santosh Gupta
	 * Inputs :  $slug
	 * Date : 20 August 2013
	 * Description : Show the static pages
	 */ 
	 
	 public function home($slug = null)
	 {
		if ($slug)
		{
			$data = $this->Page->find('first',array('conditions'=>array('slug'=>$slug)));
			if ($data)
			{
				$this->set('data',$data);
			}
			else
			{
				$this->render('error');
			}
		}
		else
		{
			$this->render('error');
		}
	 }
	 
	function about_us()
	{
	}
	 
	 /**
	 * Purpose : TO SHOW CMS PAGES IF THEY EXIST IN THE DATABASE ELSE TO SHOW THEIR VIEW
	 * Created on : 1-Oct-2013
	 * Author : Nitin
	 */
	function show($page_name)
	{
		$row = $this->Page->find('first', array('conditions' => array('Page.slug' => $page_name)));
		if (!empty($row))
		{			
			$this->set('row', $row);
			$this->render('show');
		}
		else
		{
			$this->render($page_name);
		}
	}
}
