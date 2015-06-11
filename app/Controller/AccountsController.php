<?php 

App::uses('Controller', 'Controller');

/**
 * Events Controller
 *
 * Purpose : Manage Stripe Accounts
 * @project Crossfit
 * @since 19 Aug 2014
 * @version Cake Php 2.3.8
 * @author : Vivek Sharma
 */
 
class AccountsController extends AppController 
{
	public $name = 'Accounts';
	public $components = array('RequestHandler');
	public $helpers = array('Html', 'Form', 'Js');
	public $uses = array('User');
	
	public function beforeFilter()
	{		
		parent::beforeFilter();
		$this->Auth->allow('process_payment');
	}

	 /**
	 * Method Name : connect
	 * Author Name : Vivek Sharma
	 * Date : 21 August 2014
	 * Description : Connect affiliate account to our stripe account
	 */
	public function connect()
	{
		if ( isset($this->request->query['code']) )
		{
			$code = $this->request->query['code'];
			
			
			$url = "https://connect.stripe.com/oauth/token";
			
			$fields = array(
							'client_secret' => STRIPE_TEST_SECRET,
							'code' => $code,
							'grant_type' => 'authorization_code'									
							);
			$fields_string = '';
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			
			$ch = curl_init();
			
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			
			$result = curl_exec($ch);
			
			
			$data = json_decode($result);
			
			if ( isset($data->stripe_user_id) && isset($data->access_token) )
			{
				$arr = array(
						'stripe_user_id' => $data->stripe_user_id,
						'stripe_access_token' => $data->access_token,
						'stripe_refresh_token' => $data->refresh_token,
						'stripe_publishable_key' => $data->stripe_publishable_key 
					);
					
				$this->loadModel('User');
				$this->User->id = $this->Auth->user('id');
				$this->User->save($arr);
				
				$this->Session->setFlash(__('Congratulations! Your stripe account connected successfully.'),'default',array(),'success');			
				
			}else{
				$this->Session->setFlash(__('There is some issue. Please try to connect your stripe account later'),'default',array(),'error');		
			}
			
			$this->redirect(array('controller' => 'users', 'action' => 'index'));	
			
			
		}		
	}


