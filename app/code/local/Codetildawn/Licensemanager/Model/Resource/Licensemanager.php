<?php

class Codetildawn_Licensemanager_Model_Resource_Licensemanager extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('licensemanager/licensemanager', 'id');
    }

}