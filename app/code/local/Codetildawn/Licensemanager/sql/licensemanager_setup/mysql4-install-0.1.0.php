<?php

$installer = $this;

$connection = $installer->getConnection();

$installer->startSetup();

$installer->run("

	CREATE TABLE IF NOT EXISTS `{$this->getTable('licensemanager')}` (
	  `id` int(10) unsigned NOT NULL auto_increment,
      `module` varchar(255) NOT NULL,
	  `license` varchar(255) NOT NULL,
	  `mode` enum('test', 'live') default 'test',
	  `status` enum('active', 'expired') default 'active',
	  `expiry_date` date NOT NULL DEFAULT '0000-00-00',
	  `last_check` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	  PRIMARY KEY  (`id`)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8;

");

$installer->endSetup();