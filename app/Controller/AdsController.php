<?php

App::uses('AppController', 'Controller');
App::import('Vendor', array('FacebookAds/Api'));



class AdsController extends AppController {


	public $uses = array();
	public $components = array('Uploader');
	var $layout = 'tablet';
	
	
	public function beforeFilter()
	{
		$this->Auth->allow();
	}
	
	public function index()
	{
			$this->layout = 'ajax';
	}
	
	
	public function connect_to_fb()
	{
		$fb_app_id = "1520521781555545";
		$fb_app_secret = "a4fd15a2338cba62bfa565782291d5fc";
		
		$redirect_url = SITE_URL.'ads/fb_callback';
		
		$dialog_url = 'https://www.facebook.com/dialog/oauth?client_id='.$fb_app_id.'&client_secret='.$fb_app_secret.'&redirect_uri='.$redirect_url.'&scope=read_stream,publish_stream,manage_friendlists,email,ads_management,ads_read';
	
		 	echo("<html><body><script> top.location.href='" . $dialog_url . "'</script></body></html>");	
	}
	
	
	public function fb_callback()
	{
		$fb_app_id = "1520521781555545";
		$fb_app_secret = "a4fd15a2338cba62bfa565782291d5fc";
		
			 if (!empty($_REQUEST['code'])) {
				
				$redirect_url = SITE_URL.'ads/fb_callback';
				 $token_url = "https://graph.facebook.com/oauth/access_token?client_id=". $fb_app_id . "&client_secret=". $fb_app_secret . "&code=" . $_REQUEST['code'] . "&redirect_uri=" .$redirect_url;
				 $access_token = file_get_contents($token_url);
				 
				 $active_access = explode('&', $access_token);
				
				 $this->Session->write('active_acces', $active_access[0]);
				 
				 $graph_url = "https://graph.facebook.com/me?".$access_token;
				 $user = json_decode(file_get_contents($graph_url));
				
				 $access = explode('&', $access_token);
				
				 $access = substr($access[0], 13);
				
				 $this->Session->write('fb_access', $access);				
				 $this->redirect(array('action' => 'get_ad_account'));				 
			}
	}
	
	public function get_ad_account()
	{
		$fb_app_id = "1520521781555545";
		$fb_app_secret = "a4fd15a2338cba62bfa565782291d5fc";
		$access = $this->Session->read('active_acces');
		
		$graph_url = "https://graph.facebook.com/v2.2/me/adaccounts?" . $access;
    	$adaccounts = json_decode(file_get_contents($graph_url));
		
		if ( !empty($adaccounts) )
		{
			$i = 0;
			foreach($adaccounts->data as $dat)
			{
				
				$account_ids[$i] = $dat->id;
				$i++;
					
			}
		}		
			
		 if ( isset($account_ids[0]) && !empty($account_ids[0]) )
		 {
				echo 'Ad account ID: '.$account_ids[0].'<br>';
		 }	
		
		 $this->Session->write('ad_account_id', $account_ids[0]);
		 
		 echo '<a href="'.$this->webroot.'ads/create_campaign">Create New Campaign</a><br>';
		
		 die;			
		
	}
	
	
	public function create_campaign()
	{
		 $account_id = $this->Session->read('ad_account_id');
		 $access = $this->Session->read('active_acces');	 
		
		
		 	
		 $fields = array(
						'name' => 'Xicom_test_campaign',
						'campaign_group_status' => 'ACTIVE'
				);
		 $fields_string = '';
				
		 foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		 rtrim($fields_string, '&');			
		
		 $create_ad_campaign_url = "https://graph.facebook.com/v2.2/".$account_id."/adcampaign_groups?".$access;
	    
		 
		 
		 $ch = curl_init();
		 curl_setopt($ch,CURLOPT_URL, $create_ad_campaign_url);
		 curl_setopt($ch,CURLOPT_POST, count($fields));
		 curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		 //execute post
		 $result = curl_exec($ch);
		 if(curl_errno($ch))
		 {
    		echo 'error:' . curl_error($ch);
		 }
		 curl_close($ch);
		 
		
		
		 $result_data = json_decode($result);
		 		
		 pr($result_data); die;
		 $this->Session->write('ad_campaign_group_id', $ad_campaign_group->id);
		
		 echo 'Ad Account ID: '.$account_id;
		 echo '<br>Campaign Created<br>Campaign ID: '.$ad_campaign_group->id;
		 echo '<br><a href="'.$this->webroot.'ads/create_ad_set">Create New Ad Set</a><br>';		 
		 die;
	}
	
