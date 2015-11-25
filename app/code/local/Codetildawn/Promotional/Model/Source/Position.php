<?php

class Codetildawn_Promotional_Model_Source_Position
{
    public function toOptionArray()
    {
        $helper = Mage::helper('promotional');
        return array(
            array('value' => 1, 	'label' => $helper->__("Top")),
            array('value' => 2, 	'label' => $helper->__("Middle")),
            array('value' => 3, 	'label' => $helper->__("Bottom")),
        );
    }
}