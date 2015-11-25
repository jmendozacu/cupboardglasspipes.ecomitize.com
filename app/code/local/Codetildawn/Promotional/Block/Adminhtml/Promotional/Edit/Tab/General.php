<?php

class Codetildawn_Promotional_Block_Adminhtml_Promotional_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('promotional_form', array('legend' => Mage::helper('promotional')->__('General')));
        
		$fieldset->addField('name', 'text', array(
            'label' 	=> Mage::helper('promotional')->__('Name'),
            'name' 		=> 'name',
			'class' 	=> 'required-entry',
            'required' 	=> true,
        ));

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $fieldset->addField('date_from', 'date', array(
            'label' 	=> Mage::helper('promotional')->__('Date From'),
            'name' 		=> 'date_from',
			'required' 	=> false,
            'image'    	=> $this->getSkinUrl('images/grid-cal.gif'),
            'format' 	=> $dateFormatIso,
        ));

        $fieldset->addField('date_to', 'date', array(
            'label' 	=> Mage::helper('promotional')->__('Date To'),
            'name' 		=> 'date_to',
			'required' 	=> false,
            'image'    	=> $this->getSkinUrl('images/grid-cal.gif'),
            'format' 	=> $dateFormatIso,
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_view', 'multiselect', array(
                'label' 	=> Mage::helper('promotional')->__('Store View'),
                'name' 		=> 'store_view',
				'class' 	=> 'required-entry',
                'required' 	=> true,
                'values' 	=> Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }

        $fieldset->addField('page_type', 'multiselect', array(
            'label' 	=> Mage::helper('promotional')->__('Page Type'),
            'name' 		=> 'page_type',
			'class' 	=> 'required-entry',
            'required' 	=> true,
            'values' 	=> Mage::getModel('promotional/source_page')->toOptionArray(),

        ));

        $fieldset->addField('position', 'select', array(
            'label' 	=> Mage::helper('promotional')->__('Position'),
            'name' 		=> 'position',
            'class' 	=> 'required-entry',
            'required' 	=> true,
            'values' 	=> Mage::getModel('promotional/source_position')->toOptionArray(),
        ));

        $fieldset->addField('status', 'select', array(
            'label' 	=> Mage::helper('promotional')->__('Status'),
            'name' 		=> 'status',
            'class' 	=> 'required-entry',
            'required' 	=> true,
            'values' 	=> Mage::getModel('promotional/source_status')->toOptionArray(),
        ));

        $fieldset->addField('width', 'text', array(
            'label' 	=> Mage::helper('promotional')->__('Width, px'),
            'name' 		=> 'width',
			'required' 	=> false,
            'note' 		=> $this->__('Minimum width is 200px'),
        ));

        $fieldset->addField('height', 'text', array(
            'label' 	=> Mage::helper('promotional')->__('Height, px'),
            'name' 		=> 'height',
			'required' 	=> false,
            'note' 		=> $this->__('Miimum height is 300px'),
        ));

        if (Mage::getSingleton('adminhtml/session')->getPromotionalData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPromotionalData());
            Mage::getSingleton('adminhtml/session')->setPromotionalData(null);
        } elseif (Mage::registry('promotional_data')) {
            $form->setValues(Mage::registry('promotional_data')->getData());
        }
		
        if (Mage::getSingleton('adminhtml/session')->getPromotionalData() == NULL && Mage::registry('promotional_data')->getData() == NULL){
            $form->setValues(array(
                'position' => Mage::helper('promotional')->getDefaultPosition(),
            ));
		}
        
		return parent::_prepareForm();
    }
}