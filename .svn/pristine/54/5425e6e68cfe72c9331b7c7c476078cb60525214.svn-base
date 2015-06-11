<?php
App::uses('AppModel', 'Model');
/**
* Tutorial Model
*
* @project Crossfit
* @since 24 June 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class Tutorial extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
    var $tutorial_thumbs_arr = array('200x140');
	public $validate = array(
		'category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select tutorial category'
			)
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter title'
			)
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter tutorial content'
			)
		)
		
	);
	
	public $actsAs = array(
        'Upload.Upload' => array(
            'picture' => array(
            	'path' => '{ROOT}webroot{DS}files{DS}tutorials{DS}',
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
