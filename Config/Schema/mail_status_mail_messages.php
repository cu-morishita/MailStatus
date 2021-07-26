<?php

class MailStatusMailMessagesSchema extends CakeSchema
{

	public $name = 'MailStatusMailMessage';

	public $file = 'mail_status_mail_messages.php';

	public function before($event = [])
	{
		return true;
	}

	public function after($event = [])
	{
	}

	public $blog_posts_blog_tags = [
		'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'],
		'mail_message_id' => ['type' => 'integer', 'null' => true, 'length' => 8],
		'mail_status_value_id' => ['type' => 'integer', 'null' => true, 'length' => 8],
		'mail_content_id' => ['type' => 'integer', 'null' => true, 'length' => 8],
		'note' => ['type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'],
		'created' => ['type' => 'datetime', 'null' => true, 'default' => null],
		'modified' => ['type' => 'datetime', 'null' => true, 'default' => null],
		'indexes' => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
		'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci']
	];
}
