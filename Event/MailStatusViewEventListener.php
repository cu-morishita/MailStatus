<?php

/**
 * [ViewEventListener] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusViewEventListener extends BcViewEventListener
{

	public $events = [
		'Mail.MailMessages.beforeGetElementFileName',
		'Mail.MailMessages.beforeGetViewFileName',
		'footer'
	];

	/**
	 * mailMailMessagesbeforeGetElementFileName
	 * - 受信一覧画面の検索ボックスの内容を、プラグイン側のエレメントと入れ替える
	 * - SimpleSearchMailMessageControllerEventListener 側で検索用エレメントの定義が存在する場合をトリガーとする
	 *
	 * @param CakeEvent $event
	 */
	public function mailMailMessagesBeforeGetElementFileName(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			if ($event->data['name'] === 'searches/search_mail_message') {
				$event->data['name'] = 'MailStatus.searches/search_mail_message';
			}
		}
	}

	/**
	 * mailMailMessagesBeforeGetViewFileName
	 * - 受信一覧画面での検索動作の場合、admin/index のViewファイルのままではイベントループに陥る
	 * 　ajax 処理（検索動作）時には、ajax_index 側にViewファイルを切替えることで回避する
	 *
	 * @param CakeEvent $event
	 * @return string
	 */
	public function mailMailMessagesBeforeGetViewFileName(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			$View = $event->subject();

			if ($View->request->params['isAjax'] || !empty($View->request->query['ajax'])) {
				if ($event->data['name'] === 'index') {
					$event->data['name'] = 'ajax_index';
				}
			}
		}
	}

	public function footer(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			$View = $event->subject();

			if ($View->request->params['controller'] == 'mail_messages' && $View->request->params['action'] == 'admin_view') {
				$event->data['out'] .= $View->element('MailStatus.admin/footer_style');
			}
		}
	}
}
