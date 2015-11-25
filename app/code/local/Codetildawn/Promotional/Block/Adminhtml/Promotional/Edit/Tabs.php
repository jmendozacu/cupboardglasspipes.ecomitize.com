<?php

class Codetildawn_Promotional_Block_Adminhtml_Promotional_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('promotional_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('promotional')->__('Promotional Popup Information'));
    }

    protected function _beforeToHtml()
    {

        $this->addTab('general', array(
            'label' => Mage::helper('promotional')->__('General'),
            'title' => Mage::helper('promotional')->__('General'),
            'content' => $this->getLayout()->createBlock('promotional/adminhtml_promotional_edit_tab_general')->toHtml(),
        ));

        $this->addTab('content', array(
            'label' => Mage::helper('promotional')->__('Content'),
            'title' => Mage::helper('promotional')->__('Content'),
            'content' => $this->getLayout()->createBlock('promotional/adminhtml_promotional_edit_tab_content')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}