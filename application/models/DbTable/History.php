<?php

class Application_Model_DbTable_History extends Zend_Db_Table_Abstract
{

    protected $_name = 'history';

    public function getHistories()
    {
        $oSelect = $this->select();
      	$oSelect->setIntegrityCheck(false);
      	$oSelect->from('history');
		$oSelect->order('history_id DESC');
		$oSelect->limit(5);
    	
    	return $this->fetchAll($oSelect)->toArray();
    }

    public function addHistory($aHistory)
    {
        $this->insert($aHistory);
    }
}

