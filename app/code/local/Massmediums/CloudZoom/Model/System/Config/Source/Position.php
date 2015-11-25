<?php

class Massmediums_CloudZoom_Model_System_Config_Source_Position
{
    public function toOptionArray()
    {
        return array(
			array('value' => 'inside',		'label' => Mage::helper('massmediums_cloudzoom')->__('Inside')),
			array('value' => 'right',		'label' => Mage::helper('massmediums_cloudzoom')->__('Right')),
			array('value' => 'left',		'label' => Mage::helper('massmediums_cloudzoom')->__('Left')),
			array('value' => 'top',			'label' => Mage::helper('massmediums_cloudzoom')->__('Top')),
			array('value' => 'bottom',		'label' => Mage::helper('massmediums_cloudzoom')->__('Bottom'))
        );
    }
}
