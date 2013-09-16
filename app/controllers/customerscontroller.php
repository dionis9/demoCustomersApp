<?php
namespace App\Controllers;

use App\Models\Customers;
use App\Models\States;

use Library\db;
/**
 * Customers controller.
 *
 * @author Dionis L. <github@dionis.me>
 */
class CustomersController extends \Library\Controller {
	/**
	 * Start page
	 */
	public function indexAction(){
		$states = new States();
		$statesJson = array();
		foreach($states->results as $state){
			$statesJson[$state['id']]=$state['name'];
		}

		return array(
			'customers'	=> new Customers(),
			'statesJson'	=> $statesJson,
		);
	}
	/**
	 * Add a new customer
	 */
	public function addAction(){
		$res = array('success'=>false);

		$db = new db();
		if($db->query("INSERT INTO `customers` (`name`,`states_id`,`email`)
			VALUES ('".$db->escape($_POST['name'])."',".intval($_POST['states_id']).",'".$db->escape($_POST['email'])."')")){
			$res['success']=true;
		}

		return array(
			'json'=>$res
		);
	}
	/**
	 * Edit customers data
	 */
	public function editAction(){
		$res = array('success'=>false);

		$db = new db();
		$q = "UPDATE `customers`
			SET `name`='".$db->escape($_POST['name'])."',
				`states_id`='".$db->escape($_POST['states_id'])."',
				`email`='".$db->escape($_POST['email'])."'
			WHERE `id`='".$db->escape($_POST['customers_id'])."'
			LIMIT 1;";
		if($db->query($q)){
			$res['success']=true;
		}

		return array(
			'json'=>$res
		);
	}
	/**
	 * Delete a customer
	 */
	public function deleteAction(){
		$res = array('success'=>false);
		$db = new db();
		$q = "DELETE FROM `customerbizstates` WHERE `customers_id`='".$db->escape($_POST['customers_id'])."';";
		if($db->query($q)){
			$q = "DELETE FROM `customers` WHERE `id`='".$db->escape($_POST['customers_id'])."' LIMIT 1;";
			if($db->query($q)){
				$res['success']=true;
			}
		}

		return array(
			'json'=>$res
		);
	}
}
?>