	public function create_ad_set()
	{
		 $account_id = $this->Session->read('ad_account_id');
		 $ad_campaign_id = $this->Session->read('ad_campaign_group_id');
		 $access = $this->Session->read('active_acces');	
		 
		 
		 $targeting_arr = array(							
							'geo_locations' => array(
											 'countries' =>  array('IN')
										)									
						  );
		 
		 $targeting = json_encode($targeting_arr);
		 $bidinfo = json_encode(array('CLICKS' => 150));
		 			
		 $fields = array(
						'name' => 'Xicom2',
						'bid_type' => 'CPC',
						'bid_info' => $bidinfo,
						'daily_budget' => 10000,
						'campaign_group_id' => $ad_campaign_id,
						'targeting' => $targeting,
						'campaign_status' => 'ACTIVE',
						'end_time' => 0
				);
		$fields_string = '';
				
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');		
			
		 
		 $create_ad_set_url = "https://graph.facebook.com/v2.2/".$account_id."/adcampaigns?".$access;
		 
		 $ch = curl_init();
		 curl_setopt($ch,CURLOPT_URL, $create_ad_set_url);
		 curl_setopt($ch,CURLOPT_POST, count($fields));
		 curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		 //execute post
		 $result = curl_exec($ch);
		 curl_close($ch);
		 
		
		
		 $result_data = json_decode($result);
		
		 $ad_set_id = $result_data->id;
		
		 $this->Session->write('ad_set_id', $ad_set_id);
		
		 echo 'Ad Account ID: '.$account_id;
		 echo '<br>Campaign Created<br>Campaign ID: '.$ad_campaign_id;
		 echo '<br>Ad Set Created<br>Ad Set ID: '.$ad_set_id;
		 echo '<br><a href="'.$this->webroot.'ads/create_ad_creative">Create New Ad Creative</a><br>';
		 
		 die;
		 
	}
	
	public function create_ad_creative()
	{
	     $account_id = $this->Session->read('ad_account_id');
		 $ad_campaign_id = $this->Session->read('ad_campaign_group_id');
		 $ad_set_id = $this->Session->read('ad_set_id');
		 $access = $this->Session->read('active_acces');	
		 
		 $object_story_spec = array(
									'page_id' => '403478889805767',
									'link_data' => array(
											'link' => 'https://www.facebook.com/xicomsocialeyes',
											'message' => 'This is a test message',
											'name' => 'Xicom',
											'caption' => 'Ads API test',
											'description' => 'This is a test description',
											'picture' => 'http://eyesocialeyes.com/wordpress/wp-content/uploads/2013/08/dreamstime_s_30319000_1.jpg'
									 )
								);
		 
		 
		  $fields = array(
						'name' => 'Xicom Link Page Post Ad Creative',
						'object_story_spec' => json_encode($object_story_spec)
				);
		 
		 
		 $fields_string = '';
				
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');		
			
		
		 $create_ad_set_url = "https://graph.facebook.com/v2.2/".$account_id."/adcreatives?".$access;
		 
		 $ch = curl_init();
		 curl_setopt($ch,CURLOPT_URL, $create_ad_set_url);
		 curl_setopt($ch,CURLOPT_POST, count($fields));
		 curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 //execute post
		 $result = curl_exec($ch);
		 curl_close($ch);
		
		 $result_data = json_decode($result);
		 $ad_creative_id = $result_data->id;
		
		 $this->Session->write('ad_creative_id', $ad_creative_id);
		
		 echo 'Ad Account ID: '.$account_id;
		 echo '<br>Campaign Created<br>Campaign ID: '.$ad_campaign_id;
		 echo '<br>Ad Set Created<br>Ad Set ID: '.$ad_set_id;
		 echo '<br>Ad creative Created<br>Ad Creative ID: '.$ad_creative_id;
		 echo '<br><a href="'.$this->webroot.'ads/create_ad_group">Create Ad Group</a><br>';
		 
		 die;	
		 
		 	
	}
	
	
	public function create_ad_group()
	{
		
		$account_id = $this->Session->read('ad_account_id');
		 $ad_campaign_id = $this->Session->read('ad_campaign_group_id');
		 $ad_set_id = $this->Session->read('ad_set_id');
		 $ad_creative_id = $this->Session->read('ad_creative_id');
		 $access = $this->Session->read('active_acces');		 
				 
		  $fields = array(
						'name' => 'Xicom Ad',
						'campaign_id' => $ad_set_id,
						'creative' => json_encode(array('creative_id' => $ad_creative_id)),
						
						'adgroup_status' => 'PAUSED'
						
				);
		 
		 
		 $fields_string = '';
				
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');		
			
		echo $fields_string; 
		
		 $create_ad_set_url = "https://graph.facebook.com/v2.2/".$account_id."/adgroups?".$access;
		 
		 $ch = curl_init();
		 curl_setopt($ch,CURLOPT_URL, $create_ad_set_url);
		 curl_setopt($ch,CURLOPT_POST, count($fields));
		 curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 //execute post
		 $result = curl_exec($ch);
		 curl_close($ch);
		 
		 pr(json_decode($result)); die;
	}	

}	
