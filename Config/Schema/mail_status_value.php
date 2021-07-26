<?php

class MailStatusValuesSchema extends CakeSchema
{

	public $name = 'MailStatusValue';
	public $file = 'mail_status_values.php';

	public function before($event = array())
	{
		return true;
	}

	public function after($event = array())
	{
	}

	public $mail_status_values = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 8, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'color' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
