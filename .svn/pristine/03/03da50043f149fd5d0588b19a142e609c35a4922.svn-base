<?php
App::uses('AppModel', 'Model');
/**
* AthleteProfile Model
*
* @project Crossfit
* @since 29 July 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class AthleteProfile extends AppModel {
	
	public $useTable = 'athlete_profile';

	 /**
	 * Method Name : get_details	 
	 * Author Name : Vivek Sharma
	 * Date : 29 July 2014
	 * Description : get all details of athlete
	 */
	function get_details($id = null)
	{
		if(!empty($id))
		{
		
			
			$this->bindModel(array(
							'belongsTo' => array(
										'Region' => array(
												'className' => 'Region',
												'foreignKey' => 'region_id'
										)
							)
							
						));					
		$profile = $this->find('first',array('conditions'=>array('AthleteProfile.user_id' => $id)));
	
		return $profile;

		}else{
			return null;
		}
	}
}
