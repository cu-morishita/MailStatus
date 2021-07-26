<?php

/**
 * [HelperEventListener] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusHelperEventListener extends BcHelperEventListener
{
	public $allowController = [
		'mail_messages',
	];

	public $events = array(
		'BcListTable.showHead',
	);

	/**
	 * フォーム閉じタグ取得後イベント
	 *
	 * @param CakeEvent $event
	 * @return string
	 */
	public function bcListTableShowHead(CakeEvent $event)
	{
		if (!BcUtil::isAdminSystem()) {
			return $event->data['out'];
		}

		$View = $event->subject();

		if (!in_array($View->request->params['controller'], $this->allowController)) {
			return;
		}

		echo $View->element('MailStatus.mail_massage_status');

		return $event->data['out'];
	}
}
