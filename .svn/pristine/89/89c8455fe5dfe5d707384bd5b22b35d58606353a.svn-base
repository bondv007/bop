<?php
/**
 * Block model for Img180.com.
 * @package       app.Model
 * Author : Nitin
 * Created: 1 Nov, 2012
 */ 

class Block extends AppModel 
{

	/**
	 * Purpose : TO GET THE BLOCK DETAILS
	 * Created on : 1-Nov-2013
	 * Author : Nitin
	 */
	public function get_block($block_key)
	{
		$row = $this->find('first', array('conditions' => array('Block.key' => $block_key)));
		if(!empty($row))
		{
			$row['Block']['content'] = str_replace(array('{{SITE_URL}}', '{{IMAGES_PATH}}'), array(SITE_URL, IMAGES_PATH), $row['Block']['content']);
		}
		
		return $row;
	}
}
