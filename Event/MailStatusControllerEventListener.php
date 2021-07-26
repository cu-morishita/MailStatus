<?php

/**
 * [ControllerEventListener] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusControllerEventListener extends BcControllerEventListener
{

	public $events = [
		'Mail.MailMessages.startup',
		'Mail.MailMessages.beforeRender',
	];

	/**
	 * mailMailMessagesStartup
	 * - セッションに保存された検索条件は、どのフォームの受信一覧画面でも共通で利用されるため、共通利用されるセッションの検索条件にフォーム別の検索条件を設定する
	 *
	 * @param CakeEvent $event
	 */
	public function mailMailMessagesStartup(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			$filter = [];
			$Controller = $event->subject();
			if ($Controller->Session->check("Baser.viewConditions.MailMessagesAdminIndex.filter.MailMessage" . $Controller->mailContent['MailContent']['id'])) {
				$filter = $Controller->Session->read("Baser.viewConditions.MailMessagesAdminIndex.filter.MailMessage" . $Controller->mailContent['MailContent']['id']);
			}
			// セッションに保存された検索条件は、どのフォームの受信一覧画面でも共通で利用されるため、共通利用されるセッションの検索条件にフォーム別の検索条件を設定する
			$Controller->Session->write("Baser.viewConditions.MailMessagesAdminIndex.filter.MailMessage", $filter);
		}
	}

	/**
	 * mailMailMessagesBeforeRender
	 * - 受信一覧画面で検索ボックスを表示させる
	 *
	 * @param CakeEvent $event
	 */
	public function mailMailMessagesBeforeRender(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			$Controller = $event->subject();
			if (in_array($Controller->request->params['action'], ['admin_index'], true)) {
				$Controller->search = 'search_mail_message';
				// フォーム別の検索条件をセッションに保存する
				$Controller->Session->write("Baser.viewConditions.MailMessagesAdminIndex.filter.MailMessage" . $Controller->mailContent['MailContent']['id'], $Controller->request->data('MailStatusMailMessage'));
			}
		}
	}
}
