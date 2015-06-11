<?php
App::uses('AppModel', 'Model');
/**
* Faq Model
*
* @project Crossfit
* @since 6 August 2013
* @version Cake Php 2.3.8
* @author Bhanu Prakash Pandey
* @property Faq $Faq
*/
class Faq extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'question' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'answer' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			)
		)
	);
}
