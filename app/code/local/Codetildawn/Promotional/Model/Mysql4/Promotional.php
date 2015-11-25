<?php

class Codetildawn_Promotional_Model_Mysql4_Promotional extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('promotional/promotional', 'promotional_id');
    }


}