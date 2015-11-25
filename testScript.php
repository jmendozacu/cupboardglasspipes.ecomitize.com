<?php
/* Substitute appropriate Mage path: */
require_once("app/Mage.php");
Mage::app()->setCurrentStore(1);
 
$hlp = Mage::helper('core');
 
echo ($hlp->decrypt("UrstF4Nph1Bu3T35+7sIwXD/8v5U/1JZ") . "\n");
echo ($hlp->decrypt("L8V/NTYMnVwv9xLeqgt1zXWljejrF2oG") . "\n");

exit;