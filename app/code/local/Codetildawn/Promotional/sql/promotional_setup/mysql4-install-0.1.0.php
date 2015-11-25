<?php

$this->startSetup();
$this->run("
-- DROP TABLE IF EXISTS {$this->getTable('promotional/promotional')};
CREATE TABLE {$this->getTable('promotional/promotional')} (
    `promotional_id` int(11) unsigned NOT NULL auto_increment,
    `name` varchar(255) NOT NULL default '',
    `title` varchar(255) NULL,
    `popup_html` text NOT NULL default '',
    `status` smallint(6) NOT NULL default '0',
    `page_type` varchar(255) NOT NULL default '',
    `store_view` varchar(255) NOT NULL default '0',
    `date_from` date NULL,
    `date_to` date NULL,
    `position`  smallint(6) NOT NULL,
    `width`  smallint(6) NULL,
    `height` smallint(6) NULL,
    PRIMARY KEY (`promotional_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");
$this->endSetup();