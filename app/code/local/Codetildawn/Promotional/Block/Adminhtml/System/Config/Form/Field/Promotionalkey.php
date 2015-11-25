<?php
class Codetildawn_Promotional_Block_Adminhtml_System_Config_Form_Field_Promotionalkey extends Mage_Adminhtml_Block_System_Config_Form_Field
{
	protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $html = parent::_getElementHtml($element);

		$module = 'Codetildawn_Promotional';
		$activeHtml = Mage::helper('licensemanager')->getExtensionStatusHtml($module);
        $html.= $activeHtml;
		
        return $html;
    }
	
}
?>
