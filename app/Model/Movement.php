<?php
App::uses('AppModel', 'Model');
/**
* Movement Model
*
* @project Crossfit
* @since 7 August 2013
* @version Cake Php 2.3.8
* @author Bhanu Prakash Pandey
*/
class Movement extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Title must be unique',
			)
		)
	);
}
