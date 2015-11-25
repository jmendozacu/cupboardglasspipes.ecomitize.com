<?php
/**
 * @author		Massmediums
 * @copyright	Copyright 2012 - 2013 Massmediums
 */
$installer = $this;
$installer->startSetup();

//WYSIWYG hidden by default
Mage::getConfig()->saveConfig('cms/wysiwyg/enabled', 'hidden');

Mage::getSingleton('cupboard/cssgen_generator')->generateCss('grid',   NULL, NULL);
Mage::getSingleton('cupboard/cssgen_generator')->generateCss('layout', NULL, NULL);
Mage::getSingleton('cupboard/cssgen_generator')->generateCss('design', NULL, NULL);

$installer->endSetup();
