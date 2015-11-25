<?php

class Codetildawn_Promotional_Block_Adminhtml_Promotional extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_promotional';
        $this->_blockGroup = 'promotional';
        $this->_headerText = Mage::helper('promotional')->__('List Promotional Popups');
        $this->_addButtonLabel = Mage::helper('promotional')->__('Add New Popup');
        parent::__construct();
    }
}