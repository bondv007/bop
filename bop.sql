-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 09:37 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bop`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutuses`
--

CREATE TABLE IF NOT EXISTS `aboutuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `desc` text,
  `url` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `aboutuses`
--

INSERT INTO `aboutuses` (`id`, `title`, `desc`, `url`, `filename`, `type`, `created`, `modified`) VALUES
(1, 'sd', 'adsf', NULL, 'dcb9e47d993602c3980a0a8e7052e6d1.jpg', 'team', '2014-05-01 10:39:36', '2014-05-01 10:39:36'),
(2, 'adsf', 'asdfsdf', NULL, '69ceba92f3a8f5ee3fe45014f6a28ddb.jpg', 'team', '2014-05-01 10:53:09', '2014-05-01 10:53:09'),
(3, 'ds', 'asdsadf', NULL, '29e6577d18719cac269597a83983323e.jpg', 'team', '2014-05-01 10:55:40', '2014-05-01 10:55:40'),
(4, 'Crossfit1', NULL, 'http://www.google.com', 'ebcd49abd835841c30487a901d506d91.jpg', 'sponsor', '2014-05-01 11:15:23', '2014-05-01 11:15:23'),
(5, 'San Francisco CrossFit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor convallis odio, in ultrices quam ultrices vitae. Ut pulvinar diam a dapibus vulp', NULL, 'c4d43a391200e312e06d26151cc62bc0.jpg', 'block', '2014-05-01 11:45:59', '2014-05-01 11:45:59'),
(6, 'San Francisco CrossFit', '<p>\r\n	Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>\r\n<p>\r\n	A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>\r\n<p>\r\n	Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas.</p>\r\n', NULL, 'f858a683ee72cb3ea01acb8e5b12e336.jpg', 'block_big', '2014-05-01 12:37:49', '2014-05-01 12:37:49'),
(7, 'San Francisco CrossFit', '<p>\r\n	Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>\r\n<p>\r\n	A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>\r\n<p>\r\n	Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas.</p>\r\n', NULL, 'b29c2ef5a181d0b75ff51428ba012c04.jpg', 'block_big', '2014-05-01 12:43:06', '2014-05-01 12:43:06'),
(8, '', '<iframe width="960" height="540" src="//www.youtube.com/embed/yeF_b8EQcK0" frameborder="0" allowfullscreen></iframe>', NULL, NULL, 'top_video', '0000-00-00 00:00:00', '2014-05-02 09:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE IF NOT EXISTS `emailtemplates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_for` varchar(100) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  `reply_to` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `email_for`, `from_name`, `from_email`, `reply_to`, `subject`, `content`, `created`, `modified`) VALUES
(1, 'Registration', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Crossfit email verification', '<p>\n	Hi {USERNAME},</p>\n<p>\n	You&#39;re almost there, click on the link below to<br />\n	verify your account and get started.</p>\n<p>\n	{ACTIVATE_LINK}</p>\n<p>\n	Crossfit&nbsp;</p>\n', '0000-00-00 00:00:00', '2013-08-20 08:02:01'),
(2, 'Forgot_password', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Password Reset', '<p>\r\n	Dear {USERNAME},<br />\r\n	<br />\r\n	You requested for password reset for your account on {DOMAIN}. Please click the link below to reset your password.<br />\r\n	<br />\r\n	{PWD_RESET_LINK}</p>\r\n<p>\r\n	Regrards,</p>\r\n<p>\r\n	Team Crossfit</p>\r\n', '2013-08-20 07:06:25', '2013-08-20 13:12:28'),
(3, 'Account_confirmation', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Account confirmation', '<p>\n	Hi {USERNAME},</p>\n<p>\n	Congratulations on Crossfit!</p>\n<p>\n	Crossfit&nbsp;</p>\n', '2013-08-20 08:38:41', '2013-08-20 08:38:41'),
(4, 'Social_registration', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Account Information', '<p>\r\n	Hi {USERNAME},</p>\r\n<p>\r\n	Please check your crossfit account detail below:</p>\r\n<p>\r\n	Username : &nbsp;{EMAIL}</p>\r\n<p>\r\n	Password : {PASSWORD}</p>\r\n<p>\r\n	Crossfit&nbsp;</p>\r\n', '2013-08-20 08:58:02', '2013-08-20 13:24:20'),
(12, 'contact_us', 'Crossfit.com', 'xicom.test@gmail.com', '', 'Request to contact us', '<p>\n	Hi Admin,<br />\n	<br />\n	Following are the details:<br />\n	Name: {{name}}<br />\n	Email id: {{email_id}}<br />\n	Subject: {{subject}}<br />\n	Message: {{message}}<br />\n	<br />\n	Regards,<br />\n	{{sitename}}\n</p>\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'sponsorship_inquiry', 'Crossfit.com', 'xicom.test@gmail.com', '', 'Request for sponsorship inquiry', '<p>\r\n	Hi Admin,<br />\r\n	<br />\r\n	Following are the details:<br />\r\n	Name: {{name}}<br />\r\n	Email id: {{email_id}}<br />\r\n	Sponsorship for: {{sponsorship_type}}<br />\r\n	Date of the event: {{event_date}}<br />\r\n	Message: {{message}}<br />\r\n	<br />\r\n	Regards,<br />\r\n	{{sitename}}\r\n</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Event_registration', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Registration for Event Successful', '<p>\n	Hi {USERNAME},</p>\n<p>\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your registration for {EVENT} is successful. Your login details are as follows:</p>\n<p>\n	Username: {EMAIL}</p>\n<p>\n	Password: {PASSWORD}</p>\n<p>\n	&nbsp;</p>\n<p>\n       Please proceed to the payment for participating in event. Ignore if already paid.\n</p>\n<p>\n	Thanks &amp; Regards</p>\n<p>\n	Crossfit Team</p>\n<p>\n	&nbsp;</p>\n', '2014-05-28 00:00:00', '2014-05-28 00:00:00'),
(15, 'Invite_gameon_coach', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Invitation to connect as coach', '<p>\n	Hi {USERNAME}</p>\n\n<p>\n	You have been invited to connect as coach by {AFFILIATE} on crossfit.</p>\n\n<p>Details as provided by {AFFILIATE} :</p>\n<p>Name: <span>{USERNAME}</span> <span>{IMAGE}</span></p>\n<p></p>\n{PROFILE_LINK}\n\n<p>\n	{ACCEPT_LINK} {DECLINE_LINK} </p>\n<p>\n	&nbsp;</p>\n<p>\n	Thanks</p>\n<p>\n	Crossfit Team</p>\n', '2014-06-04 17:46:01', '2014-06-04 17:46:01'),
(16, 'response_coach_invitation', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Coach invitation response', '<p>\r\n	Hi {USERNAME}</p>\r\n<p>\r\n	{COACH} has {RESPONSE} your invitation to connect as coach.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Thanks</p>\r\n<p>\r\n	Crossfit Team</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2014-06-04 18:23:51', '2014-06-04 18:23:51'),
(17, 'Invite_gameon_athlete', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Invitation to connect as athlete', '<p>\n	Hi {USERNAME}</p>\n\n<p>\n	You have been invited to connect as athlete by {AFFILIATE} on crossfit.</p>\n\n<p>Details as provided by {AFFILIATE} :</p>\n<p>Name: <span>{USERNAME}</span> <span>{IMAGE}</span></p>\n<p></p>\n{PROFILE_LINK}\n\n<p>\n	{ACCEPT_LINK} {DECLINE_LINK} </p>\n<p>\n	&nbsp;</p>\n<p>\n	Thanks</p>\n<p>\n	Crossfit Team</p>', '2014-06-09 00:00:00', '2014-06-09 00:00:00'),
(18, 'response_athlete_invitation', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Athlete invitation response', '<p>\r\n	Hi {USERNAME}</p>\r\n<p>\r\n	{ATHLETE} has {RESPONSE} your invitation to connect as athlete.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Thanks</p>\r\n<p>\r\n	Crossfit Team</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2014-06-09 00:00:00', '2014-06-09 00:00:00'),
(19, 'Registration_details', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Crossfit account created', '<p>\n	Hi {USERNAME},</p>\n<p>\n	You&#39;re crossfit account has been created<br />\n	Following are your login credentials:\n<p>\n	Email: {EMAIL}</p><br>\n<p> Password: {PASSWORD}</p>\n<p>\n	Crossfit&nbsp;</p>\n', '2014-06-09 00:00:00', '2014-06-09 00:00:00'),
(20, 'Message', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'New Message received', '<p>\n	Hi {USERNAME},</p>\n<p>\n	A new message is received from {FROM}. Following are details:</p>\n<p>\n	Subject: {SUBJECT}</p>\n<p>\n	Message: {CONTENT}</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thanks</p>\n<p>\n	Crossfit</p>\n<p>\n	&nbsp;</p>\n', '2014-07-01 17:35:28', '2014-07-01 17:35:28'),
(21, 'Event_message', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'A new event message posted', '<p>\n	Hi {USERNAME},</p>\n<p>\n	A new message is posted for {EVENT}</p>\n<p>Message: <br/>{MESSAGE}\n	</p>\n\nThanks\nCrossfit\n', '2014-07-04 00:00:00', '2014-07-04 00:00:00'),
(22, 'challenge_request', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'You have got a challenge request', '<p>\n	Hi {USERNAME},</p>\n<p>\n	You''ve received a challenge from {CHALLENGER}. Following are details:</p>\n<p>\n	WOD: {WOD}</p>\n<p>\n	Date: {DATE}</p>\n<p>\n	Time: {TIME}</p>\n<p>\n	Login to accept or decline challenge.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thanks</p>\n<p>\n	Crossfit</p>\n<p>\n	&nbsp;</p>', '2014-07-16 00:00:00', '2014-07-16 00:00:00'),
(23, 'challenge_accepted', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Your challenge was accepted by athlete', '<p>\n	Hi {CHALLENGER},</p>\n<p>\n	{USERNAME} has accepted your challenge. Following are challenge details:</p>\n<p>\n	WOD: {WOD}</p>\n<p>\n	Date: {DATE}</p>\n<p>\n	Time: {TIME}</p>\n<p>    \n      {VIDEO_LINK}</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thanks</p>\n<p>\n	Crossfit</p>\n<p>\n	&nbsp;</p>', '2014-07-16 00:00:00', '2014-07-16 00:00:00'),
(24, 'challenge_declined', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Your challenge was declined by athlete', '<p>\r\n	Hi {CHALLENGER},</p>\r\n<p>\r\n	{USERNAME} has declined your challenge. Following are challenge details:</p>\r\n<p>\r\n	WOD: {WOD}</p>\r\n<p>\r\n	Date: {DATE}</p>\r\n<p>\r\n	Time: {TIME}</p>\r\n\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Thanks</p>\r\n<p>\r\n	Crossfit</p>\r\n<p>\r\n	&nbsp;</p>', '2014-07-16 00:00:00', '2014-07-16 00:00:00'),
(25, 'challenge_result_mail', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Challenge result', '<p>\r\n	Hi {USERNAME},</p>\r\n<p>\r\n	The Challenge event hosted on {DATE} {TIME} in which you have participated has come to an end.</p>\r\n<p>Your position: {POSITION}</p>\r\n\r\n<p>\r\n	Login to view further details.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Thanks</p>\r\n<p>\r\n	Crossfit</p>\r\n<p>\r\n	&nbsp;</p>', '2014-08-04 00:00:00', '2014-08-04 00:00:00'),
(26, 'Event_payment_received', 'Admin', 'admin@crossfit.com', 'admin@crossfit.com', 'Payment received for event ', '<p>\r\n	Hi {USERNAME},</p>\r\n<p>\r\n	Congratulations! you have successfully registered for {EVENT}. </p>\r\n<p>Following are details: </p>\r\n<p>Name: {USERNAME}</p>\r\n<p>Amount: {AMOUNT}</p>\r\n<p>Date: {DATE}</p>\r\n<p>Event: {EVENT}</p>\r\n<p>Event Date: {EVENT_DATE}</p>\r\n<p>Event Location: {LOCATION}</p>\r\n<br>\r\n<p>Crossfit&nbsp;</p>', '2014-08-25 00:00:00', '2014-08-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(512) NOT NULL,
  `answer` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created`, `modified`) VALUES
