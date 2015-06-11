<?php

/**
 * Project : Toolcup.com
 * Author  : Nitin
 * Created on : 10-Nov-2011
 * Description : Common helper for custom created function
 */
class XicomHelper extends AppHelper
{
	var $helpers = array('Session', 'Html');
	var $components = 'Session';

	/**
	 * Purpose : to display session errors
	 * Created on : 10-Nov-2011
	 * Author : Nitin
	 */
	function display_errors($errors = '')
	{
		$msg = $this->Session->flash();
		if ($msg != '')
		{
			echo $msg;
		}
		elseif ($errors)
		{
			$this->str_from_arr($str, $errors);
			$str = array_unique($str);
			$str = @implode('<br/>', $str);
			echo '<div class="flash_error">' . $str . '</div>';
		}
		else
		{
			echo $this->Session->flash('auth');
		}
	}

	/**
	 * Purpose : to display session errors
	 * Created on : 10-Nov-2011
	 * Author : Nitin
	 */
	function str_from_arr(&$str, $errors)
	{
		if (is_array($errors))
		{
			foreach ($errors as $val)
			{
				$this->str_from_arr($str, $val);
			}
		}
		else
		{
			$str[] = $errors;
		}
	}

	/**
	 *  Creates name of thumb image file as per their thumb size convension
	 * 
	 *  @param string $img_name file name of the image
	 *  @param int $width width of thumb image
	 *  @param int $height height of thum image
	 * 	@since 12th June 2012
	 * 	@author shiv shankar
	 *  @return mixed string file name if success else boolean false
	 *  @access public
	 *  @author shiv shankar
	 */
	function get_thumb_name_of_size($img_name, $width, $height)
	{
		if (empty($img_name))
		{
			return false;
		}
		$expld_img_name = explode('.', $img_name);

		return "$expld_img_name[0]_{$width}x{$height}.$expld_img_name[1]";
	}

	/**
	 * Purpose : TO DISPLAY THE PROFIENCY OF THE SKILL
	 * Created on : 17-Jul-2012
	 * Author : Nitin
	 */
	function dis_skills_rate($no)
	{
		$out = '<ul class="proficiency">';
		for($i=1; $i<=10; $i++)
		{
			$out .= '<li class="'.(($i <= $no)?'rate':'').'"></li>';
		}
		$out .= '</ul>';
		echo $out;
	}

