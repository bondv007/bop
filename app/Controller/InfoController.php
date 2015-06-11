<?php 

App::uses('Controller', 'Controller');

/**
 * Info Controller
 *
 * Purpose : Manage info pages
 * @project Crossfot
 * @since 24 June, 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
class InfoController extends AppController 
{
	public $helpers = array('Html','Form','Js');
	public $uses = array('User','Event','Wod');
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout = 'default';
		$this->Auth->allow(array('search','search_event','search_athlete','search_affiliate','search_suggestion','get_rss_feeds'));
	}
	
	 /**
	 * Method Name : help	 
	 * Author Name : Vivek Sharma
	 * Date : 24 June 2014
	 * Description : show help popup 
	 */
	 public function help()
	 {
		$this->layout = 'ajax';
		$this->render('help');	
	 }
	 
	 /**
	 * Method Name : faq	 
	 * Author Name : Vivek Sharma
	 * Date : 24 June 2014
	 * Description : show faq 
	 */
	 public function faq()
	 {
		$this->loadModel('Faq');		
		
		$conditions = array();
		
		if ( !empty($this->request->data) )
		{
			if ( $this->data['faq_search_type'] == '1' )
			{	
				$conditions[] = array('Faq.question LIKE ' =>  "%".trim($this->data['faq_keyword'])."%");									
			} else if ( $this->data['faq_search_type'] == '2' )
			{
				$conditions[] = array('Faq.answer LIKE ' =>  "%".trim($this->data['faq_keyword'])."%");	
			} else {
				$conditions['OR'][] = array('Faq.question LIKE ' =>  "%".trim($this->data['faq_keyword'])."%");	
				$conditions['OR'][] = array('Faq.answer LIKE ' =>  "%".trim($this->data['faq_keyword'])."%");	
			}
			
			$this->set('faq_type', $this->data['faq_search_type']);
			$this->set('faq_keyword', $this->data['faq_keyword']);
		}
		
		$questions = $this->Faq->find('all', array('conditions' => $conditions));
		$this->set('questions', $questions);	
		$this->render('faq');	
	 }
	 
	 /**
	 * Method Name : tutorials	 
	 * Author Name : Vivek Sharma
	 * Date : 24 June 2014
	 * Description : show tutorials
	 */
	 public function tutorials()
	 {
	 	$this->loadModel('Tutorial');
		$this->render('tutorials');
	 }

	
	 /**
	 * Method Name : search	 
	 * Author Name : Vivek Sharma
	 * Date : 31 July 2014
	 * Description : search
	 */
	 public function search()
	 {
	 	if ( isset($this->request->query['key']) && !empty($this->request->query['key']) )
		{
			$key = $this->request->query['key'];
						
			$this->set(compact('key'));
			$this->render('search_results');
			
		}else{
			$this->redirect('/');
		}
	 }

	 /**
	 * Method Name : search_affiliate	 
	 * Author Name : Vivek Sharma
	 * Date : 31 July 2014
	 * Description : search_affiliate
	 */
	public function search_affiliate()
	{
		$key = $this->data['key'];
		if ( !empty($key) )
		{
			$this->layout = 'ajax';
			
			/*Search affiliates*/
			$this->paginate = array(
									'conditions' => array(
														'OR' => array(
																'User.first_name LIKE ' => '%'.$key.'%',
																'User.last_name LIKE ' => '%'.$key.'%',										
																'User.username LIKE ' => '%'.$key.'%',
																'User.email LIKE ' => '%'.$key.'%',
																"CONCAT(`User`.`first_name`,' ',`User`.`last_name`) LIKE " => '%'.$key.'%'
														),																		
														'User.status' => '1',
														'User.user_type' => 'affiliate'	
													),
									'fields' => array('User.first_name', 'User.last_name','User.photo','User.username', 'User.profile_description', 'User.id'),
									'limit' => '5',
									'order' => array('User.first_name' => 'asc')
									
									
									
						);
			//pr($this->paginate); die;
						
			$affiliates = $this->paginate('User');
			
			$this->set('data', $this->data);
			$this->set('affiliates', $affiliates);
			$this->render('search_affiliates');
		}
	}
	
	/**
	 * Method Name : search_athlete	 
	 * Author Name : Vivek Sharma
	 * Date : 31 July 2014
	 * Description : search_athlete
	 */
	public function search_athlete()
	{
		$key = $this->data['key'];
		if ( !empty($key) )
		{
			$this->layout = 'ajax';
			
			/*Search affiliates*/
			$this->paginate = array(
									'conditions' => array(
														'OR' => array(
																'User.first_name LIKE ' => '%'.$key.'%',
																'User.last_name LIKE ' => '%'.$key.'%',										
																'User.username LIKE ' => '%'.$key.'%',
																'User.email LIKE ' => '%'.$key.'%',
																"CONCAT(`User`.`first_name`,' ',`User`.`last_name`) LIKE " => '%'.$key.'%'
														),																		
														'User.status' => '1',
														'User.user_type' => 'athlete'	
													),
									'fields' => array('User.first_name', 'User.last_name','User.photo','User.username', 'User.profile_description', 'User.id'),
									'limit' => '5',
									'order' => array('User.first_name' => 'asc')
									
									
									
						);
						
			$athletes = $this->paginate('User');
			
			$this->set('data', $this->data);
			$this->set('athletes', $athletes);
			$this->render('search_athletes');
		}
	}
	
	/**
	 * Method Name : search_event	 
	 * Author Name : Vivek Sharma
	 * Date : 31 July 2014
	 * Description : search_event
	 */
	public function search_event()
	{
		$key = $this->data['key'];
		if ( !empty($key) )
		{
			$this->layout = 'ajax';
			
			/*Search events*/
			$this->paginate = array(
									'conditions' => array(
														'OR' => array(
																'Event.title LIKE ' => '%'.$key.'%',
																'Event.location LIKE ' => '%'.$key.'%',															
														),																		
														'Event.status' => '1'																				
													),
									'fields' => array('Event.title', 'Event.picture','Event.start_date','Event.duration','Event.location','Event.event_type', 'Event.details', 'Event.id'),
									'limit' => '5',
									'order' => array('Event.title' => 'asc','Event.location' => 'asc')
									
						);
						
			$events = $this->paginate('Event');
			
			$this->set('data', $this->data);
			$this->set('events', $events);
			$this->render('search_events');
		}
	}
	
	/**
	 * Method Name : search_suggestion	 
	 * Author Name : Vivek Sharma
	 * Date : 31 July 2014
	 * Description : search_suggestion
	 */
	public function search_suggestion()
	{
		if(isset($this->request->query['term']))
			$key = $this->request->query['term'];
		
		
		$data  = array();
		$users = $this->User->find('all', array(
											'conditions' => array(
														'OR' => array(
																'User.first_name LIKE ' => $key.'%',
																'User.last_name LIKE ' => $key.'%',
																'User.username LIKE ' => $key.'%'
																
														),
														'User.status' => '1'
											),
											'fields' => array('User.first_name','User.last_name')	
										));
		
		$i = 0;
		if ( !empty($users) )
		{
			foreach($users as $us)
			{
				$data[] = $us['User']['first_name'].' '.$us['User']['last_name'];
				$i++;
			}
		}								
		
		$events = $this->Event->find('all', array(
											'conditions' => array(														
																'Event.title LIKE ' => $key.'%',													
																'Event.status' => '1'
											),
											'fields' => array('Event.title')	
										));
		if ( !empty($events) )
		{
			foreach($events as $ev)
			{
				$data[] = $ev['Event']['title'];
				$i++;
			}
		}
		
		asort($data);
		echo json_encode($data); die;								
		
	}

	/**
	 * Method Name : get_rss_feeds	 
	 * Author Name : Vivek Sharma
	 * Date : 31 July 2014
	 * Description : get_rss_feeds from crossfit
	 */
	 public function get_rss_feeds()
	 {
	 	//$this->layout = 'ajax';
	 	$feed_uri = 'http://www.crossfit.com/index.rdf';
		$x = simplexml_load_file($feed_uri, "SimpleXMLElement", LIBXML_NOCDATA);
		//pr($x); die;
		
		$feeds = array();
		
		if ( !empty($x) )
		{
			$i = 0;
			foreach($x->item as $item)
			{
				$date = $this->get_formatted_date($this->get_value_from_object($item->title));
				
				$feeds[$i]['title'] = $date;
				$feeds[$i]['link'] = $this->get_value_from_object($item->link);
				$feeds[$i]['description'] = $this->get_value_from_object($item->description);
				$i++;
			}
		}		
		
		$data = '';
		if ( !empty($feeds) )
		{
			foreach($feeds as $fd)
			{
				$data .='<li><div class="msg-cont"><a class="feed_anchor" title="'.$fd['description'].'" href="'.$fd['link'].'" target="_blank">'.wraptext($fd['description'],40).'</a><b>'.$fd['title'].'</b></div></li>';
			}
		}
		
		echo $data; die;
		
	 }
	 
	 /**
	 * Method Name : get_formatted_date
	 * Author Name : Vivek Sharma
	 * Date : 28 August 2014
	 * Description : get value from object array
	 */
	public function get_formatted_date($val)
	{
		$date = explode(" ",$val);
		$num_date  = join('-', str_split($date[1], 2));
		
		$result = formatDate($num_date);
		return $result;
	}
	 
	/**
	 * Method Name : get_value_from_object
	 * Author Name : Vivek Sharma
	 * Date : 28 August 2014
	 * Description : get value from object array
	 */
	public function get_value_from_object($val)
	{
		$ret = '';
		if ( !empty($val) )
		{
			$array = json_decode(json_encode((array)$val), TRUE);
			if ( !empty($array) )
			{
				$ret = $array[0];
			}			
		}
		return $ret;
	}
		
}
	