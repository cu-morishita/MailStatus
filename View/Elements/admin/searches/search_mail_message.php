<?php
$MailStatusValueModel = ClassRegistry::init('MailStatus.MailStatusValue');
$MailStatusValues = $MailStatusValueModel->find('list', [
	'fields' => array('MailStatusValue.id', 'MailStatusValue.name'),
]);
?>
<?php echo $this->BcForm->create('MailMessage', ['url' => ['action' => 'index', $mailContent['MailContent']['id']]]) ?>
<p class="bca-search__input-list">
	<span class="bca-search__input-item">
		<?php echo $this->BcForm->input('MailStatusMailMessage.mail_status_value_id', ['type' => 'select', 'options' => $MailStatusValues, 'empty' => '指定なし']) ?>
		<?php echo $this->BcForm->error('MailStatusMailMessage.mail_status_value_id') ?>
	</span>
	<?php echo $this->BcSearchBox->dispatchShowField() ?>
</p>
<div class="button bca-search__btns submit">
	<?php if ($siteConfig['admin_theme']) : ?>
		<div class="bca-search__btns-item"><?php $this->BcBaser->link(__d('baser', '検索'), "javascript:void(0)", ['id' => 'BtnSearchSubmit', 'class' => 'bca-btn', 'data-bca-btn-type' => 'search']) ?></div>
		<div class="bca-search__btns-item"><?php $this->BcBaser->link(__d('baser', 'クリア'), "javascript:void(0)", ['id' => 'BtnSearchClear', 'class' => 'bca-btn', 'data-bca-btn-type' => 'clear']) ?></div>
	<?php else : ?>
		<?php echo $this->BcForm->button(__d('baser', '検索'), ['class' => 'button', 'id' => 'BtnSearchSubmit']) ?>
		<?php echo $this->BcForm->button(__d('baser', 'クリア'), ['class' => 'button', 'id' => 'BtnSearchClear']) ?>
	<?php endif; ?>
</div>
<?php echo $this->BcForm->end() ?>
