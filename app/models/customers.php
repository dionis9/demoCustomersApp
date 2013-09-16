<?php
namespace App\Models;
use Library\db;
/**
 * This model includes all customers
 *
 * @author Dionis L. <github@dionis.me>
 */
class Customers {
	/** @var array All data of the modul is saved here */
	public $results = array();
	/** @var int Number of found rows */
	public $totalnum = 0;
	/**
	 * Selects all the data about a customer
	 *
	 * @param array $settings Here you can pass some parametars like the limit
	 */
	public function __construct(array $settings = array()){
		$db = new db();
		// select all customers
		$q = "SELECT ".(isset($settings['limit']) ? 'SQL_CALC_FOUND_ROWS':'')."
				c.`id`,c.`name`,c.`states_id`,s.`name` `state`,c.`email`
			FROM `customers` c
			LEFT JOIN `states` s on(s.`id`=c.`states_id`)";
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