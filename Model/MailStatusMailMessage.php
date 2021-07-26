<?php

/**
 * [モデル] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusMailMessage extends AppModel
{
	/**
	 * プラグイン名
	 *
	 * @var string
	 */
	public $plugin = 'MailStatus';

	/**
	 * モデル名
	 *
	 * @var string
	 */
	public $name = 'MailStatusMailMessage';

	public $belongsTo = array(
		'MailStatusValue' => array(
			'className' => 'MailStatus.MailStatusValue',
			'foreignKey' => 'mail_status_value_id'
		)
	);
}
