<?php
class CaptchaHelper extends AppHelper {
	var $helpers = array('Form');
	
	function captcha($fieldName = 'captcha', $options = array() ){
		App::import('Vendor', 'Captcha.recaptchalib');
		if(is_array($fieldName)){
			$options = $fieldName;
			$fieldName = 'captcha';
		}
		if(!empty($options) && ! is_array($options) && strlen($options) >= 40){
			$options = array('key'=>$options);
		}
		if(empty($options['key']) && strlen($fieldName) >= 40){
			$options['key'] = $fieldName;
			$fieldName = 'captcha';
		}
		App::import('Lib', 'Captcha.CaptchaConfig');
		$defOpt = array(
			'theme'=>CaptchaConfig::load('theme'),
			'lang'=>substr(Configure::read('Config.language'),0,2),
			'key'=>CaptchaConfig::load('publicKey'),
		);
		$opt = array_merge($defOpt,$options);
		$moreJsOpt = '';
		$html = '';
		if($opt['theme'] == 'custom'){
			$moreJsOpt .= 'custom_theme_widget: "recaptcha_widget",';
			$view =& ClassRegistry::getObject('view');
			$html .= $view->element('custom_theme',array('plugin'=>'captcha'));
		}
		$html .= '
			<script type="text/javascript">
				 var RecaptchaOptions = {
					theme : "'.$opt['theme'].'",
					'.$moreJsOpt.'
					lang : "'.$opt['lang'].'"
				 };
			</script>';
		$html .= $this->Form->hidden($fieldName,array('value'=>1));
		$error = null;
		$error = $this->Form->error($fieldName,null,array('wrap' => false,'escape' => false));
		$html .= recaptcha_get_html($opt['key'],$error);
		return $html;
	}
}
?>