<?php

class Massmediums_Cupboard_Model_System_Config_Source_Header_Toplinks_Break_Position
{
    public function toOptionArray()
    {
		return array(
			array('value' => '',	'label' => Mage::helper('cupboard')->__('No Additional Line Break')),
			array('value' => '30',	'label' => Mage::helper('cupboard')->__('Before Cart Drop-Down Block')),
			array('value' => '31',	'label' => Mage::helper('cupboard')->__('After Cart Drop-Down Block')),
			array('value' => '32',	'label' => Mage::helper('cupboard')->__('Before Compare Block')),
			array('value' => '33',	'label' => Mage::helper('cupboard')->__('After Compare Block')),
			array('value' => '34',	'label' => Mage::helper('cupboard')->__('Before Top Links')),
			array('value' => '35',	'label' => Mage::helper('cupboard')->__('After Top Links')),
        );
    }
}
