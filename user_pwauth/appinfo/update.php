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

$config = \OC::$server->getConfig();
if ($config->getSystemValue('pwauth_path') === '') {
	// if system value does not exist, checks if appvalue exists
	if($config->getAppValue('user_pwauth', 'pwauth_path') === '') {
		$config->setSystemValue('pwauth_path', '/usr/sbin/pwauth');
		$config->setSystemValue('uid_list', '1000-1010');
	} else {
		// pwauth_path exists, copy it to system value
		$config->setSystemValue('pwauth_path', $config->getAppValue('user_pwauth', 'pwauth_path'));
		$config->setSystemValue('uid_list', $config->getAppValue('user_pwauth', 'uid_list'));
		// and delete the old configuration
		$config->deleteAppValue('user_pwauth', 'pwauth_path');
		$config->deleteAppValue('user_pwauth', 'uid_list');
	}
}
?>
