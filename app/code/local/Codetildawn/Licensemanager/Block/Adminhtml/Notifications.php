<?php

class Codetildawn_Licensemanager_Block_Adminhtml_Notifications extends Mage_Adminhtml_Block_Template
{
    public function getMessage()
    {
		
		$warnMessages = Mage::getSingleton('core/session')->getWarningMessages();
		$message = '';
		if(count($warnMessages) > 0){
			foreach($warnMessages as $key => $warnMessage){
				if(trim($warnMessage) != ''){
					$message.='<strong class="label"> '.$key.': </strong> '.$warnMessage.'<br />';
				}
			}
		}
        return $message;
    }
	
}

