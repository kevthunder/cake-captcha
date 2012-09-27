<?php
class CaptchaHelper extends AppHelper {
	var $helpers = array('Form');
	
	function captcha($fieldName, $options = array() ){
		App::import('Vendor', 'Captcha.recaptchalib');
		if(!empty($options) && ! is_array($options) && strlen($options) >= 40){
			$options = array('key'=>$options);
		}
		if(empty($options['key']) && strlen($fieldName) >= 40){
			$options['key'] = $fieldName;
			$fieldName = 'captcha';
		}
		$defOpt = array(
			'theme'=>'clean',
			'lang'=>substr(Configure::read('Config.language'),0,2),
		);
		$opt = array_merge($defOpt,$options);
		$html = '
			<script type="text/javascript">
				 var RecaptchaOptions = {
					theme : "'.$opt['theme'].'",
					lang : "'.$opt['lang'].'"
				 };
			</script>';
		$html .= $this->Form->hidden($fieldName,array('value'=>1));
		$html .= recaptcha_get_html($opt['key']);
		return $html;
	}
}
?>