<?php


class Codetildawn_Promotional_Block_Adminhtml_Promotional_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('promotionalGrid');
        $this->setDefaultSort('promotional_id');
        $this->setDefaultDir('ASC');
        $this->setDefaultLimit('20');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('promotional/promotional')->getCollection();
        $this->setCollection($collection);


        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('promotional_id', array(
            'header' => Mage::helper('promotional')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'promotional_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('promotional')->__('Name'),
            'align' => 'left',
            'index' => 'name',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_view', array(
                'header' => Mage::helper('sales')->__('Store'),
                'index' => 'store_view',
                'width' => '200px',
                'align' => 'left',
                'type' => 'store',
                'store_view' => true,
                'display_deleted' => false,
                'filter_condition_callback' => array($this, 'applyWebsiteFilter')
            ));
        }

        $this->addColumn('date_from', array(
            'header' => Mage::helper('promotional')->__('From'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'date_from',
            'type' => 'date',
        ));

        $this->addColumn('date_to', array(
            'header' => Mage::helper('promotional')->__('To'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'date_to',
            'type' => 'date',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('promotional')->__('Status'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::getModel('promotional/source_status')->toShortOptionArray(),
        ));


        $this->addColumn('action',
            array(
                'header' => Mage::helper('promotional')->__('Action'),
                'width' => '100px',
                'align' => 'center',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('promotional')->__('Edit'),
                        'url' => array('base' => '*/*/edit'),
                        'field' => 'id'
                    ),
                    array(
                        'caption' => Mage::helper('promotional')->__('Delete'),
                        'url' => array('base' => '*/*/delete'),
                        'field' => 'id',
                        'confirm' => Mage::helper('promotional')->__('Are you sure?')
                    ),

                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('promotional_id');
        $this->getMassactionBlock()->setFormFieldName('promotional');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('promotional')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('promotional')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('promotional/source_status')->toOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('promotional')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('promotional')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function applyWebsiteFilter($collection, $column)
    {
        $collection->addFilterByWebsite($column->getFilter()->getValue());
        return $this;
    }

}