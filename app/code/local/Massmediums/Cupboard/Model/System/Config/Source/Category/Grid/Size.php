<?php

class Massmediums_Cupboard_Model_System_Config_Source_Category_Grid_Size
{
	public function toOptionArray()
	{
		return array(
			array('value' => '',	'label' => Mage::helper('massmediums')->__('Default')),
			array('value' => 's',	'label' => Mage::helper('massmediums')->__('Size S')),
			array('value' => 'xs',	'label' => Mage::helper('massmediums')->__('Size XS')),
		);
	}
}
