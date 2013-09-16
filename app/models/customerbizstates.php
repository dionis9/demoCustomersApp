<?php
namespace App\Models;
use Library\db;
/**
 * This model includes all states where a customer makes business in
 *
 * @author Dionis L. <github@dionis.me>
 */
class CustomerBizStates {
	/** @var array All data of the modul is saved here */
	public $results = array();
	/** @var int Number of found rows */
	public $totalnum = 0;
	/**
	 * Selects all the data for a customer
	 *
	 * @param array $settings Here you should pass some parametars like the customers_id
	 */
	public function __construct(array $settings = array()){
		$db = new db();
		// select all customers
		$q = "SELECT ".(isset($settings['limit']) ? 'SQL_CALC_FOUND_ROWS':'')."
				c.`id` as `customers_id`,s.`states_id`
			FROM `customers` c
			LEFT JOIN `customerbizstates` s on(s.`customers_id`=c.`id`)
			".(isset($settings['customers_id'])
				? 'WHERE c.`id`='.intval($settings['customers_id'])
				: ''
			);
		$dbres = $db->query($q);
		while($row = $db->fetchNextArray($dbres)){
			$this->results[] = $row;
		}
		if(isset($settings['limit'])){
			// select total number of cusomers
			$q = "SELECT FOUND_ROWS() as FRows;";
			$dbres = $db->query($q);
			$row = $db->fetchNextArray($dbres);
			if(isset($row['FRows'])){
				$this->totalnum = $row['FRows'];
			}
		}
		else {
			$this->totalnum = count($this->results);
		}
	}
}
?>