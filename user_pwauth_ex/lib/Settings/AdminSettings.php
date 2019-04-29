<?php

/**
 * ownCloud - user_pwauth
 *
 * @author C. Véret
 * @copyright 2012 C. Véret veretcle+owncloud@mateu.be
 *
 */

namespace OCA\UserPwauthEx\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\Settings\ISettings;

class AdminSettings implements ISettings {
	private $config;
	
	public function __construct(IConfig $config) {
		$this->config = $config;
	}
	
	public function getForm() {
		$parameters = [
			'pwauth_path' => $this->config->getAppValue('user_pwauth_ex', 'pwauth_path'),
			'uid_list' => $this->config->getAppValue('user_pwauth_ex', 'uid_list')
		];
		return new TemplateResponse('user_pwauth_ex', 'admin', $parameters);
	}
	
	public function getSection() {
		return 'additional';
	}
	
	public function getPriority() {
		return 50;
	}
}

?>
