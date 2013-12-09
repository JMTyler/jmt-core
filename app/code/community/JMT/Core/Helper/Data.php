<?php

class JMT_Core_Helper_Data extends Mage_Core_Helper_Abstract
{
	protected static $_underscoreCache = array();
	
	public function underscore($name)
	{
		if (isset(self::$_underscoreCache[$name])) {
			return self::$_underscoreCache[$name];
		}
		$result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
		self::$_underscoreCache[$name] = $result;
		return $result;
	}
}
