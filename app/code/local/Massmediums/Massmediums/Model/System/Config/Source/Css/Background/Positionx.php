<?php

class Massmediums_Massmediums_Model_System_Config_Source_Css_Background_Positionx
{
    public function toOptionArray()
    {
		return array(
			array('value' => 'left',	'label' => Mage::helper('massmediums')->__('left')),
            array('value' => 'center',	'label' => Mage::helper('massmediums')->__('center')),
            array('value' => 'right',	'label' => Mage::helper('massmediums')->__('right'))
        );
    }
}
