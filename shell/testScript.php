<?php
/* Substitute appropriate Mage path: */
require_once("./app/Mage.php");
Mage::app()->setCurrentStore(1);
 
$hlp = Mage::helper('core');
 
echo ($hlp->decrypt("nBXQiMz+GAxoYRHhydJyhA==") . "\n");
echo ($hlp->decrypt("2vg7JMpsO5HtfzPQyUdzUg==") . "\n");

exit;


//Login ID : nBXQiMz+GAxoYRHhydJyhA==
//Key : 2vg7JMpsO5HtfzPQyUdzUg==
