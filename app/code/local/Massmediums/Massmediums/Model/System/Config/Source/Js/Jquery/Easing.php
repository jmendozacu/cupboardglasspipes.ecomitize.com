<?php

class Massmediums_Massmediums_Model_System_Config_Source_Js_Jquery_Easing
{
    public function toOptionArray()
    {
        return array(
			//Ease in-out
			array('value' => 'easeInOutSine',	'label' => Mage::helper('massmediums')->__('easeInOutSine')),
			array('value' => 'easeInOutQuad',	'label' => Mage::helper('massmediums')->__('easeInOutQuad')),
			array('value' => 'easeInOutCubic',	'label' => Mage::helper('massmediums')->__('easeInOutCubic')),
			array('value' => 'easeInOutQuart',	'label' => Mage::helper('massmediums')->__('easeInOutQuart')),
			array('value' => 'easeInOutQuint',	'label' => Mage::helper('massmediums')->__('easeInOutQuint')),
			array('value' => 'easeInOutExpo',	'label' => Mage::helper('massmediums')->__('easeInOutExpo')),
			array('value' => 'easeInOutCirc',	'label' => Mage::helper('massmediums')->__('easeInOutCirc')),
			array('value' => 'easeInOutElastic','label' => Mage::helper('massmediums')->__('easeInOutElastic')),
			array('value' => 'easeInOutBack',	'label' => Mage::helper('massmediums')->__('easeInOutBack')),
			array('value' => 'easeInOutBounce',	'label' => Mage::helper('massmediums')->__('easeInOutBounce')),
			//Ease out
			array('value' => 'easeOutSine',		'label' => Mage::helper('massmediums')->__('easeOutSine')),
			array('value' => 'easeOutQuad',		'label' => Mage::helper('massmediums')->__('easeOutQuad')),
			array('value' => 'easeOutCubic',	'label' => Mage::helper('massmediums')->__('easeOutCubic')),
			array('value' => 'easeOutQuart',	'label' => Mage::helper('massmediums')->__('easeOutQuart')),
			array('value' => 'easeOutQuint',	'label' => Mage::helper('massmediums')->__('easeOutQuint')),
			array('value' => 'easeOutExpo',		'label' => Mage::helper('massmediums')->__('easeOutExpo')),
			array('value' => 'easeOutCirc',		'label' => Mage::helper('massmediums')->__('easeOutCirc')),
			array('value' => 'easeOutElastic',	'label' => Mage::helper('massmediums')->__('easeOutElastic')),
			array('value' => 'easeOutBack',		'label' => Mage::helper('massmediums')->__('easeOutBack')),
			array('value' => 'easeOutBounce',	'label' => Mage::helper('massmediums')->__('easeOutBounce')),
			//Ease in
			array('value' => 'easeInSine',		'label' => Mage::helper('massmediums')->__('easeInSine')),
			array('value' => 'easeInQuad',		'label' => Mage::helper('massmediums')->__('easeInQuad')),
			array('value' => 'easeInCubic',		'label' => Mage::helper('massmediums')->__('easeInCubic')),
			array('value' => 'easeInQuart',		'label' => Mage::helper('massmediums')->__('easeInQuart')),
			array('value' => 'easeInQuint',		'label' => Mage::helper('massmediums')->__('easeInQuint')),
			array('value' => 'easeInExpo',		'label' => Mage::helper('massmediums')->__('easeInExpo')),
			array('value' => 'easeInCirc',		'label' => Mage::helper('massmediums')->__('easeInCirc')),
			array('value' => 'easeInElastic',	'label' => Mage::helper('massmediums')->__('easeInElastic')),
			array('value' => 'easeInBack',		'label' => Mage::helper('massmediums')->__('easeInBack')),
			array('value' => 'easeInBounce',	'label' => Mage::helper('massmediums')->__('easeInBounce')),
			//No easing
			array('value' => '',				'label' => Mage::helper('massmediums')->__('No easing'))
        );
    }
}
