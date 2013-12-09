<?php

abstract class JMT_Core_Helper_Config_Abstract extends Mage_Core_Helper_Abstract
{
	// TODO: What about for modules with multiple subsections?  e.g. Sweet Tooth
	protected $_prefix = 'jmtyler/general/';
	
	protected $_helper = null;
	
	public function __call($method, $args)
	{
		switch (substr($method, 0, 3)) {
			case 'get':
				$key = $this->_getHelper()->underscore(substr($method, 3));
				// TODO: Should be able to pass in store id
				$data = Mage::getStoreConfig($this->_prefix . $key, 0);
				return $data;
			
			case 'set':
				$key = $this->_getHelper()->underscore(substr($method, 3));
				// TODO: Should be able to pass in store id
				Mage::getConfig()->saveConfig($this->_prefix . $key, $args[0]);
				return $this;
		}
		
		throw new Varien_Exception("Invalid method " . get_class($this) . "::" . $method . "(" . print_r($args, true) . ")");
	}
	
	/**
	 * @return JMT_Core_Helper_Data
	 */
	protected function _getHelper()
	{
		if (isset($this->_helper)) {
			return $this->_helper;
		}
		
		$this->_helper = Mage::helper('jmtyler');
		return $this->_helper;
	}
}
