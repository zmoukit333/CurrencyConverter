<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$oHistory = new Application_Model_DbTable_History();
		$aHistories = $oHistory ->getHistories();
		
		$this->view->aHistories = $aHistories;
    }
    
    public function convertAction()
    {
	    $this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(TRUE);
		
		$request 	= $this->getRequest();
		$aData  	= $request->getParam('formDataObject');
		$aData 		= json_decode(stripslashes($aData), true);
		
		$amount = $aData['amount'];
		$from 	= $aData['from'];
		$to 	= $aData['to'];
		
    	$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
	    $data = file_get_contents($url);

	    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		
		if(empty($converted)){
			$status = 'Faild';
		}else{
			$status = 'OK';
			$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
			
			$oHistory = new Application_Model_DbTable_History();
			
			$aHistory = array(
				'history_amount'		=> $amount,
				'history_from_currency'	=> $from,
				'history_to_currency'	=> $to,
				'history_result' 		=> $converted
			);
			
			$oHistory->insert($aHistory);
		}

		$aResponse = array(
			'from'		=> $from,
			'to'		=> $to,
			'amount'	=> $amount,
			'result' 	=> $converted,
			'status'	=> $status
		);

		$jsonData = Zend_Json::encode($aResponse);
		$this->getResponse()->appendBody($jsonData);
    }
}







