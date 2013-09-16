<?php
namespace App\Controllers;

use App\Models\CustomerBizStates;

use Library\db;
/**
 * Business states controller.
 *
 * @author Dionis L. <github@dionis.me>
 */
class BizstatesController extends \Library\Controller {
	/**
	 * Load states customer is doing business in
	 *
	 * @return array JSON with states
	 */
	public function loadAction(){
		$cbs = new CustomerBizStates(array(
			'customers_id'=>$_POST['customers_id']
		));
		$json = array(
			'customers_id'=>$_POST['customers_id'],
			'states'=>array()
		);
		foreach($cbs->results as $row){
			$json['states'][$row['states_id']]=true;
		}
		return array(
			'json'=>$json
		);
	}
	/**
	 * Save states customer is doing business in
	 *
	 * @return array JSON with success status
	 */
	public function saveAction(){
		$res = array('success'=>false);

		$db = new db();
		if($db->query("DELETE FROM `customerbizstates` WHERE `customers_id`=".intval($_POST['customers_id'])))
			$res['success']=true;

		if(isset($_POST['states'])){
			$qValues = array();
			foreach($_POST['states'] as $state_id => $value){
				$qValues[] = "(".intval($_POST['customers_id']).",".intval($state_id).")";
			}
			if(count($qValues)>0){
				$q = "INSERT INTO `customerbizstates` (`customers_id`,`states_id`) VALUES ".implode(',',$qValues).";";
				if(!$db->query($q)){
					$res['success']=false;
				}
			}
		}

		return array(
			'json'=>$res
		);
	}
}
?>
