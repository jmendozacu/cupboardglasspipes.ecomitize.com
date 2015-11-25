<?php

class Codetildawn_Promotional_Model_Source_Status
{
    public function toOptionArray()
    {
        $helper = Mage::helper('promotional');
        return array(
            array('value' => 1, 'label' => $helper->__("Enabled")),
            array('value' => 2, 'label' => $helper->__("Disabled")),
        );
    }

    public function toShortOptionArray()
    {
        $_options = array();
        foreach ($this->toOptionArray() as $option)
            $_options[$option['value']] = $option['label'];
        return $_options;
    }
}