<?php

class Codetildawn_Promotional_IndexController extends Mage_Core_Controller_Front_Action
{
    public function popupajaxAction()
    {
        $response = new Varien_Object();
        $response->setError(0);
        try {
            $pageName = $this->getRequest()->getParam('page');
            if (!$pageName) {
                throw new Exception($this->__('PageType not found'));
            }
            $pageName = Mage::helper('core')->escapeHtml($pageName);
            $popup = Mage::helper('promotional')->getPopup($pageName);
			
            if (isset($popup['promotional_id'])) {
                Mage::helper('promotional')->setViewedPopup($popup['promotional_id']);
                $response->addData($popup->toArray());
                $autoHideTime = Mage::helper('promotional')->getAutoHide();
                if ($autoHideTime > 0) {
                    $response->setAutoHideTime($autoHideTime);
                }

            } else {
                throw new Exception('Promotional Popup not found');
            }

        } catch (Exception $e) {
            $response->setError(1);
            $response->setErrorMessage($e->getMessage());
        }
        $this->getResponse()->setBody($response->toJson());
        return;
    }
}
