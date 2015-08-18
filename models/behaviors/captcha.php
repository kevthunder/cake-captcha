<?php
class CaptchaBehavior extends ModelBehavior {

	var $settings = array();
	var $defSettings = array(
		'enable' => true,
	);
	
    function setup(&$Model, $settings) {
		if (!is_array($settings)) {
			$settings = array('privatekey'=>$settings);
		}
		if(empty($this->settings[$Model->alias])) $this->settings[$Model->alias] = array();
		$defSettings = $this->defSettings;
		App::import('Lib', 'Captcha.CaptchaConfig');
		$defSettings['privatekey'] = CaptchaConfig::load('PrivateKey');
		$this->settings[$Model->alias] = array_merge($defSettings, $this->settings[$Model->alias], (array)$settings);
    }

	function disableCaptcha($enable = false){
		$this->settings[$Model->alias]['enable'] = $enable;
	}
	
	function beforeValidate(&$model){
		//if(!empty($model->date[$model->alias]['captcha'])){
		if(!Configure::read('admin') && $this->settings[$model->alias]['enable']) {
			$this->validateCaptcha($model);
		}
		//}
	}

	function validateCaptcha(&$model){
		App::import('Vendor', 'Captcha.recaptchalib');
		$resp = recaptcha_check_answer ($this->settings[$model->alias]['privatekey'],
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
			$model->invalidate('captcha',$resp->error);
		}
		return $resp->is_valid;
	}
}
?>