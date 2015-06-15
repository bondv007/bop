<?php
App::uses('AppModel', 'Model');
/**
* News Model
*
* @project Best of Pedigree
* @since 13 June 2015
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class News extends AppModel {
	
	public $useTable = 'news';
	var $filename_thumbs_arr = array('200x140');
	public $validate = array(
		
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
            	'path' => '{ROOT}webroot{DS}files{DS}news{DS}',
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

?>
