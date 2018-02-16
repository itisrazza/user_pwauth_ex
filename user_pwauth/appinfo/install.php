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

// if there is no path, just create it in config/config.php
if ($config->getSystemValue('pwauth_path') === '') {
	$config->setSystemValue('pwauth_path', '/usr/sbin/pwauth');
	$config->setSystemValue('uid_list', '1000-1010');
}
?>
