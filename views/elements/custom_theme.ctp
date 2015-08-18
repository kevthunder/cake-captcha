<div id="recaptcha_widget" style="display:none">

	<div id="recaptcha_image"></div>
	<div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php __('Incorrect please try again'); ?></div>

	<span class="recaptcha_only_if_image"><?php __('Enter the words above:'); ?></span>
	<span class="recaptcha_only_if_audio"><?php __('Enter the numbers you hear:'); ?></span>

	<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />

	<div class="btn btRefresh"><a href="javascript:Recaptcha.reload()" title="<?php __('Get another CAPTCHA'); ?>"><?php __('Get another CAPTCHA'); ?></a></div>
	<div class="recaptcha_only_if_image btn btAudio"><a href="javascript:Recaptcha.switch_type('audio')" title="<?php __('Get an audio CAPTCHA'); ?>"><?php __('Get an audio CAPTCHA'); ?></a></div>
	<div class="recaptcha_only_if_audio btn btImg"><a href="javascript:Recaptcha.switch_type('image')" title="<?php __('Get an image CAPTCHA'); ?>"><?php __('Get an image CAPTCHA'); ?></a></div>

	<div class="btn btHelp"><a href="javascript:Recaptcha.showhelp()" title="<?php __('Help'); ?>"><?php __('Help'); ?></a></div>

</div>
