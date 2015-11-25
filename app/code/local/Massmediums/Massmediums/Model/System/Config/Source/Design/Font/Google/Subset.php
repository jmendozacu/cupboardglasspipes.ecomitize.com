<?php

class Massmediums_Massmediums_Model_System_Config_Source_Design_Font_Google_Subset
{
	public function toOptionArray()
	{
		return array(
			array('value' => 'cyrillic',			'label' => Mage::helper('massmediums')->__('Cyrillic')),
			array('value' => 'cyrillic-ext',		'label' => Mage::helper('massmediums')->__('Cyrillic Extended')),
			array('value' => 'greek',				'label' => Mage::helper('massmediums')->__('Greek')),
			array('value' => 'greek-ext',			'label' => Mage::helper('massmediums')->__('Greek Extended')),
			array('value' => 'khmer',				'label' => Mage::helper('massmediums')->__('Khmer')),
			array('value' => 'latin',				'label' => Mage::helper('massmediums')->__('Latin')),
			array('value' => 'latin-ext',			'label' => Mage::helper('massmediums')->__('Latin Extended')),
			array('value' => 'vietnamese',			'label' => Mage::helper('massmediums')->__('Vietnamese')),
		);
	}
}
