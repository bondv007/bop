<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
* @project Crossfit
* @since 13 August 2013
* @version Cake Php 2.3.8
* @author Bhanu Prakash Pandey
*/
class User extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a first name'
			)
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a last name'
			)
		),
		
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email address'
           	)
			//~ 'uniqueEmail' => array(
				//~ 'rule' => array('isUnique'),
				//~ 'message' => 'This email has already been added'
			//~ )
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a password'
			)/*,
			'between' => array(
				 'rule' => array('between', 4, 20),
        		 'message' => 'Password should be at least 4 chars long'
			)*/
		),
	);
	
	public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
            	'path' => '{ROOT}webroot{DS}files{DS}',
            	'thumbnailMethod' => 'php',
                'thumbnailSizes' => array(
                    'big' => '200x200',
                    'small' => '120x120',
                    'thumb' => '80x80'
                )
            )
        )
    );
	
}
