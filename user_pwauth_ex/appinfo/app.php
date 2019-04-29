<?php

use OCP\AppFramework\App;

$app = new App('user_pwauth_ex');

OC_User::useBackend(new \OCA\UserPwauthEx\UserPwauth());
?>
