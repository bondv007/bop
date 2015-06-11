<?php
$config = array();
if($_SERVER['HTTP_HOST'] == 'demo.xicom.us')
{	
	define('SITE_URL', 'http://demo.xicom.us/crossfit/');
}
elseif($_SERVER['HTTP_HOST'] == '192.168.1.200' || $_SERVER['HTTP_HOST'] == 'localhost')
{
	define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/crossfit/website/');
}
else 
{
	define('SITE_URL', 'http://localhost/crossfit/website/');
}

define('APPLICATION_NAME','Crossfit');
define('CAKE_ADMIN', 'admin');
define('ADMIN_EMAIL','vivek.sharma@xicom.biz');

define('SITENAME', 'Crossfit.com');
define('SITEDISPLAYNAME', 'Crossfit');
define('EMAIL_LOGO_PATH', SITE_URL.'images/logo.png');

define('ADMIN_IMAGES_PATH', SITE_URL.'admin_images/');
define('FRONT_END_IMAGES_PATH', SITE_URL.'images/');
define('IMAGES_PATH', SITE_URL.'images/');
define('FRONT_END_USER_IMAGES_PATH', SITE_URL.'files/');
define('ADMIN_PAGE_LIMIT',30);
define('ADMIN_NUM_PER_PAGE', 30);

class UserRoleConst {
	Const RoleAdmin = 'admin';
	Const RoleUser = 'user';	
}

define('STATUS_INACTIVE', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_DELETED', 2);

define('BIG', 'big_');
define('SMALL', 'small_');
define('THUMB', 'thumb_');

define('USER_ATHLETE', 'athlete');
define('USER_AFFILIATE', 'affiliate');
define('USER_FAN', 'fan');

define('TWITTER_CALLBACK', SITE_URL . "users/twitter_callback");
define('LINKEDIN_CALLBACK', SITE_URL . "users/linkedin");

define('FB_ACCESS_TOKEN','CAAElwdZAPpjYBAMAlsmOm9z1KmkZBzcHxqCwxKzZCXheSkgqyU8iunvaLBXAVbZBo2ZAmKkDKIs2cFujzXSWxlGNYdZBlZAMGeqEwBcNWoP6mJMcSdXp40csJN7B2hhNAxrn4ay0n9YZCjbZBlZAxAqrCL6KUgZAWrZCEWrEkpGJTZCbHtIZB1BoDcOeNTpKzkhAf37ksZD');   // 60 day access token. Expires after 60 days from 26 August,2014
define('TW_TOKEN','1574874492-9kXKI5ueP7ZrkFGzt4Bk1Mqgownjbwq5ySXHzKC');
define('TW_TOKEN_SECRET','GTVXTrCxglcSI2QHlae4bfTOAUZvhDBcHFxmHFZsqbru3');
define('TW_APP_KEY','SR5FOCPvInnUFL6xJ4WIMprez');
define('TW_APP_SECRET','rEltmrIRUOho14BbZqLwcBJjVisyMZJlKHc9pBcxaka4Vjx2Gm');


//Stripe keys
define('STRIPE_TEST_SECRET','sk_test_UHDh8YyQgpcNGKolqa5ojFTG');
define('STRIPE_LIVE_SECRET','sk_live_xIITOtiZwdn4mxOqAeT0AGKg');
define('STRIPE_CLIENT_ID','ca_4cJJZhbMD80wA2bpFxgCm4OCvodClUNs');

class LoginAPI
{
	//const FACEBOOK_APP_ID = '322989431170614';
	//const FACEBOOK_APP_SECREAT = '8759c99b431a1ec9297de9a5fcd9c25d';
	
	const FACEBOOK_APP_ID = '745799135485885';
	const FACEBOOK_APP_SECREAT = 'cbabdf57ab459c034c20a95fdc46449c';
	
	const TWITTER_OAUTH_CALLBACK = TWITTER_CALLBACK;
	const TWITTER_CONSUMER_KEY = 'cY8KrmIVu6mduUs1w0yfg';
	const TWITTER_CONSUMER_SECRET = 'sbYc7j2Pg81Jd9pr1O07qThIgW17z9w0Cz5hQr1qrMI';
	const LINKEDIN_KEY = 'hpjltt1oqarn';
	const LINKEDIN_SECRET = 'QFJuuDjqt4aUWHrn';
	const LINKEDIN_OAUTH_CALLBACK = LINKEDIN_CALLBACK;
}


define('UPLOAD_DIR', 'files');
define('THUMBS_PATH', 'thumbs');
define('UPLOAD_TEMP_DIR', UPLOAD_DIR.DS.'temp'.DS);

define('UPLOAD_ABOUTUS_DIR', UPLOAD_DIR.DS.'aboutus'.DS);
define('UPLOAD_TUTORIAL_DIR', UPLOAD_DIR.DS.'tutorials'.DS);
define('DISPLAY_ABOUTUS_DIR', SITE_URL.UPLOAD_DIR.'/aboutus/');
define('DISPLAY_TUTORIAL_DIR', SITE_URL.UPLOAD_DIR.'/tutorials/');


$config['ARR_ABOUTUS_BLOCK_TYPE'] = array('block' => 'Block', 'block_big' => 'Big block');
$config['ARR_SPONSORSHIP_TYPE'] = array('1' => 'Events', 'Fundraiser', 'Social', 'partnership', 'Other');



/**
 * class : Thumbnail class
 * description : array for thumbnials for images that we are using in are site
 */
class Thumbnail
{
	// Thumb for user images
	static function user_profile_thumbs()
	{
		$thumb = array(
					array(
						'width'=>200,
						'height'=>200,
						'suffix' => BIG
					),
					array(
						'width'=>120,
						'height'=>120,
						'suffix' => SMALL
					),
					array(
						'width'=>80,
						'height'=>80,
						'suffix' => THUMB
					)
			);
		return $thumb;
	}

}
