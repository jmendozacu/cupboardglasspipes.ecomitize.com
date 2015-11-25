<?php

class Codetildawn_Licensemanager_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	
	// Check Extension Status in Licenemanager DB table.
	public function getExtensionStatus($moduleName){
	
		$active = FALSE;

		$resource = Mage::getSingleton('core/resource');
		$tableName = $resource->getTableName('licensemanager');
		$tableExist = $resource->getConnection('core_write')->isTableExists($tableName);

		if(!$tableExist){
			$warnMessages = array();
			$warnMessages = Mage::getSingleton('core/session')->getWarningMessages();
			$warnMessages['Codetildawn_Licensemanager'] = 'License Manager Table is not Exist. Please contact to Extension Admin. License Manager Extension is not installed properly.';
			Mage::getSingleton('core/session')->setWarningMessages($warnMessages);
			return $active;
		}
		
		$collection = Mage::getModel('licensemanager/licensemanager')->getCollection()->addFieldToFilter('module',$moduleName);
		if(count($collection) > 0){
			$item = $collection->getFirstItem();
			$active = ($item->getStatus() == 'active') ? TRUE : FALSE;
		}

		return $active;
	}
	
	// Return Active/Expired Image for System Configuration.
	public function getExtensionStatusHtml($moduleName){
		
		$active = $this->getExtensionStatus($moduleName);
		
		if($active)	{
			$imageHtml = '<img src="'.Mage::getDesign()->getSkinUrl('codetildawn/images/active-icon.png').'" alt="Active License" title="Active License" />';
		} else {
			$imageHtml = '<img src="'.Mage::getDesign()->getSkinUrl('codetildawn/images/expire-icon.gif').'" alt="Expired License" title="Expired License" />';
		}
		
		return $imageHtml;
	}

	// API call to check Extension's License is Active/Expired on Codetildawn Server.
	public function checkExtensionVersion($fields) {
		
		$status = 'active';
		$resource = Mage::getSingleton('core/resource');
		$tableName = $resource->getTableName('licensemanager');
		$tableExist = $resource->getConnection('core_write')->isTableExists($tableName);

		if(!$tableExist){
			$warnMessages = array();
			$warnMessages = Mage::getSingleton('core/session')->getWarningMessages();
			$warnMessages['Codetildawn_Licensemanager'] = 'License Manager Table is not Exist. Please contact to Extension Admin. License Manager Extension is not installed properly.';
			Mage::getSingleton('core/session')->setWarningMessages($warnMessages);
			return $status;
		}
		
		// Perform Lincense Check Action
		$request_url = 'http://codetildawn.com/shop/shell/checkExtension.php';
		
		$ch = curl_init();
		
		$postvars = '';
		foreach($fields as $key=>$value) {
			$postvars.= $key . "=" . $value . "&";
		}
		
		curl_setopt($ch,CURLOPT_URL,$request_url);
		curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		$response = curl_exec($ch);
		
		curl_close ($ch);
		if($response){
			Mage::log('License Check : '.$response, null, 'cdt_licensemanager.log');
			$status = $this->updateRelativeExtension($response,$fields);
		} else {
			Mage::log('License Check : Empty Reponse', null, 'cdt_licensemanager.log');
		}
		
		return $status;
		
	}	
	
	// Update current system DB table for installed Codetildawn Extensions.
	public function updateRelativeExtension($response,$fields){
		
		$status = 'active';
		$currentDate = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
		
		$resultData = json_decode($response);
		if($resultData->status != ''){
			$responseData = array();
			$responseData['module'] 	= $fields['module'];
			$responseData['license'] 	= $fields['license'];
			$responseData['last_check'] = $currentDate;
			$responseData['mode'] 		= $resultData->mode;
			$responseData['status'] 	= $resultData->status;
			$responseData['expiry_date'] = $resultData->expiry_date;
			
			$status = $resultData->status;

			$collection = Mage::getModel('licensemanager/licensemanager')->getCollection()->addFieldToFilter('module',$fields['module']);
			if(count($collection) > 0){
				$item = $collection->getFirstItem();
				$licenseRow = Mage::getModel('licensemanager/licensemanager')->load($item->getId());	
				$licenseRow->setLicense($responseData['license']);
				$licenseRow->setMode($responseData['mode']);
				$licenseRow->setStatus($responseData['status']);
				$licenseRow->setExpiryDate($responseData['expiry_date']);
				$licenseRow->setLastCheck($responseData['last_check']);
			} else {
				$licenseRow = Mage::getModel('licensemanager/licensemanager');
				$licenseRow->setData($responseData);
			}

			try{
				$licenseRow->save();	
			} catch (exception $e){
				Mage::log('License Update Error : '.$e->getMessage(),null,'cdt_licensemanager.log');
			}

			$warnMessages = array();
			$warnMessages = Mage::getSingleton('core/session')->getWarningMessages();
			
			$date1 = strtotime($responseData['expiry_date']);
			$date2 = strtotime(date("Y-m-d", strtotime($currentDate)));
			$dateDiff = $date1 - $date2;
			$fullDays = floor($dateDiff/(60*60*24));
			
			if($fullDays > 0 && $fullDays <= 7){
				$warnMessages[$fields['module']] = ' Your Extension License is going to expire in '.$fullDays.' Days. Please contact to Codetildawn Store. Go to "System >> Configuration >> Codetildawn Modules >> License Manager"';
			} else if($fullDays > 7){
				$warnMessages[$fields['module']] = '';
			} else if($fullDays <= 0){
				$warnMessages[$fields['module']] = ' Your extension License is expired. Please contact to Codetildawn Store. Go to "System >> Configuration >> Codetildawn Modules >> License Manager"';
			}
			Mage::getSingleton('core/session')->setWarningMessages($warnMessages);
			
		}
		
		return $status;
		
	}
	
	
}