(1, 'Vestibulum est lacus, dignissim ut dignissim', '<p>\r\n	<strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet neque nulla.</strong> Cras ut magna elit. Sed posuere, eros eget elementum venenatis, arcu leo tincidunt justo, ut blandit arcu nunc eu urna. Aliquam at faucibus urna. In hac habitasse platea dictumst. Mauris quam tellus, egestas ut laoreet nec, tristique non libero. Pellentesque habitant morbi tristique senectus <span style="background-color:#ffff00;">et netus et malesuada fames</span> ac turpis egestas. Donec turpis orci, rhoncus ut pulvinar id, elementum eu tortor. In et enim elit, quis porttitor metus. Pellentesque ut venenatis tellus.</p>\r\n', '2013-08-06 10:32:18', '2013-08-06 10:32:18'),
(2, 'Proin vehicula mauris rutrum euismod faucibus ur fermentum mieget imperdiet elit nisi eget arcu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet neque nulla. Cras ut magna elit. Sed posuere, eros eget elementum venenatis, arcu leo tincidunt justo, ut blandit arcu nunc eu urna. Aliquam at faucibus urna. In hac habitasse platea dictumst. Mauris quam tellus, egestas ut laoreet nec, tristique non libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec turpis orci, rhoncus ut pulvinar id, elementum eu tortor. In et enim elit, quis porttitor metus. Pellentesque ut venenatis tellus.', '2013-08-06 10:32:18', '2013-08-06 10:32:18'),
(3, 'Vestibulum rutrum diam et sollicitudin consequat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet neque nulla. Cras ut magna elit. Sed posuere, eros eget elementum venenatis, arcu leo tincidunt justo, ut blandit arcu nunc eu urna. Aliquam at faucibus urna. In hac habitasse platea dictumst. Mauris quam tellus, egestas ut laoreet nec, tristique non libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec turpis orci, rhoncus ut pulvinar id, elementum eu tortor. In et enim elit, quis porttitor metus. Pellentesque ut venenatis tellus.', '2013-08-06 10:32:18', '2013-08-06 10:32:18'),
(4, 'Donec quis erat dolor, ut ullamcorper purus maecenas feugiat mi ut elit vestibulum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet neque nulla. Cras ut magna elit. Sed posuere, eros eget elementum venenatis, arcu leo tincidunt justo, ut blandit arcu nunc eu urna. Aliquam at faucibus urna. In hac habitasse platea dictumst. Mauris quam tellus, egestas ut laoreet nec, tristique non libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec turpis orci, rhoncus ut pulvinar id, elementum eu tortor. In et enim elit, quis porttitor metus. Pellentesque ut venenatis tellus.', '2013-08-06 10:32:18', '2013-08-06 10:32:18'),
(5, 'Integer urna nunc, elementum vel faucibus quis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet neque nulla. Cras ut magna elit. Sed posuere, eros eget elementum venenatis, arcu leo tincidunt justo, ut blandit arcu nunc eu urna. Aliquam at faucibus urna. In hac habitasse platea dictumst. Mauris quam tellus, egestas ut laoreet nec, tristique non libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec turpis orci, rhoncus ut pulvinar id, elementum eu tortor. In et enim elit, quis porttitor metus. Pellentesque ut venenatis tellus.', '2013-08-06 10:32:18', '2013-08-06 10:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `slug`, `created`, `modified`) VALUES
(2, 'Terms & Conditions', '<p>\r\n	This is the dummy content for the static pages.</p>\r\n', 'terms-conditions', '2013-08-20 05:59:56', '2013-08-20 11:07:04'),
(7, 'Privacy', '<p>\r\n	Test Content</p>\r\n', 'privacy', '2013-08-21 04:38:51', '2013-08-21 04:38:51'),
(9, 'Rules and Policies', '<p>\r\n	Test content</p>\r\n', 'rules_policy', '2013-08-21 06:06:37', '2013-08-21 06:06:37'),
(10, 'Store', '<p>\r\n	Test content</p>\r\n', 'store', '2013-08-21 06:06:59', '2013-08-21 06:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment field',
  `first_name` varchar(100) NOT NULL COMMENT 'This field is used to save the first name of user',
  `last_name` varchar(100) NOT NULL COMMENT 'This field is used to save the last name of user',
  `other_name` varchar(255) DEFAULT NULL COMMENT 'field used for affiliate name',
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL COMMENT 'This field is used to save the email address of user',
  `password` varchar(100) NOT NULL COMMENT 'This field is used to save the password of user',
  `role` enum('user','admin') NOT NULL DEFAULT 'user' COMMENT 'This field is used to save the role type of user',
  `user_type` varchar(10) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL COMMENT 'User profile image',
  `profile_description` text,
  `facebook_id` bigint(20) NOT NULL,
  `fb_access_token` varchar(500) NOT NULL,
  `twitter_id` bigint(20) NOT NULL,
  `twitter_auth_token` varchar(100) NOT NULL,
  `twitter_auth_secret` varchar(100) NOT NULL,
  `stripe_user_id` varchar(255) DEFAULT NULL,
  `stripe_access_token` varchar(255) DEFAULT NULL,
  `stripe_refresh_token` varchar(500) DEFAULT NULL,
  `stripe_publishable_key` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : inactive, 1: active , 2: deleted',
  `verification_code` varchar(100) NOT NULL DEFAULT 'NULL',
  `created` datetime NOT NULL COMMENT 'This field is used to save the creation date of user registration',
  `modified` datetime NOT NULL COMMENT 'This field is used to save the modification date of user profile',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table is used to save the record of users' AUTO_INCREMENT=103 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `other_name`, `username`, `email`, `password`, `role`, `user_type`, `gender`, `date_of_birth`, `mobile_number`, `photo`, `profile_description`, `facebook_id`, `fb_access_token`, `twitter_id`, `twitter_auth_token`, `twitter_auth_secret`, `stripe_user_id`, `stripe_access_token`, `stripe_refresh_token`, `stripe_publishable_key`, `status`, `verification_code`, `created`, `modified`) VALUES
(38, 'Admin', 'admin', NULL, NULL, 'xicom', '0e5ed5f5eaafa84b45d43e2e54a4b1da74f3f8e0 ', 'admin', '', NULL, NULL, '4324324', 'images1.jpeg', NULL, 0, '', 0, '', '', NULL, NULL, NULL, NULL, 1, '', '2013-08-20 09:08:26', '2013-08-20 09:09:25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
