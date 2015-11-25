<?php
class Codetildawn_Promotional_Model_System_Config_Backend_Promotionalkey extends Mage_Core_Model_Config_Data
{
	
    protected function _beforeSave()
    {
		$licenseKey = $this->getValue();
		$active = true;
		
		if(trim($licenseKey) != ''){
			$fields = array();
			$fields['module'] 	= 'Codetildawn_Promotional';
			$fields['license'] 	= $licenseKey;
			$fields['mode'] 	= 'live';
			$fields['domain'] 	= $_SERVER['HTTP_HOST'];
			
			$status = Mage::helper('licensemanager')->checkExtensionVersion($fields);
			if($status == 'expired'){
				$active = false;
			}
		} else {
			$warnMessages = array();
			$warnMessages = Mage::getSingleton('core/session')->getWarningMessages();
			$warnMessages['Codetildawn_Promotional'] = 'Your extension License is expired. Please contact to Codetildawn Store. Go to "System >> Configuration >> Codetildawn Modules >> License Manager"';
			Mage::getSingleton('core/session')->setWarningMessages($warnMessages);
			$active = false;
		}
		
		if(!$active) {
			Mage::getModel('core/config')->saveConfig('promotional/general/status', '0');
			Mage::getConfig()->cleanCache();
		}

        return $this;
    }
}
