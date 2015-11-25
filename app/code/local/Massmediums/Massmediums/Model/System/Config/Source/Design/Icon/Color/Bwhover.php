<?php

class Massmediums_Massmediums_Model_System_Config_Source_Design_Icon_Color_Bwhover
{
    public function toOptionArray()
    {
		return array(
			array('value' => 'b',		'label' => Mage::helper('massmediums')->__('Black')),
            array('value' => 'w',		'label' => Mage::helper('massmediums')->__('White')),
            array('value' => 'bw',		'label' => Mage::helper('massmediums')->__('Black | White on hover')),
            array('value' => 'wb',		'label' => Mage::helper('massmediums')->__('White | Black on hover')),
        );
    }
}
