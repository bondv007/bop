<?php
/*
 * Img180.com 
 * Category Model 
 * Author: Nitin
 * Created: 4-Oct-2013
 */
class ContactUs extends AppModel
{
	//The $name variable is always a good idea to add, and is used to overcome some class name oddness in PHP4.
	var $name = 'ContactUs';
	var $useTable = false;
	
	var $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'First name field is required.'
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Last name field is required.'
		),
		'email_id' => array(		
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Email field is required.'
			),
			'rule2' => array(
				'rule' => 'email',
				'message' => 'Please enter valid email id.'
			)
		),
		'subject' => array(
			'rule' => 'notEmpty',
			'message' => 'Subject field is required.'
		),
		'message' => array(
			'rule' => 'notEmpty',
			'message' => 'Message field is required.'
		)
	);
}
?>
