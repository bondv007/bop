<?php
App::uses('AppModel', 'Model');
/**
* Event Model
*
* @project Crossfit
* @since 22 May 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class Event extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter title'
			)
		),
		'details' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter event details'
			)
		),
		'start_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select event date'
			)
		),
		'start_time' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select event time'
			)
		),
		'location' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select event location'
			)
		)
		
		
	);
	
	public $actsAs = array(
        'Upload.Upload' => array(
            'picture' => array(
            	'path' => '{ROOT}webroot{DS}files{DS}events{DS}',
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
