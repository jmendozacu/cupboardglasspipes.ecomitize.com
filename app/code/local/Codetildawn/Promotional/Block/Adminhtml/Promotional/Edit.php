<?php


class Codetildawn_Promotional_Block_Adminhtml_Promotional_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'promotional';
        $this->_controller = 'adminhtml_promotional';

        $this->_updateButton('save', 'label', Mage::helper('promotional')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('promotional')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('popup_html') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'popup_html');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'popup_html');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('promotional_data') && Mage::registry('promotional_data')->getId()) {
            return Mage::helper('promotional')->__("Edit Promotional Popup '%s'", $this->escapeHtml(Mage::registry('promotional_data')->getName()));
        } else {
            return Mage::helper('promotional')->__('Add Promotional Popup');
        }
    }
}