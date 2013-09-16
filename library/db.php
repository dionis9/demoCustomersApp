<?php
namespace Library;
/**
 * A wrapper class for PHP class to access MySQL database written by slaout.
 *
 * @author Dionis L. <github@dionis.me>
 */
class db extends dbSlaout {
	/**
	 *
	 * @param string $dbalias Alias of desired db connection, which is used in config
	 */
	public function __construct($dbalias = 'default'){
		$dbConfig = App::getDBConfig($dbalias);
		parent::__construct($dbConfig['name'], $dbConfig['host'], $dbConfig['user'], $dbConfig['pass']);
	}

	/**
	 * Fetch a result row as an associative array
	 *
	 * @param type $result
	 * @return array Result row as an associative array
	 */
	public function fetchNextArray($result = NULL){
      if ($result == NULL)
        $result = $this->lastResult;

      if ($result == NULL || mysql_num_rows($result) < 1)
        return NULL;
      else
        return mysql_fetch_assoc($result);
    }

	/**
	 * Clean up a string before using it in a SQL statement
	 *
	 * @param string $unescaped_string
	 * @return string
	 */
	public function escape($unescaped_string=''){
		return mysql_real_escape_string($unescaped_string);
	}
}
?>
