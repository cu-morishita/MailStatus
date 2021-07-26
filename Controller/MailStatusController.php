<?php

/**
 * [Controller] MailStatus
 *
 * @link https://yutori-shine.com/
 * @author ゆとり社員
 * @package MailStatus
 * @license MIT
 */
class MailStatusController extends BcPluginAppController
{
	public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure');

	/**
	 * モデル
	 *
	 * @var array
	 */
	public $uses = array('MailStatus.MailStatusValue', 'MailStatus.MailStatusMailMessage', 'Banner.BannerBreakpoint');


	public $pageTitle = 'キャッチアップリリースチェック';

	public $subMenuElements = array('cu_release_check');

	public $crumbs = array(
		array(
			'name' => 'プラグイン管理',
			'url' => array('admin' => true, 'plugin' => '', 'controller' => 'plugins', 'action' => 'index')
		),
		array(
			'name' => 'キャッチアップリリースチェック',
			'url'  => array('admin' => true, 'plugin' => 'cu_release_check', 'controller' => 'cu_release_check', 'action' => 'index'),
		)
	);

	function beforeFilter()
	{
		parent::beforeFilter();
	}

	/**
	 * [ADMIN] タグ一覧
	 *
	 * @return void
	 */
	public function admin_index()
	{
		$default = ['named' => ['num' => $this->siteConfigs['admin_list_num'], 'sort' => 'id', 'direction' => 'asc']];
		$this->setViewConditions('MailStatusValue', ['default' => $default]);

		$this->paginate = [
			'order' => 'MailStatusValue.id',
			'limit' => $this->passedArgs['num'],
			'recursive' => 0
		];
		$this->set('datas', $this->paginate('MailStatusValue'));

		$this->pageTitle = __d('baser', '受信メールステータス一覧');
	}

	/**
	 * [ADMIN] 受信メールステータス登録
	 *
	 * @return void
	 */
	public function admin_add()
	{
		if (!empty($this->request->data)) {
			$this->MailStatusValue->create($this->request->data);
			if ($this->MailStatusValue->save()) {
				$this->BcMessage->setSuccess(sprintf(__d('baser', 'メールステータス「%s」を追加しました。'), $this->request->data['MailStatusValue']['name']));
				$this->redirect(['action' => 'index']);
			} else {
				$this->BcMessage->setError(__d('baser', 'エラーが発生しました。内容を確認してください。'));
			}
		}

		$this->set('colors', Configure::read('MailStatus.colors'));
		$this->pageTitle = __d('baser', '新規受信メールステータス登録');
		$this->render('form');
	}

	/**
	 * [ADMIN] 受信メールステータス編集
	 *
	 * @param int $id タグID
	 * @return void
	 */
	public function admin_edit($id)
	{
		if (!$id) {
			$this->BcMessage->setError(__d('baser', '無効な処理です。'));
			$this->redirect(['action' => 'index']);
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->MailStatusValue->read(null, $id);
		} else {
			$this->MailStatusValue->set($this->request->data);
			if ($this->MailStatusValue->save()) {
				$this->BcMessage->setSuccess(sprintf(__d('baser', 'メールステータス「%s」を更新しました。'), $this->request->data['MailStatusValue']['name']));
				$this->redirect(['action' => 'index']);
			} else {
				$this->BcMessage->setError(__d('baser', 'エラーが発生しました。内容を確認してください。'));
			}
		}

		$this->set('colors', Configure::read('MailStatus.colors'));
		$this->pageTitle = __d('baser', '受信メールステータス編集');
		$this->render('form');
	}

	public function admin_change_status($mailContentId, $mailMessageId)
	{
		if ($this->request->data) {
			$this->MailStatusMailMessage->deleteAll([
				'MailStatusMailMessage.mail_content_id' => $mailContentId,
				'MailStatusMailMessage.mail_message_id' => $mailMessageId,
			]);
			$data['MailStatusMailMessage'] = [
				'mail_status_value_id' => $this->request->data['MailStatusMailMessage']['mail_status_value_id'],
				'mail_content_id' => $mailContentId,
				'mail_message_id' => $mailMessageId,
				'note' => $this->request->data['MailStatusMailMessage']['note'],
			];
			$this->MailStatusMailMessage->create($data);
			$this->MailStatusMailMessage->save($data);
		} else {
			$this->BcMessage->setError(__d('baser', 'データベース処理中にエラーが発生しました。'));
		}


		$this->redirect([
			'plugin' => 'mail',
			'controller' => 'mail_messages',
			'action' => 'index', $mailContentId
		]);
	}


	/**
	 * [ADMIN] 削除処理
	 *
	 * @param int $id
	 * @return void
	 */
	public function admin_delete($id = null)
	{
		$this->_checkSubmitToken();
		if (!$id) {
			$this->BcMessage->setError(__d('baser', '無効な処理です。'));
			$this->redirect(['action' => 'index']);
		}

		$data = $this->MailStatusValue->read(null, $id);

		if ($this->MailStatusValue->delete($id)) {
			$this->BcMessage->setSuccess(sprintf(__d('baser', 'タグ「%s」を削除しました。'), $this->MailStatusValue->data['MailStatusValue']['name']));
		} else {
			$this->BcMessage->setError(__d('baser', 'データベース処理中にエラーが発生しました。'));
		}

		$this->redirect(['action' => 'index']);
	}

	/**
	 * [ADMIN] 削除処理　(ajax)
	 *
	 * @param int $id
	 * @return void
	 */
	public function admin_ajax_delete($id = null)
	{
		$this->_checkSubmitToken();
		if (!$id) {
			$this->ajaxError(500, __d('baser', '無効な処理です。'));
		}

		$data = $this->MailStatusValue->read(null, $id);
		if ($this->MailStatusValue->delete($id)) {
			$message = sprintf(__d('baser', 'タグ「%s」を削除しました。'), $this->MailStatusValue->data['MailStatusValue']['name']);
			$this->MailStatusValue->saveDbLog($message);
			exit(true);
		}
		exit();
	}

	// public function admin_all_check() {
	// 	// テスト実行
	// 	$messageList = [];
	// 	$result = true;

	// 	$testList = $this->CuReleaseCheck->getTests();
	// 	foreach($testList as $name => $targetObj) {
	// 		$targetObj->test();
	// 		if (!$targetObj->getResult()) {
	// 			$result = false;

	// 			$message = $targetObj->getMessage();
	// 			if (!is_array($message)) $message = array($message);
	// 			$messageList = $messageList + $message;
	// 		}

	// 	}
	// 	$this->setMessage("全てのテストを実行しました");

	// 	$this->set("targetTest", $targetObj);
	// 	$this->set("result", $result);
	// 	$this->set("messages", $messageList);

	// 	$this->pageTitle = 'チェック';
	// 	$this->set("testList", $testList);
	// 	$this->render("index");
	// }

}
