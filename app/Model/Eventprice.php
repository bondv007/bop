<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
* @project Crossfit
* @since 22 May 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class Eventprice extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $useTable = 'event_prices';
 
	public $validate = array(
		'price' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter price'
			)
		),
		'date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter date'
			)
		)		
		
	);
	
}
