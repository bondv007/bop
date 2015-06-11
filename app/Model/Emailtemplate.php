<?php
App::uses('AppModel', 'Model');
/**
* Wod Model
*
* @project Crossfit
* @since 6 August 2013
* @version Cake Php 2.3.8
* @author Bhanu Prakash Pandey
*/
class Emailtemplate extends AppModel {

	/**
	 * Purpose : TO GET EMAIL TEMPLATE VALUES
	 * Created on : 24-Nov-2011
	 * Author : Nitin
	*/
	function getvalues($name, $values_array = array(), $subject_val_array = array())
	{
		/*
			To access/use a model in a component is not generally recommended; If you end up needing one, you'll need to instantiate your model class and use it
			manually.
			$EmailTemplate = ClassRegistry::init('EmailTemplate');
		*/

		//$EmailTemplate = ClassRegistry::init('EmailTemplate');
		//adding additional values to the array.
		$values_array["{{sitename}}"] = SITENAME;
		$values_array["{{logo}}"] = EMAIL_LOGO_PATH;
		$values_array["{{siteurl}}"] = SITE_URL;

		$row = $this->findByEmailFor($name);
		if(count($row))
		{
			$row = $row['Emailtemplate'];
			if(count($values_array))
			{
				$arr_keys = array_keys($values_array);
				$arr_values = array_values($values_array);

				$email_content = str_replace($arr_keys, $arr_values, $row['content']);

				$template_file_content = file_get_contents('email_template.html');
				$template_file_content = str_replace($arr_keys, $arr_values, $template_file_content);

				$final_content = str_replace('{{{EMAIL_CONTENT_HERE}}}', $email_content, $template_file_content);

				$row['content'] = $final_content;
			}
			
			if(!empty($subject_val_array))
			{
				$arr_keys = array_keys($subject_val_array);
				$arr_values = array_values($subject_val_array);

				$row['subject'] = str_replace($arr_keys, $arr_values, $row['subject']);
			}

			return $row;
		}
	}

}
