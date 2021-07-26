<?php
$MailStatusValueModel = ClassRegistry::init('MailStatus.MailStatusValue');
$MailStatusValues = $MailStatusValueModel->find('list', [
	'fields' => ['id', 'name']
]);
?>
<!-- view -->
<table style="display: none;" cellpadding="0" cellspacing="0" class="list-table bca-form-table" id="mailStatus">
	<?php echo $this->BcForm->create('MailStatusMailMessage', ['url' => ['plugin' => 'mail_status', 'controller' => 'mail_status', 'action' => 'change_status', $mailContent['MailContent']['id'], $message['MailMessage']['id']]]) ?>
	<tr>
		<th class="col-head bca-form-table__label"><?php echo __d('baser', 'ステータス') ?></th>
		<td class="col-input bca-form-table__input">
			<?php echo $this->BcForm->input('MailStatusMailMessage.mail_status_value_id', ['type' => 'select', 'options' => $MailStatusValues, 'empty' => __d('baser', 'なし')]) ?>
		</td>
	</tr>
	<tr>
		<th class="col-head bca-form-table__label"><?php echo __d('baser', '備考') ?></th>
		<td class="col-input bca-form-table__input">
			<?php echo $this->BcForm->input('MailStatusMailMessage.note', ['type' => 'textarea']) ?>
		</td>
	</tr>
	<tr>
		<th class="col-head bca-form-table__label"></th>
		<td class="col-input bca-form-table__input">
			<?php echo $this->BcForm->button(__d('baser', '保存'), [
				'div' => false, 'class' => 'button bca-btn bca-actions__item', 'id' => 'BtnSave',
				'data-bca-btn-type' => 'save',
			]) ?>
		</td>
	</tr>
	<?php echo $this->BcForm->end() ?>
</table>
<script type="text/javascript">
	$(function() {
		var statusElement = $('#mailStatus');
		var messageElement = $('#ListTable');
		messageElement.after(statusElement.show());
	});
</script>
