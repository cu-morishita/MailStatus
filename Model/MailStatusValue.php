<?php

/**
 * [Model] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusvalue extends AppModel
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
	public $name = 'MailStatusValue';

	/**
	 * MailStatusValue constructor.
	 *
	 * @param bool $id
	 * @param null $table
	 * @param null $ds
	 */
	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);
		$this->validate = [
			'name' => [
				['rule' => ['notBlank'], 'message' => __d('baser', 'ステータスを入力してください。'), 'required' => true],
				['rule' => ['maxLength', 255], 'message' => __d('baser', 'ステータスは255文字以内で入力してください。')],
				['rule' => ['duplicate', 'name'], 'message' => __d('baser', '既に登録のある受信ステータスです。')]
			],
		];
	}
}
