<?php

class Codetildawn_Promotional_Model_Source_Page
{

    public function toOptionArray(){
        $helper = Mage::helper('promotional');
        return array(
            array('value' => 1, 	'label' => $helper->__("Home Page")),
            array('value' => 2, 	'label' => $helper->__("Product View")),
            array('value' => 3, 	'label' => $helper->__("Category View")),
            array('value' => 4, 	'label' => $helper->__("CMS Pages")),
            array('value' => 5, 	'label' => $helper->__("Checkout")),
            array('value' => 6, 	'label' => $helper->__("Cart")),
        );

    }

   /**
     * Retrive Page Id by Page Name
     * @return string
     */
    public function getPageIDByName($name)
    {
        $pages = array(
            'home' 	 	=> 1,
            'product'  	=> 2,
            'category' 	=> 3,
            'cms' 	 	=> 4,
            'checkout' 	=> 5,
            'cart' 		=> 6,
        );
        return $pages[$name];
    }

}