	/**
	 * Purpose : TO DISPLAY FACEBOOK LOGIN BUTTON
	 * Created on : 31-Jul-2012
	 * Author : Nitin
	 */
	function fb_button($distxt, $extra="")
	{
		$out = '';
		
		//IF THE FUNCTION IS CALLED MORE THAN ONCE ON THE SAME PAGE THEN NOT TO ADD SCRIPT AGAIN
		if(!defined('FB_BUTTON_SCRIPT_FLAG'))
		{
			$out = '<script type="text/javascript">
				window.fbAsyncInit = function() {
					FB.init({
					  appId      : \''.FB_APP_ID.'\', // App ID
					  status     : true, // check login status
					  cookie     : true // enable cookies to allow the server to access the session
					  //xfbml      : true  // parse XFBML
					});
				};
		  
				(function() {
					var e = document.createElement(\'script\'); e.async = true;
					e.src = document.location.protocol +
					\'//connect.facebook.net/en_US/all.js\';
					document.getElementById(\'fb-root\').appendChild(e);
				}());
		  
				function fbconnect_login() {
					FB.login(function(response) {
						//alert(JSON.stringify(response))
						//alert(response.authResponse.accessToken)
						if (response.status == \'connected\') 
						{
							window.location=\''.SITE_URL.'user/fb_connect/\';
						}
						/* else 
						{
							window.location.reload();
						} */
					}, {scope:\'email,user_birthday,user_location,user_about_me,user_hometown\'});
				}
			</script>';

			define('FB_BUTTON_SCRIPT_FLAG', true);
		}
		
		$out .= '<a href="javascript:void(0);" onclick="fbconnect_login()" '.$extra.'>'.$distxt.'</a>';

		return $out;
	}

	/**
	 * Purpose : TO DISPLAY LINKED LOGIN BUTTON
	 * Created on : 3-Sep-2012
	 * Author : Nitin
	 */
	function twitter_button($distxt, $extra = '')
	{
		$out = '<a href="'.SITE_URL.'user/twitter_connect/redirect/" '.$extra.'>'.$distxt.'</a>';
		echo $out;
	}
	
	/**
	 * Purpose : TO GET THE IMAGE FUNDRAISER
	 * Created on : 25-Jan-2013
	 * Author : Nitin
	 */
	function get_fundraiser_img($row_pro, $width = '', $height = '')
	{
		$shw_img_url = '';
		$img_url = '';
		$vid_img_url = '';
		
		if(!empty($row_pro))
		{
			if(!empty($row_pro['FundraiserImg']['filename']))
			{
				if(!empty($width) && !empty($height))
				{
					$img_url = create_thumb_imgname($row_pro['FundraiserImg']['filename'], $width, $height, UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS);
				}
				else
				{
					$img_url = SITE_URL.UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS.$row_pro['FundraiserImg']['filename'];
				}
			}
			
			if(!empty($row_pro['FundraiserVideo']['img']))
			{
				if(!empty($width) && !empty($height))
				{
					$vid_img_url = create_thumb_imgname($row_pro['FundraiserVideo']['img'], $width, $height, UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS);
				}
				else
				{
					$vid_img_url = SITE_URL.UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS.$row_pro['FundraiserVideo']['img'];
				}
			}
			
			if($row_pro['Fundraiser']['shw_pri'] == 1)
			{
				$shw_img_url = $img_url;
			}
			elseif($row_pro['Fundraiser']['shw_pri'] == 2)
			{
				$shw_img_url = $vid_img_url;
			}
		}
		
		if(empty($shw_img_url))
		{
			if(!empty($img_url))
			{
				$shw_img_url = $img_url;
			}
			elseif(!empty($vid_img_url))
			{
				$shw_img_url = $vid_img_url;
			}
			else
			{
				$shw_img_url = IMAGES_PATH.'noimage_'.$width.'x'.$height.'.gif';
			}
		}
		
		return $shw_img_url;
	}
	
	/**
	 * Purpose : TO GET THE ARTICLE PRODUCT
	 * Created on : 25-Jan-2013
	 * Author : Nitin
	 */
	function get_article_img($row_a)
	{
		$shw_img_url = '';
		$img_url = '';
		$vid_img_url = '';
		
		if(!empty($row_a))
		{
			if(!empty($row_a['Filereci']['file_name']))
			{
				$img_url = UPLOAD_ARTICLE_DIR.$row_a['Article']['id'].DS.$row_a['Filereci']['file_name'];
			}
			
			if(!empty($row_a['Filerecv']['video_name']))
			{
				$vid_img_url = UPLOAD_ARTICLE_DIR.$row_a['Article']['id'].DS.$row_a['Filerecv']['file_name'];
			}
			
			if($row_a['Article']['shw_pri'] == 1)
			{
				$shw_img_url = $img_url;
			}
			elseif($row_a['Article']['shw_pri'] == 2)
			{
				$shw_img_url = $vid_img_url;
			}
		}
		
		if(empty($shw_img_url))
		{
			if(!empty($img_url))
			{
				$shw_img_url = $img_url;
			}
			elseif(!empty($vid_img_url))
			{
				$shw_img_url = $vid_img_url;
			}
			else
			{
				$shw_img_url = 'no-image.jpg';
				$shw_img_url = $shw_img_url;
			}
		}
		
		return $shw_img_url;
	}

	/**
	 * Purpose : TO DISPLAY ADS
	 * Created on : 21-Nov-2013
	 * Author : Nitin
	 */
	function display_ad($dis_size, $page, $extra = '')
	{
		App::import('Model', 'Ad');
		
		$arr_ad_ids = Configure::read('arr_ad_ids');
		
		$cond_arr = array('Ad.dis_size' => $dis_size, 'Ad.page' => $page);
		$ad_cond_arr = array();
		
		if(!empty($arr_ad_ids))
		{
			$ad_cond_arr = array('not' => array('id' => $arr_ad_ids));
		}

		$Ad = new Ad;
		$row_ad = $Ad->find('first', array('fields' => array('id', 'type', 'img', 'url', 'code'), 'conditions' => array_merge($cond_arr, $ad_cond_arr), 'order' => 'rand()'));

		//IF NO RESULT FOUND THEN SEARCHING FOR OTHER
		if(empty($row_ad))
		{
			$cond_arr = array('Ad.dis_size' => $dis_size, 'Ad.page' => 'other');
			$row_ad = $Ad->find('first', array('fields' => array('id', 'type', 'img', 'url', 'code'), 'conditions' => array_merge($cond_arr, $ad_cond_arr), 'order' => 'rand()'));
		}

		if(!empty($row_ad))
		{
			$arr_size = @explode('_', $dis_size);
			$width = $arr_size[0];
			$height = $arr_size[1];

			if($row_ad['Ad']['type'] == 'code')
			{
				$ad_code = $row_ad['Ad']['code'];
				
				return '<div style="overflow:hidden; width:'.$width.'px; height:'.$height.'px; display:block; " '.$extra.'>'.$ad_code.'</div>';
			}
			elseif($row_ad['Ad']['type'] == 'banner')
			{
				$arr_ad_ids[] = $row_ad['Ad']['id'];
				Configure::write('arr_ad_ids', $arr_ad_ids);

				if(file_exists(UPLOAD_AD_DIR.$row_ad['Ad']['img']))
				{
					return '<div style="overflow:hidden; width:'.$width.'px; height:'.$height.'px; display:block; " '.$extra.'><a href="'.$row_ad['Ad']['url'].'" target="_blank"><img src="'.DISPLAY_AD_DIR.$row_ad['Ad']['img'].'" /></a></div>';
				}
			}
		}

		return '';
	}

	/**
	 * Purpose : TO DISPLAY ADS
	 * Created on : 21-Nov-2013
	 * Author : Nitin
	 */
	function recursive_category_listing($result, $q_params = array(), $level = 1)
	{
		$q_params_forcat = $q_params;
		$out = '';
		if(!empty($result))
		{
//			$out .= '<ul class="'.(($level == 2) ? 'sub-category':'').'">';
			$out .= '<ul>';
			foreach($result as $row)
			{
				//$out .= '<li class="'.(($level == 1)?'inactive':'').'">' . $row['Category']['title'];
				//$out .= '<li class="'.(($level == 1)?'levels-menu':'').(!empty($row['Category']['Category'])?' arrow':'').'">' . $this->Html->link($row['Category']['title'], array_merge(array('action' => 'search', 'category' => $row['Category']['slug'].'---'.$level), $q_params_forcat), array('class' => ''));
				
				$class = '';
				$scategory_class = ((!empty($q_params['category']) && $q_params['category'] == $row['Category']['slug'].'---'.$level) ? 'selected' : '');

				$out .= '<li class="'.(!empty($row['Category']['Category']) ? ' levels-menu' : '') . '">' .
							$this->Html->link(
								$row['Category']['title'],
								array_merge(array('action' => 'search', 'category' => $row['Category']['slug'].'---'.$level), $q_params_forcat),
								array('class' => $scategory_class)
							);

				if(!empty($row['Category']['Category']))
				{
					$out .= $this->recursive_category_listing($row['Category']['Category'], $q_params_forcat, ($level+1));
				}

				$out .= '</li>';
			}
			$out .= '</ul>';
		}
		return $out;
	}
	
	/**
	 * Purpose : TO RETURN LEVEL OF USER BASED ON POINTS
	 * Created on : 22-Jan-2014
	 * Author : Nitin
	 */
	function leaderboard_level($points)
	{
		$ARR_QA_LEADERBOARD_LEVEL = Configure::read('ARR_QA_LEADERBOARD_LEVEL');
		
		foreach($ARR_QA_LEADERBOARD_LEVEL as $rang => $level)
		{
			$arr = @explode('-', $rang);
			
			if(!empty($arr[0]) && !empty($arr[1]) && ($points >= $arr[0]) && ($points <= $arr[1]))
			{
				return $level;
			}
			elseif(!empty($arr[0]) && empty($arr[1]) && ($points >= $arr[0]))
			{
				return $level;
			}
		}
		
		return '';
	}
	
	/**
	 * Purpose : TO DISPLAY DIFFERENCE IN MONTH AND YEAR
	 * Created on : 17-Apr-2014
	 * Author : Nitin
	*/
	function dis_diff_start_end_date($start_date, $end_date)
	{
		$start_date = '01-'.$start_date;
		
		if($end_date != '-')
		{
			$end_date = '01-'.$end_date;
		}
		else
		{
			$end_date = '01-'.date("m-Y");
		}
		
		$diff = abs(strtotime($end_date) - strtotime($start_date));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		
		$out = '';
		if(!empty($years))
		{
			$out .= $years.' years';
		}
		
		if(!empty($months))
		{
			$out .= (!empty($out)?' and ':'');
			$out .= $months.' months';
		}
		
		return (!empty($out)?'('.$out.')':'');
	}
	
}
