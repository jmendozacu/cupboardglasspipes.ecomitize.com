<?php
/**
 * Call actions after configuration is saved
 */
class Massmediums_Cupboard_Model_Observer
{
	/**
     * After any system config is saved
     */
	public function hookTo_controllerActionPostdispatchAdminhtmlSystemConfigSave()
	{
		$section = Mage::app()->getRequest()->getParam('section');
		if ($section == 'cupboard_layout')
		{
			$websiteCode = Mage::app()->getRequest()->getParam('website');
			$storeCode = Mage::app()->getRequest()->getParam('store');
		
			Mage::getSingleton('cupboard/cssgen_generator')->generateCss('grid',   $websiteCode, $storeCode);
			Mage::getSingleton('cupboard/cssgen_generator')->generateCss('layout', $websiteCode, $storeCode);
		}
		elseif ($section == 'cupboard_design')
		{
			$websiteCode = Mage::app()->getRequest()->getParam('website');
			$storeCode = Mage::app()->getRequest()->getParam('store');
			
			Mage::getSingleton('cupboard/cssgen_generator')->generateCss('design', $websiteCode, $storeCode);
		}
		elseif ($section == 'cupboard')
		{
			$websiteCode = Mage::app()->getRequest()->getParam('website');
			$storeCode = Mage::app()->getRequest()->getParam('store');
			
			Mage::getSingleton('cupboard/cssgen_generator')->generateCss('layout', $websiteCode, $storeCode);
		}
	}
	
	/**
     * After store view is saved
     */
	public function hookTo_storeEdit(Varien_Event_Observer $observer)
	{
		$store = $observer->getEvent()->getStore();
		$storeCode = $store->getCode();
		$websiteCode = $store->getWebsite()->getCode();
		
		Mage::getSingleton('cupboard/cssgen_generator')->generateCss('grid',   $websiteCode, $storeCode);
		Mage::getSingleton('cupboard/cssgen_generator')->generateCss('layout', $websiteCode, $storeCode);
		Mage::getSingleton('cupboard/cssgen_generator')->generateCss('design', $websiteCode, $storeCode);
	}
}
