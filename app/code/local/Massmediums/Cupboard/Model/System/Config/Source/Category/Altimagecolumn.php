<?php

class Massmediums_Cupboard_Model_System_Config_Source_Category_AltImageColumn
{
    public function toOptionArray()
    {
        return array(
			array('value' => 'label',			'label' => Mage::helper('cupboard')->__('Label')),
            array('value' => 'position',		'label' => Mage::helper('cupboard')->__('Sort Order'))
        );
    }
}
