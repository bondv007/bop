<?php

App::uses('AppController', 'Controller');

/**
 * Leaderboard Controller
 *
 * @since 8 October 2014
 * @version Cake Php 2.3.8
 * @author Vivek Sharma
 */
class LeaderboardController extends AppController
{

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index','event_data','display_wod_scores'));
	}

    public function index()
    {
		$this->loadModel('Event');
		
		
		$countries = $this->Event->find('list', array(
													  'conditions' => array('Event.country IS NOT NULL'),
													  'fields' => array('Event.id','Event.country'),
													  'order' => array('Event.country' => 'asc')));
    	
		
		$this->Event->bindModel(array(
									'belongsTo' => array(
											'User' => array(
												'className' => 'User',
												'foreignKey' => 'user_id'
											)
									)
							));
		
		$event_data = $this->Event->find('all', array('conditions' => array('Event.status' => '1',
																			'Event.start_date < ' => date('Y-m-d'),
																			'Event.scoring_status' => 'Closed'
																		)
													));
		$affiliates = array();
		if ( !empty($event_data) )
		{
			foreach($event_data as $ev)
			{
				if ( !in_array($ev['Event']['user_id'], array_keys($affiliates)) )
				{
					if ( !empty($ev['User']['other_name']) )
						$affiliates[$ev['User']['id']] = $ev['User']['other_name'];
					else
						$affiliates[$ev['User']['id']] = $ev['User']['first_name'].' '.$ev['User']['last_name'];
				}
			}
		} 
		
		$this->set('affiliates', $affiliates);
		$this->set('countries', $countries);
	}
	
	/**
	 * Method Name : event_data
	 * Author Name : Vivek Sharma
	 * Date : 15 October 2014
	 * Description : get event scoring data based on event type
	 */
	public function event_data($event_type = '')
	{
		$this->layout = 'ajax';
		
		$conditions = array(
						
						'Event.status' => '1',
						'Event.start_date < ' => date('Y-m-d'),
						'Event.scoring_status' => 'Closed'
					);
		$this->set('request_data',array());
		//Filters
		if ( !empty($this->request->data) )
		{
			$data = $this->request->data;
			
			if ( !empty($data['event_type']) )
			{
				$conditions['Event.event_type'] = $data['event_type'];
			}
			
			if ( !empty($data['event_country']) )
			{
				$conditions['Event.country'] = $data['event_country'];
			}
			if ( !empty($data['event_affiliate']) )
			{
				$conditions['Event.user_id'] = $data['event_affiliate'];
			}
			
			$this->set('request_data', $this->request->data);
		}
		
		
		$this->loadModel('Event');
		$this->loadModel('EventRegistration');
		$this->loadModel('EventScore');
		$this->loadModel('EventWod');
		
		$this->Event->recursive = 4;		
		
		$this->EventWod->bindModel(array(
										'belongsTo' => array(
												'Wod' => array(
														'className' => 'Wod',
														'foreignKey' => 'wod_id',
														'fields' => array('title')
												),
												'WeightClass' => array(
														'className' => 'WeightClass',
														'foreignKey' => 'weight_class_id',
														'fields' => array('weight')
												)
										)
								));
								
		$this->EventScore->bindModel(array(
										'belongsTo' => array(
												'EventWod' => array(
														'className' => 'EventWod',
														'foreignKey' => 'event_wod_id'														
												)
										)
								));						
		
				
		$this->EventRegistration->bindModel(array(
												'hasOne' => array(
															'EventScore' => array(
																	'className' => 'EventScore',
																	'foreignKey' => 'registration_id'
															)
												),
												'belongsTo' => array(
															'User' => array(
																	'className' => 'User',
																	'foreignKey' => 'user_id',
																	'fields' => array('first_name','last_name')
															),
															'EventWod' => array(
																	'className' => 'EventWod',
																	'foreignKey' => 'division'														
															)
												)
										 ));
		
		$this->Event->bindModel(array(
										'hasMany' => array(
														'EventRegistration' => array(
																'className' => 'EventRegistration',
																'foreignKey' => 'event_id'									
														)
											)
									)
							  );
		
		$this->paginate = array(
								'conditions' => $conditions,
								'fields' => array('title','event_type','location')
								
						 );
						  
		$events = $this->paginate('Event');
		
		$data = array(); $i=0;
		
		//format data for sorting
		if ( !empty($events) )
		{
			foreach($events as $ev)
			{
				if ( !empty($ev['EventRegistration']) )
				{
					foreach($ev['EventRegistration'] as $reg)
					{						
						if ( !empty($reg['EventScore']) )
						{	
							$data[$reg['event_id']][$i]['division_type'] = 	$reg['EventWod']['division_type'];
							$data[$reg['event_id']][$i]['division_sex'] = 	$reg['EventWod']['division_sex'];
							
							if ( isset($reg['EventWod']['WeightClass']['weight']) )
								$data[$reg['event_id']][$i]['weight_class'] = $reg['EventWod']['WeightClass']['weight'];
							else 
								$data[$reg['event_id']][$i]['weight_class'] = 'N/A';
													
							$data[$reg['event_id']][$i]['registration_id'] = $reg['id'];
							$data[$reg['event_id']][$i]['score'] = $reg['final_score'];
							$data[$reg['event_id']][$i]['score_type'] = 	$reg['EventWod']['score_type'];
							$data[$reg['event_id']][$i]['score_sub_type'] = "Least";
							
							if ( !empty($reg['user_id']) )
								$data[$reg['event_id']][$i]['user_name'] = 	$reg['User']['first_name'].' '.$reg['User']['last_name'];	
							else										
								$data[$reg['event_id']][$i]['user_name'] = 	$reg['first_name'].' '.$reg['last_name'];					
							
							$data[$reg['event_id']][$i]['event_title'] = 	$ev['Event']['title'];	
							$data[$reg['event_id']][$i]['event_location'] = 	$ev['Event']['location'];
							$i++;	
							
						}									
					}
				}
			}
		}
		
		$sorted_data = array();
		
		//Sort data
		if ( !empty($data) )
		{
			foreach($data as $event_id => $event_data)
			{
				usort($event_data, "sortIt");
				$sorted_data[$event_id] = $event_data;
			}
		}
		
		$result = array();
		
		//re-format data 
		if ( !empty($sorted_data) )
		{
			foreach($sorted_data as $event_id => $event_data)
			{
				foreach($event_data as $sd)
				{
					$result[$event_id][$sd['event_title'].' - '.$sd['event_location']][$sd['division_type']][$sd['division_sex']][$sd['weight_class']][$sd['registration_id']] = $sd;		
				}
			}
		}
			
		
		$this->set('result', $result);
		
		$this->set('events', $events);
		$this->render('event_data');
		
	}

	/**
	 * Method Name : display_wod_scores
	 * Author Name : Vivek Sharma
	 * Date : 16 October 2014
	 * Description : get individual wod scores of athletes
	 */
	 public function display_wod_scores($reg_id=null)
	 {
	 	if ( !empty($reg_id) )
		{
			$this->layout = 'ajax';
			$this->loadModel('EventScore');
			$this->loadModel('EventWod');
			
			$this->EventScore->recursive = 2;
			
			$this->EventWod->bindModel(array(
								'belongsTo' => array(
									'Wod' => array(
										'className' => 'Wod',
										'foreignKey' => 'wod_id'
									)
								)
							));
			
			$this->EventScore->bindModel(array(
									'belongsTo' => array(
										'EventWod' => array(
											'className' => 'EventWod',
											'foreignKey' => 'event_wod_id'
										)
									) 			
								));
								
			$scores = $this->EventScore->find('all', array('conditions' => array('EventScore.registration_id' => $reg_id)));
			$this->set('scores', $scores);
			$this->render('individual_wod_scores');
		}
	 }

}
