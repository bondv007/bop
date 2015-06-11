<?php
App::uses('AppModel', 'Model');
/**
* AffiliateProfile Model
*
* @project Crossfit
* @since 3 June 2014
* @version Cake Php 2.3.8
* @author Vivek Sharma
*/
class AffiliateProfile extends AppModel {
	
	public $useTable = 'affiliate_profile';

	 /**
	 * Method Name : get_details	 
	 * Author Name : Vivek Sharma
	 * Date : 30 June 2014
	 * Description : get all details of affiliate
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
										),
										'Coach_1' => array(
												'className' => 'Coach',
												'foreignKey' => 'coach_1_id'
										),
										'Coach_2' => array(
												'className' => 'Coach',
												'foreignKey' => 'coach_2_id'
										)
							)
							
						));					
		$profile = $this->find('first',array('conditions'=>array('AffiliateProfile.user_id' => $id)));
	
		return $profile;

		}else{
			return null;
		}
	}
}
