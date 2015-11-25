<?php

class Codetildawn_Promotional_Helper_Data extends Mage_Core_Helper_Abstract
{
    const COOKIE_NAME = 'promotional_popup';


    // Check is extension installed and active //
    public static function isExtensionAvailable()
    {
		$extension = 'Codetildawn_Promotional';
		$is_active = Mage::getStoreConfig('promotional/general/status');
        
		$modules = (array)Mage::getConfig()->getNode('modules')->children();
		
		if(array_key_exists($extension, $modules) && (string)$modules[$extension]->active == 'true' && $is_active){
			return true;
		} else {
			return false;
		}
    }

    /**
     * Retrive Default position
     * @return number
     */
    public function getDefaultPosition()
    {
        return Mage::getStoreConfig('promotional/general/default_position');
    }

    /**
     * Retrive Default TimeOut for Auto Hide
     * @return number
     */
    public function getAutoHide()
    {
        return Mage::getStoreConfig('promotional/general/auto_hide');
    }

    public function getCookiesLifetime()
    {
        return Mage::getStoreConfig('promotional/general/cookies_lifetime');
    }

    /**
     * Retrive Number of popups in the base
     * @return number
     */
    public function getPopupCount()
    {
        $collection = Mage::getModel('promotional/promotional')->getCollection();
        return count($collection);
    }

    /**
     * Set visited popup into cookie
     */
    public function setViewedPopup($id)
    {
        /** @var $cookies   Mage_Core_Model_Cookie */
        $cookies = Mage::getModel('core/cookie');
		$cookieName = self::COOKIE_NAME . $id;
        if (!$cookies->get($cookieName)) {
        	$cookies->set($cookieName, $id, Mage::helper('promotional')->getCookiesLifetime());	    
        }
    }

    /**
     * Check if popup is visted or not
     * @return boolean
     */
    public function isVisited($popupId)
    {
        $cookies = Mage::getModel('core/cookie')->get();
		$cookieName = self::COOKIE_NAME.$popupId;
		if(array_key_exists($cookieName,$cookies)){
			return true;
		}
        return false;
    }

    public function updatePopupContent($content)
    {

        $filters = array(
            0 => 'Mage_Catalog_Model_Template_Filter',
            1 => 'Mage_Newsletter_Model_Template_Filter',
            2 => 'Mage_Cms_Model_Template_Filter',
            3 => 'Mage_Widget_Model_Template_Filter',
            4 => 'Mage_Core_Model_Email_Template_Filter',
        );
        $coreData = new Mage_Core_Model_Config();
        $dir = $coreData->getDistroServerVars();
        foreach ($filters as $filter) {
            $path = $dir['app_dir'] . '/code/core/' . str_replace('_', '/', $filter);
            if (file_exists($path . '.php') && class_exists($filter)) {
                $processor = new $filter;
                $content = $processor->filter($content);
            }
        }

        return $content;
    }

    /**
     * Retrive popup that satisfies conditions
     * @return array
     */
    public function getPopup($pageName)
    {
        $pageType = Mage::getModel('promotional/source_page')->getPageIDByName($pageName);
        $popup = Mage::getModel('promotional/promotional')->getPopupCollectionByPageType($pageType)->getFirstItem();
		if ($popup && !$this->isVisited($popup->getId())) {
			$popup->setData('popup_html', $this->updatePopupContent($popup->getData('popup_html')));
			$popup['title'] = htmlspecialchars($popup['title'], ENT_QUOTES);
			if (!$popup['width']) {
				if (preg_match('/width=.([0-9]*)/', $popup['popup_html'], $matches))
					$popup['width'] = $matches[1];
				else
					$popup['width'] = '600';
			}
			return $popup;
		}
    }


    public static function recursiveReplace($search, $replace, $subject)
    {
        if (!is_array($subject)){
			return $subject;
		}

        foreach ($subject as $key => $value){
            if (is_string($value)){
				$subject[$key] = str_replace($search, $replace, $value);
			} elseif (is_array($value)) {
                $subject[$key] = self::recursiveReplace($search, $replace, $value);
			}
		}

        return $subject;
    }

    public function getModuleName()
    {
        $cmsPageId = Mage::getSingleton('cms/page')->getIdentifier();
        $homePageId = Mage::getStoreConfig('web/default/cms_home_page', Mage::app()->getStore()->getId());
        if ($cmsPageId === $homePageId) {
            return 'home';
        }
        switch (Mage::app()->getRequest()->getModuleName()) {
            case 'catalog':
                if (strcmp(Mage::app()->getRequest()->getControllerName(), 'category') == 0) {
					return 'category';
				} else {
					return 'product';
				}
                break;
            case 'checkout':
                if (strcmp(Mage::app()->getRequest()->getControllerName(), 'cart') == 0) {
                    return 'cart';
                } else {
                    return 'checkout';
                }
                break;
            case 'cms':
                return 'cms';
                break;
        }
        return null;
    }
}