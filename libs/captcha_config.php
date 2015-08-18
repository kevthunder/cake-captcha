<?php
class CaptchaConfig extends Object {
	/*
		App::import('Lib', 'Captcha.CaptchaConfig');
		CaptchaConfig::load();
	*/
	
	var $loaded = false;
	var $defaultConfig = array(
		'theme' => 'white',
		'publicKey' => '6LegA9cSAAAAAJapzIBpl20IBA8SaQdEXzuy4tlL', //global for o2websolutions.com
		'PrivateKey' => '6LegA9cSAAAAAKVf3sllGUayiDL7owi6eEJkZ1Ac', //global for o2websolutions.com
	);
	var $trueToDefault = array(
	);
	
	//$_this =& CaptchaConfig::getInstance();
	function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] =& new CaptchaConfig();
		}
		return $instance[0];
	}
	
	function _parseTrueToDefault($config){
		$_this =& CaptchaConfig::getInstance();
		$trueToDefault = Set::normalize($_this->trueToDefault);
		foreach($trueToDefault as $path => $options){
			if(Set::extract($path,$config) === true){
				if(empty($options)){
					$options = Set::extract($path,$_this->defaultConfig);
				}
				$config = Set::insert($config,$path,$options);
			}
		}
		return $config;
	}
	
	function load($path = true){
		$_this =& CaptchaConfig::getInstance();
		if(!$_this->loaded){
			config('plugins/captcha');
			$config = Configure::read('Captcha');
			$config = Set::merge($_this->defaultConfig,$config);
			$config = $_this->_parseTrueToDefault($config);
			Configure::write('Captcha',$config);
			$_this->loaded = true;
		}
		if(!empty($path)){
			return Configure::read('Captcha'.($path!==true?'.'.$path:''));
		}
	}
	
}
?>