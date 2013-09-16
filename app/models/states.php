<?php
namespace App\Models;
use Library\db;
/**
 * This model includes all states
 *
 * @author Dionis L. <github@dionis.me>
 */
class States {
	/** @var array All data of the modul is saved here */
	public $results = array();
	/** @var int Number of found rows */
	public $totalnum = 0;
	/**
	 * Selects all states
	 */
	public function __construct(){
		$db = new db();
		$dbres = $db->query("SELECT `id`,`name` FROM `states`");
		while($row = $db->fetchNextArray($dbres)){
			$this->results[] = $row;
		}
		$this->totalnum = count($this->results);
	}
}
?>