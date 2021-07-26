<?php

/**
 * [ModelEventListener] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusModelEventListener extends BcModelEventListener
{

	public $events = [
		'MailMessage.beforeFind',
		'MailMessage.afterFind',
		'Mail.MailMessage.afterSave',
	];

	/**
	 * 受信一覧のモデル名: 受信一覧は動的に切り替わるため定義
	 *
	 * @var string
	 */
	private $modelName = 'MailMessage';


	/**
	 * messageBeforeFind
	 * - 受信一覧に検索条件を付与する
	 *
	 * @param CakeEvent $event
	 */
	public function mailMessageBeforeFind(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			$objRequest = Router::getRequest();
			if (!MailStatusUtil::hasMailStatus()) {
				return;
			}
			if (!in_array($objRequest->params['controller'], ['mail_messages'], true)) {
				return $event->data;
			}
			if (!in_array($objRequest->params['action'], ['admin_index'], true)) {
				return $event->data;
			}

			$conditions = [];
			$MailStatusMailMessage = ClassRegistry::init('MailStatus.MailStatusMailMessage');
			if ($objRequest['data']['MailStatusMailMessage']) {
				$ids = $MailStatusMailMessage->find('all', [
					'conditions' => [
						'MailStatusMailMessage.mail_status_value_id' => $objRequest['data']['MailStatusMailMessage']['mail_status_value_id']
					]
				]);
				$categoryPostIds = Hash::extract($ids, '{n}.MailStatusMailMessage.mail_message_id');
				$conditions[] = [
					$this->modelName . '.id' => $categoryPostIds,
				];
			}
			if (!empty($event->data[0]['conditions'])) {
				$event->data[0]['conditions'] = Hash::merge($event->data[0]['conditions'], $conditions);
			} else {
				$event->data[0]['conditions'] = $conditions;
			}
		}

		return $event->data;
	}

	/**
	 * messageBeforeFind
	 * - 受信一覧に検索条件を付与する
	 *
	 * @param CakeEvent $event
	 */
	public function mailMessageAfterFind(CakeEvent $event)
	{
		$params = Router::getParams();
		$MailStatusMailMessage = ClassRegistry::init('MailStatus.MailStatusMailMessage');

		foreach ($event->data[0] as $key => $data) {
			$mailStatus = $MailStatusMailMessage->find('first', [
				'conditions' => [
					'MailStatusMailMessage.mail_message_id' => $data['MailMessage']['id'],
					'MailStatusMailMessage.mail_content_id' => $params['Content']['entity_id'],
				]
			]);
			if ($mailStatus) {
				if ($params['action'] == 'admin_index') {
					$event->data[0][$key]['MailStatusValue'] = $mailStatus['MailStatusValue'];
				} else {
					$event->data[0][$key]['MailStatusMailMessage'] = $mailStatus['MailStatusMailMessage'];
				}
			}
		}

		return $event->data;
	}
}
