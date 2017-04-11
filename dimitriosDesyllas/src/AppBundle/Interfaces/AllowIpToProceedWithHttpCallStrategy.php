<?php

namespace AppBundle\Interfaces;

interface AllowIpToProceedWithHttpCallStrategy {
	
	/**
	 * @param string $ip
	 * return bool TRUE The ip is allowed FALSE The ip is not allowed
	 */
	public function applyPolicy($ip);
}