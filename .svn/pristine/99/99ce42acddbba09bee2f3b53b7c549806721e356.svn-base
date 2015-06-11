<?php
/**
*  Project : IMG180
*  Author : Mukesh Soni
*  Creation Date : Dec 20, 2013
*  Description : An image helper to help populating image
* Task : Resize,Crop,
*  File Dependancy : root .htaccess, resize.php
* 
*/

// .htaccess settings
//# Added By Mukesh Soni For Image Resizer
//	RewriteCond %{REQUEST_FILENAME} !-f
//	RewriteCond %{REQUEST_FILENAME} !-d
//	RewriteCond %{THE_REQUEST} ^.*/(resize)/.*
//	RewriteRule (.*)resize/([\w-]+)/([\w-]+)/([\w-]+)/(.*) app/webroot/resize.php?w=$2&h=$3&a=$4&src=$5 [L]
//# End

App::uses('Helper', 'View');
class ImgHelper extends AppHelper 
{
	public $name = 'ImgHelper';
	public $default_img;
	public $default_img_path;
	public $resizer_path;
	public $resizer_name;
	
	public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
        $this->default_img 		= 'no-image.jpg';
        $this->default_img_path = 'images/';
        /**
         * used when update path set to ture
         **/
        $this->updateURLPrefix 	= SITE_URL.'resize/';
        /**
         * Used when udate path set to false
         */
        $this->resizer_path  	= SITE_URL.'app/webroot/'; 
        $this->resizer_name		= 'resize.php';
    }
	
	/**
	 * Description : getImage will return image path after resize, crop.
	 * @param string $path, path to image, path must be absolute and should be direct path after webroot
	 * @param integer $width, new width of image
	 * @param integer $height, new height of image 
	 * @param string $crop accept [c,t], crop position c = from center, t = from top
	 * @param boolean $updateURL, will replace URL to resize/Width/Height/Image_Name.jpg to maintain browser cache and security level.
	 */
	
	public function getImage($path, $width = 100, $height = 100, $crop = false, $updateURL = false)
	{
		$file_base = '';
		$file_name = '';
		$final_url = '';
		if(empty($path))
		{
			return false;
		}
		/*
		 * Check file exist or not. if not then no image would be display.using $default_img_path and $default_img settings
		 **/
		$original_file_name = pathinfo($path, PATHINFO_BASENAME);	//file name
		$file_base = pathinfo($path, PATHINFO_DIRNAME) . '/';	//rest path excluded WWW_ROOT
		$file_base = str_replace('\\','/',$file_base);
		
		$check_file_name = $this->create_thumb_imgname($original_file_name,$width,$height);
		if(is_file(WWW_ROOT.$file_base.$check_file_name))
		{
			return SITE_URL.$file_base.$check_file_name;
		}
		else if(is_file(WWW_ROOT.$path))
		{
			$file_base = $file_base;
			$file_name = $original_file_name;
		}
		else
		{
			$file_base = $this->default_img_path;
			$file_name = $this->default_img;
		}
		
		/*
		 * Check whether or not there is any need of url rewrite if yes then other configuration must be setup to get correct path.
		 * */
		if($updateURL)
		{
			if($crop)
			{
				$url = $this->updateURLPrefix.$width.'/'.$height.'/'.$crop.'/'.$file_base.$file_name;
			}
			else
			{
				$url = $this->updateURLPrefix.$width.'/'.$height.'/0/'.$file_base.$file_name;
			}
		}
		else
		{
			$abs_file_path = SITE_URL.'app/webroot/'.$file_base.$file_name;
			if($crop)
			{
				$url = $this->resizer_path.$this->resizer_name.'?w='.$width.'&h='.$height.'&a='.$crop.'&src='.$abs_file_path;
			}
			else
			{
				$url = $this->resizer_path.$this->resizer_name.'?w='.$width.'&h='.$height.'&src='.$abs_file_path;
			}
		}
		return $url;
	}
	
	function create_thumb_imgname($img_name, $width, $height)
	{
		$dotpos = strrpos($img_name, '.');
		$firstpart = substr($img_name, 0, $dotpos);
		$ext = substr($img_name, ($dotpos+1));
		
		return $firstpart.'_'.$width.'x'.$height.'.'.$ext;
	}
}
?>
