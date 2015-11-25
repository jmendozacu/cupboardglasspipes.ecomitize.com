<?php

class Codetildawn_Promotional_Model_Observer {

	public function adminlogin($observer){
		
		$module = 'Codetildawn_Promotional';
		$licenseKey = Mage::getStoreConfig('licensemanager/licenses/promotional_key');
		$mode = 'live';
		
		$fields = array();
		$fields['module'] 	= $module;
		$fields['license'] 	= $licenseKey;
		$fields['mode'] 	= $mode;
		$fields['domain'] 	= $_SERVER['HTTP_HOST'];
		
		$status = Mage::helper('licensemanager')->checkExtensionVersion($fields);
		
		if($status == 'expired'){
			 Mage::getModel('core/config')->saveConfig('promotional/general/status', '0');
			 Mage::getConfig()->cleanCache();
		}
		
	}	
	

}
