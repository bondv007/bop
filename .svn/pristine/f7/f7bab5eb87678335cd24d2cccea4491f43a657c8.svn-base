<?php
/**
 * Img180.com V 1.0
 * Purpose: FOR CONTACT US FORM
 * Author : Nitin
 * Created: 30 August, 2012
*/

class ContactUsController extends AppController 
{
	public $uses = array('ContactUs');
	public $components = array('Email');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('index', 'sponsorship_inquiry'));
	}
	
	/**
	 * Purpose : TO dispaly contact us form & send mail
	 * Created on : 30-Sep-2013
	 * Author : Nitin
	*/
	function index()
	{
		$errors = '';
		$error_flag = false;
		$add_errors = array();

		if ($this->request->is('post'))
		{
			$this->ContactUs->set($this->data);

			//Recapthca validation
			/*App::import('Vendor', 'recaptchalib');
			$resp = recaptcha_check_answer(CAPCHA_PRIVATE_KEY, $_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			
			if(!$resp->is_valid)
			{
				$error_flag = true;
				$add_errors[] = __('Please enter captcha code correctly');
			}*/
			
			if($this->ContactUs->validates() && !$error_flag)
			{
				//SENDING THE MAIL
				$this->loadModel('Emailtemplate');
				
				$full_name = $this->data['ContactUs']['first_name'].' '.$this->data['ContactUs']['last_name'];
				$srch_array = array("{{name}}" => $full_name, "{{email_id}}" => $this->data['ContactUs']['email_id'], "{{subject}}" => $this->data['ContactUs']['subject'], "{{message}}" => nl2br($this->data['ContactUs']['message']));
				$email_values = $this->Emailtemplate->getvalues('contact_us', $srch_array);

				$to_emailid = $email_values['from_email'];
				$this->Email->from = $full_name.' <'.$this->data['ContactUs']['email_id'].'>';
				$this->Email->to = $to_emailid;
				$this->Email->subject = $email_values['subject'];
				$this->Email->sendAs = 'html';
				$this->Email->send($email_values['content']);

				$this->Session->setFlash(__("Thank you for contacting. You will be hearing from us very soon."), 'flash_success');
				$this->redirect($this->referer());
			}
			else
			{
				$errors = $this->ContactUs->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}

		//TO GET THE BLOCK
		$this->loadModel('Block');
		$row_blk_top = $this->Block->get_block('contact_us_top');
		$row_blk_address = $this->Block->get_block('contact_us_address');

		$this->set(compact('errors', 'row_blk_top', 'row_blk_address'));
	}
	
	/**
	 * Purpose : TO dispaly contact us form & send mail
	 * Created on : 30-Sep-2013
	 * Author : Nitin
	*/
	function sponsorship_inquiry()
	{
		$errors = '';
		$error_flag = false;
		$add_errors = array();
		$ARR_SPONSORSHIP_TYPE = Configure::read('ARR_SPONSORSHIP_TYPE');

		if ($this->request->is('post'))
		{
			$this->ContactUs->set($this->data);

			//Recapthca validation
			/*App::import('Vendor', 'recaptchalib');
			$resp = recaptcha_check_answer(CAPCHA_PRIVATE_KEY, $_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			
			if(!$resp->is_valid)
			{
				$error_flag = true;
				$add_errors[] = __('Please enter captcha code correctly');
			}*/
			
			if($this->ContactUs->validates() && !$error_flag)
			{
				//SENDING THE MAIL
				$this->loadModel('Emailtemplate');
				
				$full_name = $this->data['ContactUs']['first_name'].' '.$this->data['ContactUs']['last_name'];
				$srch_array = array("{{name}}" => $full_name, "{{email_id}}" => $this->data['ContactUs']['email_id'], "{{sponsorship_type}}" => @$ARR_SPONSORSHIP_TYPE[$this->data['ContactUs']['sponsorship_type']], "{{event_date}}" => $this->data['ContactUs']['event_date'], "{{message}}" => nl2br($this->data['ContactUs']['message']));
				$email_values = $this->Emailtemplate->getvalues('sponsorship_inquiry', $srch_array);

				$to_emailid = $email_values['from_email'];
				$this->Email->from = $full_name.' <'.$this->data['ContactUs']['email_id'].'>';
				$this->Email->to = $to_emailid;
				$this->Email->subject = $email_values['subject'];
				$this->Email->sendAs = 'html';
				$this->Email->send($email_values['content']);

				$this->Session->setFlash(__("Thank you for sending inquiry. You will be hearing from us very soon."), 'flash_success');
				$this->redirect($this->referer());
			}
			else
			{
				$errors = $this->ContactUs->validationErrors;
				$errors = array_merge($errors, $add_errors);
			}
		}

		//TO GET THE BLOCK
		$this->loadModel('Block');
		$row_blk_top = $this->Block->get_block('sponsorship_inquiry_top');

		$this->set(compact('errors', 'row_blk_top', 'ARR_SPONSORSHIP_TYPE'));
	}
	
}	