	 /**
	 * Method Name : process_payment
	 * Author Name : Vivek Sharma
	 * Date : 22 August 2014
	 * Description : process payments from athlete event registration
	 */
	 public function process_payment()
	 {	$this->loadModel('Payment');
	 	if($this->request->is('post') && !empty($this->request->data))
		{
			$data = $this->data['Payment'];
			
			$this->loadModel('Event');
			
			$this->Event->bindModel(array(
										'hasMany' => array(
												'Eventprice' => array('className' => 'Eventprice', 'foreignKey' => 'event_id')
										),
										'belongsTo' => array('User' => array('className' => 'User', 'foreignKey' => 'user_id'))
								));
			$details = $this->Event->findById($data['event_id']);
			
			if ( !empty($details['Eventprice']) )
			{
				$cur_date = date('Y-m-d'); 				
				
				$min_diff = getDifference($details['Eventprice'][0]['date'], $cur_date);
				$total_cost =  $details['Eventprice'][0]['price'];
				 
				foreach($details['Eventprice'] as $price)
				{
					$diff =  getDifference($price['date'], $cur_date);
					if ( $diff > 0 && $diff < $min_diff)
					{
						$min_diff = $diff;
						$total_cost = $price['price'];
					}
				}
			}
			
			
			App::import('Vendor', 'Stripe/Stripe');
			Stripe::setApiKey(STRIPE_TEST_SECRET);
			
			$expiry_date = explode('-',$data['expire_date']);
			
			try{
				
				
			
			$payment = Stripe_Charge::create(array(
		 
				'amount'        => intval($total_cost)*100,
				'currency'      => 'USD',
				'card'          => array(
										'name'    => $data['name'],
										'number'    => $data['card_number'],
										'exp_month' => $expiry_date[1],
										'exp_year'  => $expiry_date[0],
										'cvc'       => $data['cvv']
										
									),
				'receipt_email' => $data['email'],					
				'description'   => 'Event Registration Payment'		 
				)
			);
			
			//pr($payment); die;
			
			
			
			if ( $payment->paid == true)
			{
				$parr = array(
						'registration_id' => $data['register_id'],
						'amount' => $payment->amount/100,
						'currency' => $payment->currency,
						'card_stripe_id' => $payment->card->id,
						'last_four_digit' => $payment->card->last4,
						'brand' => $payment->card->brand,
						'funding' => $payment->card->funding,
						'exp_month' => $payment->card->exp_month,
						'exp_year' => $payment->card->exp_year,
						'name_on_card' => $payment->card->name,
						'country' => $payment->card->country,
						'status' => 'success',
						'created' => date('Y-m-d H:i:s')
					);				
				
				$this->Payment->create();	
				$this->Payment->save($parr);
					
				//update payment status
				$this->loadModel('EventRegistration');
				$this->EventRegistration->id = $data['register_id'];
				$this->EventRegistration->saveField('payment_status', 'Paid');
				
				$this->EventRegistration->bindModel(array('belongsTo' => array('User' => array('className' => 'User', 'foreignKey' => 'user_id'))));
			
				$register = $this->EventRegistration->findById($data['register_id']);
				
				
				/* Send email to user */
				$this->loadModel('Emailtemplate');
				$email_content = $this->Emailtemplate->find('first', array('fields' => array('from_name', 'from_email', 
																							'reply_to', 'subject', 'content'), 
																			'conditions' => array('email_for' => 'Event_payment_received')));
																			
				$content = $email_content['Emailtemplate']['content'];
			
				if ( !empty($register['EventRegistration']['user_id']) )
				{
					$name = $register['User']['first_name']. ' '. $register['User']['last_name'];
					
				}else{
					$name = $register['EventRegistration']['first_name']. ' '. $register['EventRegistration']['last_name'];
				}
			
				$content = str_replace(array('{USERNAME}', '{EVENT}' ,'{AMOUNT}','{EVENT_DATE}','{LOCATION}','{DATE}'), 
										array(ucfirst($name), $details['Event']['title'] , '$'.$total_cost, 
												formatDate($details['Event']['start_date']), $details['Event']['location'],formatDate(date('Y-m-d H:i:s'))), $content);
				$email_content['Emailtemplate']['content'] = $content;
				
				$email = new CakeEmail('smtp');
				$email->from(array (ADMIN_EMAIL => APPLICATION_NAME))
						->to($data['email'])
						->emailFormat('html')
						->subject($email_content['Emailtemplate']['subject'])
						->send($content);
				
				$this->redirect(array('controller' => 'events', 'action' => 'registration_success',$data['register_id']));
			
			}else{
				
				$parr = array(
							'registration_id' => $data['register_id'],
							'status' => 'failure',
							'error_message' => $payment->failure_message,
							'created' => date('Y-m-d H:i:s')
						);
				
				$this->Payment->create();	
				$this->Payment->save($parr);
				
				$this->Session->setFlash(__('Your payment was not processed. Please contact administrator.'),'default',array(),'error');
				$this->redirect(array('controller' => 'events', 'action' => 'event_payment_details', $data['register_id']));	
			}
		 
			
			}catch(Exception $e){
					 // Card was declined.
					    $e_json = $e->getJsonBody();
					    $error = $e_json['error'];
						
						$parr = array(
							'registration_id' => $data['register_id'],
							'status' => 'failure',
							'error_message' => $error['message'],
							'created' => date('Y-m-d H:i:s')
						);
				
						$this->Payment->create();	
						$this->Payment->save($parr);
						
						$this->Session->setFlash(__($error['message']),'default',array(),'error');
						$this->redirect(array('controller' => 'events', 'action' => 'event_payment_details', $data['register_id']));	
			}	
		}
	 }

	
	
}