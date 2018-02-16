<?php

namespace OCA\UserPwauth\Service;

use \OCP\IConfig;

class AuthorService {
	private $config;
	private $appName = 'UserPwauth';
	
	public function __construct(IConfig $config, $appName) {
		$this->config = $config;
		$this->appName = $appName;
	}

	public function getSystemValue($key) {
		return $this->config->getSystemValue($key);
	}
	
	public function setSystemValue($key, $value) {
		$this->config->setSystemValue($key, $value);
	}
}

?>
