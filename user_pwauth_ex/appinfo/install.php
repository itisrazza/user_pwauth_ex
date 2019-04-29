<?php

$config = \OC::$server->getConfig();

// if there is no path, just create it in config/config.php
if ($config->getAppValue('user_pwauth_ex', 'pwauth_path') === '') {
  $config->setAppValue('user_pwauth_ex', 'pwauth_path', '/usr/bin/pwauth');
  $config->setAppValue('user_pwauth_ex', 'uid_list', '1000-1010');
}
?>
