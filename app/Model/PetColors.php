<?php
App::uses('AppModel', 'Model');
/**
* News Model
*
* @project Best of Pedigree
* @since 16 June 2015
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class PetColors extends AppModel {
	
	public $useTable = 'pet_colors';
	var $filename_thumbs_arr = array('200x140');
	public $validate = array(
		
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter color name'
			)
		),
		'filename' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please upload color image'
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
