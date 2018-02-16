<?php
/*
            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
                    Version 2, December 2004

 Copyright (C) 2004 Sam Hocevar <sam@hocevar.net>

 Everyone is permitted to copy and distribute verbatim or modified
 copies of this license document, and changing it is allowed as long
 as the name is changed.

            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

  0. You just DO WHAT THE FUCK YOU WANT TO.

*/

/**
 * ownCloud - user_pwauth
 *
 * @author Clément Véret
 * @copyright 2012 Clément Véret veretcle+owncloud@mateu.be
 *
 */

namespace OCA\UserPwauth\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;

class AdminSettings implements ISettings {
	$private appName;
	
	public function __construct() {
		$this->appName = 'UserPwauth';
	}
	
	public function getForm() {
		return new TemplateResponse($this->appName, 'admin');
	}
	
	public function getSection() {
		return 'additional';
	}
	
	public function getPriority() {
		return 50;
	}
}

?>
