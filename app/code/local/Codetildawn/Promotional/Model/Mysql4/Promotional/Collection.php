<?php

class Codetildawn_Promotional_Model_Mysql4_Promotional_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('promotional/promotional');
    }

    public function addFilterByStoreId($id = null)
    {
        if (is_null($id)) {
            $id = Mage::app()->getStore()->getId();
        }
        $this->getSelect()->where('find_in_set(?, store_view) or find_in_set(0, store_view)', $id);
        return $this;
    }

    public function addPageTypeFilter($id = null)
    {
        if (is_null($id)) {
            $id = Mage::app()->getStore()->getId();
        }
        $this->getSelect()->where('find_in_set(?, page_type)', $id);
        return $this;
    }

    protected function _afterLoad()
    {
        parent::_afterLoad();
        // convert StoreView from string to Array
        foreach ($this->_items as $item) {
            $item->setStoreView(explode(',', $item->getStoreView()));
        }

        Mage::dispatchEvent('core_collection_abstract_load_after', array('collection' => $this));
        return $this;
    }
}