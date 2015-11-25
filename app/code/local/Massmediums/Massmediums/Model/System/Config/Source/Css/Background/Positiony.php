<?php

class Massmediums_Massmediums_Model_System_Config_Source_Css_Background_Positiony
{
    public function toOptionArray()
    {
		return array(
			array('value' => 'top',		'label' => Mage::helper('massmediums')->__('top')),
            array('value' => 'center',	'label' => Mage::helper('massmediums')->__('center')),
            array('value' => 'bottom',	'label' => Mage::helper('massmediums')->__('bottom'))
        );
    }
}
