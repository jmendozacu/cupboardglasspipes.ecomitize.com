<?php
/**
 * MageWorx
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MageWorx EULA that is bundled with
 * this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.mageworx.com/LICENSE-1.0.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extension
 * to newer versions in the future. If you wish to customize the extension
 * for your needs please refer to http://www.mageworx.com/ for more information
 *
 * @category   MageWorx
 * @package    MageWorx_CustomOptions
 * @copyright  Copyright (c) 2012 MageWorx (http://www.mageworx.com/)
 * @license    http://www.mageworx.com/LICENSE-1.0.html
 */

/**
 * Advanced Product Options extension
 *
 * @category   MageWorx
 * @package    MageWorx_CustomOptions
 * @author     MageWorx Dev Team
 */

class MageWorx_CustomOptions_Model_Mysql4_Stock_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected $_map = array('fields' => array(
        'product_id'   => 'cpo.product_id',
        'product_name' => 'pn.product_name',
        'product_sku'  => 'cpe.sku',
        'option_name'  => 'cpot.title',
        'value_name'   => 'cpott.title',
        'qty'          => 'qty',
        'sku'          => 'main_table.sku',
    ));
    
    protected function _construct() {
        $this->_init('customoptions/stock');
    }

    public function addOptionName() {
        $this->getSelect()
            ->joinLeft(
                array('cpot' => $this->getTable('catalog/product_option_title')), 
                'cpot.option_id = main_table.option_id', 
                array('option_name'=>'cpot.title')
            );
        return $this;
    }
    
    public function addValueName() {
        $this->getSelect()
            ->joinLeft(
                array('cpott' => $this->getTable('catalog/product_option_type_title')), 
                'cpott.option_type_id = main_table.option_type_id', 
                array('value_name'=>'cpott.title')
            );
        return $this;
    }
    
    public function addProductSku() {
        $this->getSelect()
            ->joinLeft(
                array('cpo' => $this->getTable('catalog/product_option')), 
                'cpo.option_id = main_table.option_id', 
                array('cpo.product_id')
            )
            ->joinLeft(
                array('cpe' => Mage::getConfig()->getTablePrefix().'catalog_product_entity'), 
                'cpe.entity_id = cpo.product_id', 
                array('product_sku'=>'cpe.sku')
            );
        return $this;
    }
    
    public function addProductName() {
        $this->getSelect()
            ->joinLeft(
                array('pn' => new Zend_Db_Expr($this->getTableProductName())), 
                'pn.entity_id = cpo.product_id', 
                array('product_name'=>'pn.product_name')
            );
        return $this;
    }
    
    public function addOptionsQty() {
        $this->getSelect()
            ->joinLeft(
                array('cpe2' => $this->getTable('catalog/product')), 
                'cpe2.sku = main_table.sku', 
                array('cpe2.entity_id')
            )
            ->joinLeft(
                array('csi' => $this->getTable('cataloginventory/stock_item')), 
                'csi.product_id = cpe2.entity_id', 
                array('csi_qty' => 'csi.qty')
            )
            ->columns(
                array('qty' => new Zend_Db_Expr('IF(main_table.sku IS NULL OR main_table.sku="", main_table.customoptions_qty, csi.qty)'))
            );
        return $this;
    }
    
    private function getTableProductName() {
        $tableCPEV = $this->getTable('customoptions/product_entity_varchar');
        $tableEET = $this->getTable('eav/entity_type');
        return '(SELECT cpev.entity_id as entity_id, cpev.attribute_id as attribute_id, cpev.value as product_name
                FROM '.$tableCPEV.' as cpev
                WHERE attribute_id = (
                   SELECT e.attribute_id 
                   FROM eav_attribute e
                   LEFT JOIN '.$tableEET.' AS t ON e.entity_type_id = t.entity_type_id
                   WHERE e.attribute_code = \'name\' AND t.entity_type_code = \'catalog_product\'
                ) AND cpev.store_id = 0)';
    }
    
    
}