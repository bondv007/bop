<?php

	//THIS IS TEMPORARY VARIABLE DECLARED BECAUSE IT IS NECESSARY TO DECLARE ATLEAST ONE $config VARIABLE IF WE LOAD THE FILE USING Configure::load
	$config['ZX'] = 'X';

	
	/**
	 * Purpose : TO GET THE CLEAN URL BY REPLACING EXTRA CHARACTERS
	 * Created on : 20-Dec-2011
	 * Author : Nitin
	*/
	function clean_url($text, $replace_with = '-')
	{
		$text=trim(strtolower($text));
		$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
		//$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
		//$text = str_replace($code_entities_match, $code_entities_replace, $text);
		$text = str_replace($code_entities_match, $replace_with, $text);
		$text = str_replace('--', $replace_with, $text);
		$text = str_replace('--', $replace_with, $text);
		$text = str_replace('--', $replace_with, $text);
		$text = strtolower($text);
		return $text;
	} 


	/**
	 * Purpose : to append http::// in the url
	 * Created on : 17-Dec-2011
	 * Author : Nitin
	*/
	function make_http_url($url)
	{
		if(strpos($url, '://') == false){
			return 'http://'.$url;
		}
		return $url;
	}
	
	/**
	 * Purpose : to get the domain name from the url
	 * Created on : 17-Dec-2011
	 * Author : Nitin
	*/
	function get_hostname($url)
	{
		$arr = parse_url($url);
		$host = $arr['host'];
		return str_replace('www.', '', $host);
	}
	
	/**
	 * Purpose : TO CREATE THE THUMB IMAGE NAME (same function also created in app_controller.)
	 * Created on : 9-Dec-2011
	 * Author : Nitin
	*/
	function create_thumb_imgname($img_name, $width, $height, $thumb_subloc)
	{
		$dotpos = strrpos($img_name, '.');
		$firstpart = substr($img_name, 0, $dotpos);
		$ext = substr($img_name, ($dotpos+1));
		
		return $thumb_subloc.$firstpart.'_'.$width.'x'.$height.'.'.$ext;
	}
	
	/**
	 * Purpose : FUNCTION TO TRIM FOR array_map FUNCTION
	 * Created on : 15-Mar-2012
	 * Author : Nitin
	*/
	function x_trim($val)
	{
		return trim($val);
	}
	
	
	/**
	 * Purpose : FUNCTION TO Limit the words
	 * Created on : 5-May-2012
	 * Author : Prakhar
	*/
	function limit_words($string, $word_limit)
	{
		$total_words = str_word_count($string);
		$words = explode(" ",$string);
		$newstring = implode(" ",array_splice($words,0,$word_limit));
		if($total_words > $word_limit)
		{
			$newstring = $newstring . ' ...';
		}
			return $newstring;
	}

	/**
	 * Purpose : TO DISPLAY DATE IN FORMAT "F Y" DATE IS LESS THAN ONE MONTH ELSE IN "M d, Y"
	 * param : date
	 * Created on : 17-Aug-2012
	 * Author : Nitin
	*/
	function format_date_mon($dat)
	{
		$str_dat = strtotime($dat);
		$str_mon_back = strtotime("-30 day");
		
		if ($str_dat < $str_mon_back)
		{
			return date("F Y", strtotime($dat));
		}
		else
		{
			return date("M d, Y", strtotime($dat));
		}
	}
	
	/**
	 * Purpose : to display formatted date
	 * param : date
	 * Created on : 23-Nov-2011
	 * Author : Nitin
	 */
	function formatDate($dat, $frmt = "M d, Y")
	{
		if ($dat != '0000-00-00 00:00:00' && $dat != '0000-00-00')
		{
			return date($frmt, strtotime($dat));
		}
		/* elseif(strlen($dat) == 19  && $dat != '0000-00-00 00:00:00'){
		  return date("d, M Y H:i:s", strtotime($dat));
		  } */
	}

	/**
	 * Purpose : to display formatted date and time
	 * param : date
	 * Created on : 23-Nov-2011
	 * Author : Nitin
	 */
	function formatDateTime($dat, $format = '')
	{
		if (strlen($dat) == 10 && $dat != '0000-00-00')
		{
			if(empty($format))
			{
				$format = "M d, Y";
			}
			
			return date($format, strtotime($dat));
		}
		elseif (strlen($dat) == 19 && $dat != '0000-00-00 00:00:00')
		{
			if(empty($format))
			{
				$format = "M d, Y H:i";
			}
			
			return date($format, strtotime($dat));
		}
	}

	/**
	 * Purpose : TO FORMAT THE AMOUNT
	 * param : date
	 * Created on : 7-Jul-2012
	 * Author : Nitin
	 */
	function format_amt($amt, $dec=0){
		if($amt != '')
		{
			if($dec != '')
			{
				$amt = number_format($amt, $dec);
			}
			return DEFAULT_CURRENCY.$amt;
		}
		return 0;
	}
	
	/**
	 * Purpose : FUNCTION TO DOWNLOAD THE FILE (COPIED FROM CODEIGNITER)
	 * Created on : 6-June-2012
	 * Author : Nitin
	*/
	function force_download($filename = '', $data = '')
	{
		if ($filename == '' OR $data == '')
		{
			return FALSE;
		}

		// Try to determine if the filename includes a file extension.
		// We need it in order to set the MIME type
		if (FALSE === strpos($filename, '.'))
		{
			return FALSE;
		}

		// Grab the file extension
		$x = explode('.', $filename);
		$extension = end($x);

		// Load the mime types
		@include(APPPATH.'config/mimes'.EXT);

		// Set a default mime if we can't find it
		if ( ! isset($mimes[$extension]))
		{
			$mime = 'application/octet-stream';
		}
		else
		{
			$mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
		}

		// Generate the server headers
		if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
		{
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
			header("Content-Length: ".strlen($data));
		}
		else
		{
			header('Content-Type: "'.$mime.'"');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
			header("Content-Length: ".strlen($data));
		}

		exit($data);
	}
	
	/**
	 * Purpose : TO MAKE THE DISPLAY NAME
	 * Created on : 10-Jul-2012
	 * Author : Nitin
	 */
	function make_displayname($fname, $sname)
	{
		$flett = substr($sname, 0, 1);
		return $fname.' '.$flett.'.';
	}
	
	/**
	 * Purpose : TO DISPLAY THE VIDEO
	 * Created on : 12-Jul-2012
	 * Author : Nitin
	 */
	function getvideo_code($videourl, $width='524', $height='432')
	{
		if(!empty($videourl))
		{
			if(strrpos($videourl, 'vimeo') !== false)
			{
				$videotype = "vimeo";
			}
			else
			{
				$videotype = "youtube";
			}

			if(strtolower($videotype) == "vimeo")
			{
				$v = substr(parse_url($videourl, PHP_URL_PATH), 1);
				if(!empty($v))
				{
					return '<iframe src="http://player.vimeo.com/video/'.$v.'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';
				}
			}
			else
			{
				//FOR THE VIDEO URL LIKE http://www.youtube.com/watch?v=mjwOT8pmydE
				preg_match("/v=([^(\&|$)]*)/", $videourl, $matches);
				$v = '';
				
				if(!empty($matches[1]))
				{
					$v = $matches[1];
				}
				
				if(!$v)
				{
					//FOR THE VIDEO URL LIKE http://youtu.be/Nt8ANOkqbIs
					$sl_pos = strrpos($videourl, '/');
					$v = substr($videourl, ($sl_pos+1));
				}
				
				if($v)
				{
					return '<iframe width="'.$width.'" height="'.$height.'" src="//www.youtube.com/embed/'.$v.'?wmode=opaque" frameborder="0" allowfullscreen></iframe>';
					//return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$v.'&hl=en&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$v.'&hl=en&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed></object>';
				}
			}
		}
		return false;
	}
	
	/**
	 * Purpose : TO DISPLAY THE VIDEO
	 * Created on : 12-Jul-2012
	 * Author : Nitin
	 */
	function video_embed_url($videourl)
	{
		if(!empty($videourl))
		{
			if(strrpos($videourl, 'vimeo') !== false)
			{
				$videotype = "vimeo";
			}
			else
			{
				$videotype = "youtube";
			}

			if(strtolower($videotype) == "vimeo")
			{
				$v = substr(parse_url($videourl, PHP_URL_PATH), 1);
				if(!empty($v))
				{
					return 'http://player.vimeo.com/video/'.$v;
				}
			}
			else
			{
				//FOR THE VIDEO URL LIKE http://www.youtube.com/watch?v=mjwOT8pmydE
				preg_match("/v=([^(\&|$)]*)/", $videourl, $matches);
				$v = '';
				
				if(!empty($matches[1]))
				{
					$v = $matches[1];
				}
				
				if(!$v)
				{
					//FOR THE VIDEO URL LIKE http://youtu.be/Nt8ANOkqbIs
					$sl_pos = strrpos($videourl, '/');
					$v = substr($videourl, ($sl_pos+1));
				}
				
				if($v)
				{
					return '//www.youtube.com/v/'.$v;
				}
			}
		}
		return false;
	}
	
	/**
	 * Purpose : TO PARSE VIDEO URL
	 * Created on : 8-Feb-2013
	 * Author : Nitin
	 */
	function parse_video($videourl)
	{
		if(strrpos($videourl, 'vimeo') !== false)
		{
			$videotype = "vimeo";
		}
		else
		{
			$videotype = "youtube";
		}

		if(strtolower($videotype) == "vimeo")
		{
			$v = substr(parse_url($videourl, PHP_URL_PATH), 1);
			return array('id' => $v, 'type' => $videotype);
		}
		else
		{
			//FOR THE VIDEO URL LIKE http://www.youtube.com/watch?v=mjwOT8pmydE
			preg_match("/v=([^(\&|$)]*)/", $videourl, $matches);
			$v = $matches[1];
			
			if(!$v)
			{
				//FOR THE VIDEO URL LIKE http://youtu.be/Nt8ANOkqbIs
				$sl_pos = strrpos($videourl, '/');
				$v = substr($videourl, ($sl_pos+1));
			}
			
			return array('id' => $v, 'type' => $videotype);
		}

		return false;
	}
	
	/**
	 * Purpose : TO SHOW SOME PART OF THE DATA
	 * Created on : 17-Jul-2012
	 * Author : Nitin
	 */
	function showSomeData($data, $limit, $postfix = '...')
	{
		if(strlen($data) > $limit)
		{
			return substr(trim($data), 0 , $limit).$postfix;
		}
		return $data;
	}
	
	/**
	 * Purpose : TO GET THE MIME TYPE OF FILE
	 * Created on : 17-Jul-2012
	 * Author : Nitin
	 */
	function get_mime_content_type($file)
	{
		$mimes_arr = array(	'hqx'	=>	'application/mac-binhex40',
				'cpt'	=>	'application/mac-compactpro',
				'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),
				'bin'	=>	'application/macbinary',
				'dms'	=>	'application/octet-stream',
				'lha'	=>	'application/octet-stream',
				'lzh'	=>	'application/octet-stream',
				'exe'	=>	array('application/octet-stream', 'application/x-msdownload'),
				'class'	=>	'application/octet-stream',
				'psd'	=>	'application/x-photoshop',
				'so'	=>	'application/octet-stream',
				'sea'	=>	'application/octet-stream',
				'dll'	=>	'application/octet-stream',
				'oda'	=>	'application/oda',
				'pdf'	=>	array('application/pdf', 'application/x-download'),
				'ai'	=>	'application/postscript',
				'eps'	=>	'application/postscript',
				'ps'	=>	'application/postscript',
				'smi'	=>	'application/smil',
				'smil'	=>	'application/smil',
				'mif'	=>	'application/vnd.mif',
				'xls'	=>	array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
				'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint'),
				'wbxml'	=>	'application/wbxml',
				'wmlc'	=>	'application/wmlc',
				'dcr'	=>	'application/x-director',
				'dir'	=>	'application/x-director',
				'dxr'	=>	'application/x-director',
				'dvi'	=>	'application/x-dvi',
				'gtar'	=>	'application/x-gtar',
				'gz'	=>	'application/x-gzip',
				'php'	=>	'application/x-httpd-php',
				'php4'	=>	'application/x-httpd-php',
				'php3'	=>	'application/x-httpd-php',
				'phtml'	=>	'application/x-httpd-php',
				'phps'	=>	'application/x-httpd-php-source',
				'js'	=>	'application/x-javascript',
				'swf'	=>	'application/x-shockwave-flash',
				'sit'	=>	'application/x-stuffit',
				'tar'	=>	'application/x-tar',
				'tgz'	=>	array('application/x-tar', 'application/x-gzip-compressed'),
				'xhtml'	=>	'application/xhtml+xml',
				'xht'	=>	'application/xhtml+xml',
				'zip'	=>  array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
				'mid'	=>	'audio/midi',
				'midi'	=>	'audio/midi',
				'mpga'	=>	'audio/mpeg',
				'mp2'	=>	'audio/mpeg',
				'mp3'	=>	array('audio/mpeg', 'audio/mpg', 'audio/mpeg3'),
				'aif'	=>	'audio/x-aiff',
				'aiff'	=>	'audio/x-aiff',
				'aifc'	=>	'audio/x-aiff',
				'ram'	=>	'audio/x-pn-realaudio',
				'rm'	=>	'audio/x-pn-realaudio',
				'rpm'	=>	'audio/x-pn-realaudio-plugin',
				'ra'	=>	'audio/x-realaudio',
				'rv'	=>	'video/vnd.rn-realvideo',
				'wav'	=>	'audio/x-wav',
				'bmp'	=>	'image/bmp',
				'gif'	=>	'image/gif',
				'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
				'png'	=>	array('image/png',  'image/x-png'),
				'tiff'	=>	'image/tiff',
				'tif'	=>	'image/tiff',
				'css'	=>	'text/css',
				'html'	=>	'text/html',
				'htm'	=>	'text/html',
				'shtml'	=>	'text/html',
				'txt'	=>	'text/plain',
				'text'	=>	'text/plain',
				'log'	=>	array('text/plain', 'text/x-log'),
				'rtx'	=>	'text/richtext',
				'rtf'	=>	'text/rtf',
				'xml'	=>	'text/xml',
				'xsl'	=>	'text/xml',
				'mpeg'	=>	'video/mpeg',
				'mpg'	=>	'video/mpeg',
				'mpe'	=>	'video/mpeg',
				'qt'	=>	'video/quicktime',
				'mov'	=>	'video/quicktime',
				'avi'	=>	'video/x-msvideo',
				'movie'	=>	'video/x-sgi-movie',
				'doc'	=>	'application/msword',
				'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'xlsx'	=>	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'word'	=>	array('application/msword', 'application/octet-stream'),
				'xl'	=>	'application/excel',
				'eml'	=>	'message/rfc822'
			);

        $extension = strtolower(end(explode('.',$file)));
		if(isset($mimes_arr[$extension]))
		{
			return $mimes_arr[$extension];
		}
			
		return false;
	}
	
	function random_string($type = 'alnum', $len = 8)
	{
		switch($type)
		{
			case 'basic'	: return mt_rand();
				break;
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:
			case 'alpha'	:

					switch ($type)
					{
						case 'alpha'	:	$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'numeric'	:	$pool = '0123456789';
							break;
						case 'nozero'	:	$pool = '123456789';
							break;
					}

					$str = '';
					for ($i=0; $i < $len; $i++)
					{
						$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
					}
					return $str;
				break;
			case 'unique'	:
			case 'md5'		:

						return md5(uniqid(mt_rand()));
				break;
		}
	}
	
	/**
	 * Purpose : TO CONVERT OBJECT TO ARRAY
	 * Created on : 1-Aug-2012
	 * Author : Nitin
	*/
	function object_2_array($result)
	{
		$array = array();
		foreach ($result as $key=>$value)
		{
			if (is_object($value))
			{
				$array[$key]=object_2_array($value);
			}
			if (is_array($value))
			{
				$array[$key]=object_2_array($value);
			}
			else
			{
				$array[$key]=$value;
			}
		}
		return $array;
	}  
	
	/**
	 * Purpose : show the time only if on the day, show the day if on the same week, if older than the present week it would show the date. 
	 * Created on : 1-Aug-2012
	 * Author : Nitin
	 */
	function formatDateTimeAgoStruct($dat, $type = 'ago', $show_dayform = false)
	{
		if($dat)
		{
			$timestamp = strtotime($dat);
			$comp_timestamp = time();
			
			if($type == 'left')
			{
				$difference = $timestamp - $comp_timestamp;
			}
			else
			{
				$difference = $comp_timestamp - $timestamp;
				if($show_dayform && $difference > 86400)
				{
					return date('D, M d, Y', $timestamp);
				}
			}
			
			if($difference < 0)
			{
				if($type == 'left')
				{
					return 'Few seconds left';
				}
				else
				{
					return 'Few seconds ago';
				}
			}
			else
			{
				$periods = array('days' => 86400,'hours' => 3600,'min.' => 60);
				$output = '';
				if($type == 'ago' && $difference >= 86400)
				{
					$granularity = 1;
				}
				else
				{
					$granularity = 3;
				}
				
				foreach($periods as $key => $value)
				{
					if($difference >= $value)
					{
						$time = floor($difference / $value);
						//echo '<br><br>'.$difference.'---'.$value.'---'.$time.'--<br><br>';
						$difference %= $value;
						$output .= ($output ? ' ' : '').$time;
						$output .= ' '.$key;
						$granularity--;
					}
					if($granularity == 0) break;
				}
				
				if($type == 'left')
				{
					return ($output ? $output : 'Few seconds').' left';
				}
				else
				{
					return ($output ? $output : 'Few seconds').' ago';
				}
			}
		}
	}
	
	/**
	 * Purpose : TO DISPLAY THE RATING
	 * Created on : 18-Aug-2012
	 * Author : Nitin
	 */
	function display_rating($rating = '0', $class = '')
	{
		$out = '<ul class="'.$class.'">';
		for($i=1; $i<=5; $i++)
		{
			$out .= '<li><img src="'.IMAGES_PATH.'star-'.(($i <= $rating)?'on':'off').'.png" alt="" /></li>';
		}
		$out .= '</ul>';
		
		return $out;
	}
	
	/**
	 * Purpose : TO DISPLAY THE USER IMAGE
	 * Created on : 27-Aug-2012
	 * Author : Nitin
	 */
	function get_user_image($imgname, $width, $height)
	{
		if(!empty($imgname))
		{
			if(@file_exists(UPLOAD_USERS_DIR.$imgname))
			{
				$img_flag = true;
				return create_thumb_imgname($imgname, $width, $height, DISPLAY_USERS_DIR);
			}
		}

		if($width == 110 && $height == 110)
		{
			return IMAGES_PATH.'silhouette_110x110.png';
		}
		else
		{
			$tsize = $width.'x'.$height;
			return IMAGES_PATH.'noimage_'.$tsize.'.gif';
		}
	}
	
	/**
	 * Purpose : TO DISPLAY THE USER IMAGE
	 * Created on : 27-Aug-2012
	 * Author : Nitin
	 */
	function get_product_image($imgname, $width, $height, $thumb_subloc)
	{
		if(!empty($imgname))
		{
			if(@file_exists($thumb_subloc.DS.$imgname))
			{
				return create_thumb_imgname($imgname, $width, $height, $thumb_subloc.DS);
			}
		}

		$tsize = $width.'x'.$height;
		return IMAGES_PATH.'noimage_'.$tsize.'.gif';
	}
	
	/**
	 * Purpose : TO ADD CONDITION TO THE CONDITIONS ARRAY
	 * Created on : 20-Dec-2011
	 * Author : Nitin
	*/
	function append_condition(&$cond_arr, $field, $condition, $field_val)
	{
		if($field && $condition && $field_val)
		{
			switch($condition)
			{
				case 'equal': $cond_arr[$field] = $field_val;
					break;
				case 'in': $cond_arr[$field] = @explode(',', $field_val);
					break;
				case 'like': $cond_arr[$field.' LIKE'] = $field_val.'%';
					break;
				case 'any_like': $cond_arr[$field.' LIKE'] = '%'.$field_val.'%';
					break;
				default: $cond_arr[$field.' '.$condition] = $field_val;
					break;
			}
		}
	}

	/**
	 * Purpose : TO GET THE EXTENSION OF THE FILENAME
	 * Created on : 17-Dec-2011
	 * Author : Nitin
	*/
	function get_file_ext($file) 
	{
		$ext = substr(strrchr($file, '.'), 1);
		return strtolower($ext);
	}
	
	/**
	 * Purpose : TO GENERATE THE FILENAME ADDING THE POSTFIX
	 * Created on : 20-Dec-2011
	 * Author : Nitin
	*/	
	function generate_filename($file, $postfix = '')
	{
		$final_fname = '';
		$d_pos = strrpos($file, '.');
		$final_fname .= substr($file, 0, $d_pos);
		if($postfix)
		{
			$final_fname .= '_'.$postfix;
		}
		$final_fname .= substr($file, $d_pos);
		
		return $final_fname;
	}
	
	/**
	 * Purpose : TO CONCATINATE ERRORS
	 * Created on : 20-Dec-2011
	 * Author : Nitin
	*/
	function concatinate_errors($errors, $replace_with = '<br/>')
	{
		$str = '';

		if (!empty($errors))
		{
			str_from_arr($str, $errors);
			$str = array_unique($str);
			$str = @implode($replace_with, $str);
		}

		return $str;
	}
	
	/**
	 * Purpose : TO CONCATINATE ARRAY ERRORS
	 * Created on : 10-Nov-2011
	 * Author : Nitin
	 */
	function str_from_arr(&$str, $errors)
	{
		if (is_array($errors))
		{
			foreach ($errors as $val)
			{
				str_from_arr($str, $val);
			}
		}
		else
		{
			$str[] = $errors;
		}
	}
	
	/**
	 * Purpose : TO CHECK SLASH AT THE END OF PATH
	 * Created on : 10-Nov-2011
	 * Author : Nitin
	 */
	function append_slash(&$str)
	{
		if((strrpos($str, DS)+1) != strlen($str))
		{
			$str .= DS;
		}
	}
	
	/**
	 * Purpose : TO SHOW FIRST AND LAST CHARACTER OF STRING
	 * Created on : 9-Oct-2012
	 * Author : Nitin
	 */
	function first_last_str($str)
	{
		$out_str = '';
		if(!empty($str))
		{
			$out_str = substr($str, 0, 1);
			$str_len = strlen($str);
			if($str_len > 1)
			{
				$out_str .= str_pad('', ($str_len-2), '*');
				$out_str .= substr($str, ($str_len-1), 1);
			}
		}
		return $out_str;
	}

	/**
	 * Purpose : TO SHOW FIRST AND LAST CHARACTER OF STRING
	 * Created on : 9-Oct-2012
	 * Author : Nitin
	 */
	function validate_product_checkbox_arr($org_arr, $user_arr)
	{
		return array_intersect($org_arr, $user_arr);
	}

	/**
	 * Purpose : TO SHOW PREMIUM MEMBERSHIP BLOCK IF THE USER IS NOT A PAID MEMBER
	 * Created on : 17-Nov-2012
	 * Author : Nitin
	 */
	function premium_membership_block($row_blk, $extra = '')
	{
		$LANG = Configure::read('Config.language');
		//PREMIUM MEMBERSHIP BLOCK
		if(!empty($row_blk))
		{
			if(!empty($extra))
			{
				echo '<div '.$extra.'>';
			}
			
			if(!empty($row_blk['Block'][$LANG.'_title']))
			{
				echo '<h2>'.$row_blk['Block'][$LANG.'_title'].'</h2>';
			}
			echo $row_blk['Block'][$LANG.'_content'];
			
			if(!empty($extra))
			{
				echo '</div>';
			}
		}
	}

	function parseYoutubeVideoEntry($entry)
	{
		$obj= new stdClass;

		// get author name and feed URL
		$obj->author = $entry->author->name;
		$obj->authorURL = $entry->author->uri;

		// get nodes in media: namespace for media information
		$media = $entry->children('http://search.yahoo.com/mrss/');
		$obj->title = $media->group->title;
		$obj->description = $media->group->description;

		// get video player URL
		$attrs = $media->group->player->attributes();
		$obj->watchURL = $attrs['url']; 

		// get video thumbnail
		$attrs = $media->group->thumbnail[0]->attributes();
		$obj->thumbnailURL = $attrs['url']; 
			
		// get <yt:duration> node for video length
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		$obj->length = $attrs['seconds']; 

		// get <yt:stats> node for viewer statistics
		$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->statistics->attributes();
		$obj->viewCount = $attrs['viewCount']; 

		// get <gd:rating> node for video ratings
		$gd = $entry->children('http://schemas.google.com/g/2005'); 
		if ($gd->rating) { 
		$attrs = $gd->rating->attributes();
		$obj->rating = $attrs['average']; 
		} else {
		$obj->rating = 0;         
		}

		// get <gd:comments> node for video comments
		$gd = $entry->children('http://schemas.google.com/g/2005');
		if ($gd->comments->feedLink) { 
		$attrs = $gd->comments->feedLink->attributes();
		$obj->commentsURL = $attrs['href']; 
		$obj->commentsCount = $attrs['countHint']; 
		}

		// get feed URL for video responses
		$entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
		$nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.responses']"); 
		if (count($nodeset) > 0) {
			$obj->responsesURL = $nodeset[0]['href'];      
		}
		 
		// get feed URL for related videos
		$entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
		$nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.related']"); 
		if (count($nodeset) > 0) {
		$obj->relatedURL = $nodeset[0]['href'];      
		}

		// return object to caller  
		return $obj;      
	}
	
	function save_video_img($img_url, $save_loc = UPLOAD_TEMP_DIR)
	{
		$img_name = '';
		if($img_url)
		{
			/*if(($sl_pos = strrpos($img_url, '/')) !== false)
			{
				$img_name = 'video_'.substr($img_url, ($sl_pos+1));
			}*/
			
			$img_ext = substr($img_url, (strrpos($img_url, '.') + 1));
			$img_name = random_string('md5').'.'.$img_ext;
			
			append_slash($save_loc);
			
			//getting the picture of the user...
			$fp = fopen($save_loc.$img_name, 'w+');
			$img_content = @file_get_contents($img_url);
			@fwrite($fp, $img_content);
		}
		
		return $img_name;
	}
	
	/**
	 * Purpose : TO GET THE IMAGE OF USER
	 * Created on : 29-Jan-2013
	 * Author : Nitin
	 */
	function get_user_img($img_name, $width, $height)
	{
		if(!empty($img_name))
		{
			$shw_img_url = create_thumb_imgname($img_name, $width, $height, DISPLAY_USERS_DIR);
		}
		else
		{
			$shw_img_url = IMAGES_PATH.'noimage_'.$width.'x'.$height.'.gif';
		}
		
		return $shw_img_url;
	}	
	
	
	/**
	 * Purpose : TO GET THE NUMBER OF DAYS
	 * Created on : 29-Jan-2013
	 * Author : Nitin
	 */
	function get_num_days($comp_dat)
	{
		if(strlen($comp_dat) >= 8)
		{
			 // First we need to break these dates into their constituent parts:
			$gd_a = getdate(strtotime($comp_dat));
			$gd_b = getdate(time());
			 
			// Now recreate these timestamps, based upon noon on each day
			// The specific time doesn't matter but it must be the same each day
			$a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
			$b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
			 
			// Subtract these two numbers and divide by the number of seconds in a
			// day. Round the result since crossing over a daylight savings time
			// barrier will cause this time to be off by an hour or two.
			return round( abs( $a_new - $b_new ) / 86400 );
			
		}
	}
	
	/**
	 * Purpose : calculate years of age (input string: YYYY-MM-DD)
	 * Created on : 13-Dec-2013
	 * Author : Nitin
	 */
	function calculateAge($birthday_date)
	{
		if(!empty($birthday_date))
		{
			list($year,$month,$day) = explode("-",$birthday_date);
			
			$year_diff  = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff   = date("d") - $day;
			
			if($day_diff < 0 || $month_diff < 0)
			{
				$year_diff--;
			}
			
			return $year_diff;
		}
		return false;
	}

	/**
	 * Purpose : FUNCTION TO REPLACE THE EMAIL TEMPLATE CONTENT VALUES
	 * Created on : 4-Mar-2013
	 * Author : Nitin
	*/	
	function modify_emailtemp_content($row, $values_array = array())
	{
		if(!empty($values_array))
		{
			$arr_keys = array_keys($values_array);
			$arr_values = array_values($values_array);

			$email_content = str_replace($arr_keys, $arr_values, $row['content']);

			$row['content'] = $email_content;
		}
		
		return $row;
	}

	/**
	 * Purpose : TO CHECK SUB ADMIN IS AUTHORISED TO ACCESS PARTICULAR SECTION
	 * Created on : 31-Dec-2012
	 * Author : Nitin
	 */	
	function chk_admin_section_show($section_chk, $admin_type, $arr_permission)
	{
		if($admin_type == UserType::Admin)
		{
			return true;
		}
		else
		{
			$ARR_ADMIN_CONTROLLER_NAMES = Configure::read('ARR_ADMIN_CONTROLLER_NAMES');
			$key_val = array_search($section_chk, $ARR_ADMIN_CONTROLLER_NAMES);
			if(!empty($key_val) && in_array($key_val, $arr_permission))
			{
				return true;
			}
		}
		
		return false;
	}

	/**
	 * Purpose : TO CREATE FACEBOOK META INFO
	 * Created on : 3-Jun-2013
	 * Author : Nitin
	 */
	function create_fb_meta_like_info($arr = array())
	{
		$out = '';

		if(!empty($arr['title']))
		{
			$out .= '<meta property="og:title" content="'.htmlentities($arr['title']).'"/>'."\n";
		}
		else
		{
			$out .= '<meta property="og:title" content="'.DEFAULT_META_TITLE.'"/>'."\n";
		}

		$out .= '<meta property="og:type" content="other"/>'."\n";

		if(!empty($arr['url']))
		{
			$out .= '<meta property="og:url" content="'.$arr['url'].'"/>'."\n";
		}
		else
		{
			$out .= '<meta property="og:url" content="'.SITE_URL.'"/>'."\n";
		}
		
		$image_flag = false;
		
		if(!empty($arr['image']))
		{
			if(is_array($arr['image']))
			{
				$imgs = $arr['image'];
				foreach($imgs as $img_name)
				{
					$image_flag = true;
					$out .= '<meta property="og:image" content="'.$img_name.'"/>'."\n";
				}
			}
			elseif($arr['image'])
			{
				$image_flag = true;
				$out .= '<meta property="og:image" content="'.$arr['image'].'"/>'."\n";
			}
		}
		
		if(!$image_flag)
		{
			$out .= '<meta property="og:image" content="'.IMAGES_PATH.'logo.png"/>'."\n";
		}
		
		$out .= '<meta property="og:site_name" content="'.SITENAME.'"/>'."\n";
		
		$out .= '<meta property="og:description" content="'.((!empty($arr['description']))?htmlentities($arr['description']):'').'"/>'."\n";
		//$out .= '<meta property="fb:admins" content="100002276024621" />'."\n";
		$out .= '<meta property="fb:app_id" content="'.FB_APP_ID.'"/>'."\n";
		//$out .= '<meta property="fb:admins" content="101838533230972"/>'."\n";

		return $out;
	}

	/**
	 * Purpose : TO GET THE IMAGE FUNDRAISER FOR FACEBOOK SHARE
	 * Created on : 3-Jun-2013
	 * Author : Nitin
	 */
	function get_fundraiser_img_for_fb($row_pro)
	{
		$shw_img_url = '';
		$img_url = '';
		$vid_img_url = '';
		
		if(!empty($row_pro))
		{
			if(!empty($row_pro['FundraiserImg']))
			{
				if(is_array($row_pro['FundraiserImg']))
				{
					$img_url = SITE_URL.UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS.$row_pro['FundraiserImg'][0]['filename'];
				}
				elseif(!empty($row_pro['FundraiserImg']['filename']))
				{
					$img_url = SITE_URL.UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS.$row_pro['FundraiserImg']['filename'];
				}
			}
			
			if(!empty($row_pro['FundraiserVideo']))
			{
				if(is_array($row_pro['FundraiserVideo']))
				{
					$vid_img_url = SITE_URL.UPLOAD_DIR.FUNDRAISER_DIR.$row_pro['Fundraiser']['id'].DS.$row_pro['FundraiserVideo'][0]['img'];
				}
				elseif(!empty($row_pro['FundraiserVideo']['img']))
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
		}
		
		return $shw_img_url;
	}

	/**
	 * Purpose : TO GET THE IMAGE PRODUCT FOR FACEBOOK SHARE
	 * Created on : 3-Jun-2013
	 * Author : Nitin
	 */
	function get_product_img_for_fb($row_pro)
	{
		$shw_img_url = '';
		$img_url = '';
		$vid_img_url = '';
	
		if(!empty($row_pro))
		{
			if(!empty($row_pro['ProductImg']))
			{
				if(is_array($row_pro['ProductImg']))
				{
					$img_url = SITE_URL.UPLOAD_DIR.PRODUCTS_DIR.$row_pro['Product']['id'].DS.$row_pro['ProductImg'][0]['filename'];
				}
				elseif(!empty($row_pro['ProductImg']['filename']))
				{
					$img_url = SITE_URL.UPLOAD_DIR.PRODUCTS_DIR.$row_pro['Product']['id'].DS.$row_pro['ProductImg']['filename'];
				}
				$shw_img_url = $img_url;
			}
			
			if(empty($shw_img_url) && !empty($row_pro['ProductVideo']))
			{
				if(is_array($row_pro['ProductVideo']))
				{
					$vid_img_url = SITE_URL.UPLOAD_DIR.PRODUCTS_DIR.$row_pro['Product']['id'].DS.$row_pro['ProductVideo'][0]['img'];
				}
				elseif(!empty($row_pro['ProductVideo']['img']))
				{
					$vid_img_url = SITE_URL.UPLOAD_DIR.PRODUCTS_DIR.$row_pro['Product']['id'].DS.$row_pro['ProductVideo']['img'];
				}
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
		}
		
		return $shw_img_url;
	}

	/*
	 *  Method : get_facebook_profile_image()
	 *  Created Date : 23-01-2013
	 *  Description : is used to fetch the profile image from facebook account. 
	 */
	function get_facebook_profile_image($profile_id, $size = 'width=1400&height=1400')
	{
		//getting the picture of the user...

		$img_json = file_get_contents("https://graph.facebook.com/".$profile_id."/picture?".$size."&redirect=false");
		//will return JSON-encoded data describing the location of the picture. url is the location of the image and the is_silhouette boolean indicates whether or not the object has set a picture.

		$img_det_arr = (array)json_decode($img_json);

		$pic_obj = $img_det_arr['data'];
		
		$user_picture = '';
		
		if(!$pic_obj->is_silhouette)
		{
			$user_picture = $pic_obj->url;
		}

		return $user_picture;
	}

	/**
	 * Purpose : to append http::// in the url
	 * Created on : 17-Dec-2011
	 * Author : Nitin
	*/
	function make_http_image_src($url)
	{
		if(strpos($url, '://') == false)
		{
			if(strpos($url, '//') == 0)
			{
				return 'http:'.$url;
			}
			return 'http://'.$url;
		}
		return $url;
	}

	/**
	 * get Product Filter types
	 * @return : array list
	 * @author : Bhanu Prakash Pandey
	 */
	function getFilterTypes( $type = null)
	{
		$filterArr = array(
				'style' 	=> 'Style',
				'interior'	=> 'Interiors',
				'exterior' 	=> 'Exteriors',
				'color'		=> 'Color',
				'media_type' => 'Media Type'
		);
		if ( !empty($type) ){
			return $filterArr[$type];
		}
		return $filterArr;
	}

	/**
	 * Purpose : TO GET LATITUDE AND LONGITUDE
	 * Created on : 17-Feb-2014
	 * Author : Nitin
	*/
	function get_lat_lng($address, $region = '')
	{
		$url = 'http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false'.(!empty($region)?'&region='.$region:'');
		
		$response = file_get_contents($url);
		$response = json_decode($response, true);

		//pr($response);
		if(!empty($response['results']))
		{
			$lat = $response['results'][0]['geometry']['location']['lat'];
			$lng = $response['results'][0]['geometry']['location']['lng'];
			
			return array('lat' => $lat, 'lng' => $lng);
		}
		
		return false;
	}

	/**
	 * Purpose : TO GET LATITUDE AND LONGITUDE
	 * Created on : 17-Feb-2014
	 * Author : Nitin
	*/
	function get_userprofile_path($user_slug)
	{
		return strrchr(SITE_URL, "movitra").$user_slug;
	}
	
/**
 * Purpose : wrappinga text to certain length 
 * Input :	text, length
 * Created on : 17 June 2014
 * Author : Vivek Sharma
*/
function wraptext($text, $len="") {
    $text = nl2br(stripslashes($text));

    $text = strip_tags($text);
    $words = explode("<br />", $text, 2);

    $text = $words[0];
    if ($len == "") {
        $count_chars = 100;
    } else {
        $count_chars = $len;
    }

    if (strlen($text) > $count_chars) {
        $str_new = substr($text, 0, $count_chars);
     	$str_new = $str_new.'...';   
        return $str_new;
    } else {
        return $text;
    }
}
	
/**
 * Purpose : get distance between 2 locations in km
 * Created on : 3 July 2014
 * Author : Vivek Sharma
*/
    function getDistance($lat1, $lng1, $lat2, $lng2, $km = true)
    {
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lng1 *= $pi80;
    $lat2 *= $pi80;
    $lng2 *= $pi80;
     
    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlng = $lng2 - $lng1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;
     return $km;
    //return ($miles ? ($km * 0.621371192) : $km);
    }	

    
    function getDifference($date1, $date2){

	    // Format for date variables is "YYYY-MM-DD"
	    $objDate1 = new DateTime($date1);
	    $objDate2 = new DateTime($date2);
	    $interval = $objDate1->diff($objDate2);
	
	    return $interval->days; //This would return the difference in number of days
	}
	
function sortIt( $a, $b ){
	
	if ( $a['score_sub_type'] == 'Least')
	{
		return $a['score'] - $b['score'];
		
	}else{
		return $b['score'] - $a['score'];
	}
    
}


	