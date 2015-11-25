<?php

class Massmediums_Cupboard_Model_System_Config_Source_Header_Search_Position
{
    public function toOptionArray()
    {
		return array(
			array('value' => '20',	'label' => Mage::helper('cupboard')->__('Central Column')),
			array('value' => '30',	'label' => Mage::helper('cupboard')->__('Before Cart Drop-Down Block')),
			array('value' => '31',	'label' => Mage::helper('cupboard')->__('Before Compare Block')),
			array('value' => '32',	'label' => Mage::helper('cupboard')->__('Before Top Links')),
			array('value' => '33',	'label' => Mage::helper('cupboard')->__('After Top Links')),
        );
    }
}
