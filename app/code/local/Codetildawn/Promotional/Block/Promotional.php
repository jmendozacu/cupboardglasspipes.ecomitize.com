<?php

class Codetildawn_Promotional_Block_Promotional extends Mage_Core_Block_Template
{
    const PAGE_NAME = 'home';
	
    public function _construct() {
		
		if(Mage::helper('promotional')->isExtensionAvailable()){
			parent::_construct();
			$this->setTemplate('promotional/promotional.phtml');
		}
		return;
	}
	
    public function getPopupAjaxUrl()
    {
        return Mage::getUrl('promotional/index/popupajax', array('page' => Mage::helper('promotional')->getModuleName()));
    }

	public function getPopupCloseAjaxUrl()
    {
        return Mage::getUrl('promotional/index/popupajaxclose');
    }
}