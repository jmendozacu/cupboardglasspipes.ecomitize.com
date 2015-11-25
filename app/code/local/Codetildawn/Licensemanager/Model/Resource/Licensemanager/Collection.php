<?php

class Codetildawn_Licensemanager_Model_Resource_Licensemanager_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
		parent::_construct();
        $this->_init('licensemanager/licensemanager');
    }

}