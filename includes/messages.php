<?php
require_once(LIB_PATH.DS.'database.php');

class Messages extends DatabaseObject {
	protected static $table_name = "message";
	protected static $db_fields = array('id', 'msisdn', 'text', 'rrn');
	
	public $id;
	public $msisdn;
	public $text;
	public $rrn;
}
?>