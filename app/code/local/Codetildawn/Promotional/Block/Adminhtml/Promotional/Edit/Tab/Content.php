<?php

class Codetildawn_Promotional_Block_Adminhtml_Promotional_Edit_Tab_Content extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        try {
            if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
        } catch (Exception $ex) {
        }
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('promotional_form', array('legend' => Mage::helper('promotional')->__('Content')));

        $fieldset->addField('title', 'text', array(
            'label' 	=> Mage::helper('promotional')->__('Content Heading'),
            'name' 		=> 'title',
            'required' 	=> false,
			'style' 	=> 'width:600px;',
        ));

        $contentField = $fieldset->addField('popup_html', 'editor', array(
            'name'		=> 'popup_html',
            'style' 	=> 'height:500px;width:800px;',
            'required' 	=> false,
			'wysiwyg'   => true,
			'config'   	=> Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ));

        if (Mage::getSingleton('adminhtml/session')->getPromotionalData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPromotionalData());
            Mage::getSingleton('adminhtml/session')->setPromotionalData(null);
        } elseif (Mage::registry('promotional_data')) {
            $form->setValues(Mage::registry('promotional_data')->getData());
        }

        return parent::_prepareForm();
    }
}