<?php
App::uses('AppModel', 'Model');
/**
* Coach Model
*
* @project Crossfit
* @since 3 June 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class Coach extends AppModel {
	
	public $useTable = 'coaches';
	
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
		)
		
	);
	
	public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
            	'path' => '{ROOT}webroot{DS}files{DS}coach{DS}',
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
