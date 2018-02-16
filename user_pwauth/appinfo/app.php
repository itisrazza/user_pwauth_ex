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

use OCP\AppFramework\App;

$app = new App('user_pwauth');
$container = $app->getContainer();

$container->query('OCP\INavigationManager')->add(function () use ($container) {
	$l10n = $container->query('OCP\IL10N');
	return [
		// the string under which your app will be referenced in Nextcloud
		'id' => 'user_pwauth',

		// sorting weight for the navigation. The higher the number, the higher
		// will it be listed in the navigation
		'order' => 10,

		// the title of your application. This will be used in the
		// navigation or on the settings page of your app
		'name' => $l10n->t('Unix User Backend'),
	];
});

OC_User::useBackend(new \OCA\UserPwauth\UserPwauth());
?>
