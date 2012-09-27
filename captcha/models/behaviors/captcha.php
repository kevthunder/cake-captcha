<?php
class CaptchaBehavior extends ModelBehavior {

	var settings = array();
	
    function setup(&$Model, $settings) {
		if (!is_array($settings)) {
			$settings = array('privatekey'=>$settings);
		}
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], (array)$settings);
    }


	function beforeValidate(&$model){
		//if(!empty($model->date[$model->alias]['captcha'])){
		$this->validateCaptcha($model);
		//}
	}

	function validateCaptcha(&$model){
		$resp = recaptcha_check_answer ($this->settings[$Model->alias]['privatekey'],
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