<?php

class Massmediums_Massmediums_Model_System_Config_Source_Category_Grid_ColumnCount
{
    public function toOptionArray()
    {
        return array(
			array('value' => 2, 'label' => Mage::helper('massmediums')->__('2')),
			array('value' => 3, 'label' => Mage::helper('massmediums')->__('3')),
			array('value' => 4, 'label' => Mage::helper('massmediums')->__('4')),
			array('value' => 5, 'label' => Mage::helper('massmediums')->__('5')),
			array('value' => 6, 'label' => Mage::helper('massmediums')->__('6')),
            array('value' => 7, 'label' => Mage::helper('massmediums')->__('7'))
        );
    }
}
