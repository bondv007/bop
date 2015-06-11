<?php
App::uses('AppModel', 'Model');
/**
* Badge Model
*
* @project Crossfit
* @since 9 June 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class Badge extends AppModel {
	
	public $useTable = 'badges';
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
		'link' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a last name'
			)
		)
	);
	
	public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
            	'path' => '{ROOT}webroot{DS}files{DS}badges{DS}',
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
