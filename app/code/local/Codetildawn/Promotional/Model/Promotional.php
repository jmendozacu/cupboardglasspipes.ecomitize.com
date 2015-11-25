<?php

class Codetildawn_Promotional_Model_Promotional extends Mage_Core_Model_Abstract
{
    private $_popupsForPage = null;

    public function _construct()
    {
        parent::_construct();
        $this->_init('promotional/promotional');
    }

    protected function _beforeSave()
    {
        // convert StoreView from Array to String
        $storeView = $this->getStoreView();
        if (is_array($storeView)) {
            $storeView = implode(',', $storeView);
        }
        if ($storeView) {
            $this->setStoreView($storeView);
        }

        // convert PageType from Array to String
        $pageType = $this->getPageType();
        if (is_array($pageType)) {
            $pageType = implode(',', $pageType);
        }
        if ($pageType) {
            $this->setPageType($pageType);
        }
        return $this;
    }

    public function getPopupCollectionByPageType($pageType)
    {
        $today = date('Y-m-d');
        if (!$this->_popupsForPage) {
            $this->_popupsForPage = $this->getCollection()
                ->addFieldToFilter('status', array('eq' => 1))
                ->addPageTypeFilter($pageType)
                ->addFilterByStoreId(Mage::app()->getStore()->getId())
                ->addFieldToFilter('date_from', array('lteq' => $today))
                ->addFieldToFilter('date_to', array('gteq' => $today))
                ->addOrder('promotional_id', 'DESC');
        }
        return $this->_popupsForPage;
    }

}