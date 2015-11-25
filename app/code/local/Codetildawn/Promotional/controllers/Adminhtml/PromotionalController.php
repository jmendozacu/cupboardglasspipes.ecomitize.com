<?php

class Codetildawn_Promotional_Adminhtml_PromotionalController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/promotional')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotional Pop-ups'), Mage::helper('adminhtml')->__('promotional Pop-ups'));

        $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

        return $this;
    }

    public function indexAction()
    {
        $this->_isAllowed();
		$this->_title(Mage::helper('adminhtml')->__('Promotional Pop-ups List'));
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction()
    {
		$this->_isAllowed();
		$this->_title(Mage::helper('adminhtml')->__('Promotional Popup Edit'));
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('promotional/promotional')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('promotional_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('cms/promotional');

            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotional Popup Manager'), Mage::helper('adminhtml')->__('Promotional Popup Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotional Popup News'), Mage::helper('adminhtml')->__('Promotional Popup News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('promotional/adminhtml_promotional_edit'))
                ->_addLeft($this->getLayout()->createBlock('promotional/adminhtml_promotional_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('promotional')->__('Promotional Popup does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->_isAllowed();
        $this->_forward('edit');
    }

    public function saveAction()
    {
        $this->_isAllowed();
        if ($data = $this->getRequest()->getPost()) {

            $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
            $localeCode=Mage::app()->getLocale()->getLocaleCode();
            if (empty($data['date_from'])) {
                $from = new Zend_Date();
            } else {
                $from = new Zend_Date($data['date_from'], $dateFormatIso,$localeCode);
            }
            $data['date_from'] = $from->setTimezone('utc')->toString(Varien_Date::DATE_INTERNAL_FORMAT);

            if (empty($data['date_to'])) {
                $to = new Zend_Date();
                $to->addMonth(1);
            } else {
                $to = new Zend_Date($data['date_to'], $dateFormatIso,$localeCode);
            }
            $data['date_to'] = $to->setTimezone('utc')->toString(Varien_Date::DATE_INTERNAL_FORMAT);

            if (!isset($data['store_view'])) {
                $data['store_view'][] = '0';
            }
            if ($data['store_view'][0] == '0') {
                $stores = Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true);
                foreach ($stores as $store) {
                    if (is_array($store['value'])) {
                        foreach ($store['value'] as $value) {
                            $data['store_view'][] = $value['value'];
                        }
                    }
                }
            }


            $model = Mage::getModel('promotional/promotional');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('promotional')->__('Popup was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('promotional')->__('Unable to find Popup to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('promotional/promotional');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Popup was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $popupIds = $this->getRequest()->getParam('promotional');
        if (!is_array($popupIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select Popup(s)'));
        } else {
            try {
                foreach ($popupIds as $popupId) {
                    $popup = Mage::getModel('promotional/promotional')->load($popupId);
                    $popup->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($popupIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $popupIds = $this->getRequest()->getParam('promotional');
        if (!is_array($popupIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select Popup(s)'));
        } else {
            try {
                foreach ($popupIds as $popupId) {
                    $popup = Mage::getSingleton('promotional/promotional')
                        ->load($popupId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($popupIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _isAllowed()
    {
        try {
            $session = Mage::getSingleton('admin/session');
            $resourceLookup = "admin/cms/promotional/list_promotionals";
            $resourceId = $session->getData('acl')->get($resourceLookup)->getResourceId();
            if (!$session->isAllowed($resourceId)) {
                throw new Exception('');
            }
            return true;
        } catch (Exception $e) {
            $this->_forward('denied');
            return false;
        }
    }

}