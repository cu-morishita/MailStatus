<?php
$this->BcBaser->element('MailStatus.admin/custom_js');
?>
<?php echo $this->BcForm->create('MailStatusValue') ?>

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section">
	<table cellpadding="0" cellspacing="0" id="FormTable" class="form-table bca-form-table">
		<?php if ($this->action == 'admin_edit') : ?>
			<tr>
				<th class="col-head bca-form-table__label"><?php echo $this->BcForm->label('MailStatusValue.id', __d('baser', 'No')) ?></th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->value('MailStatusValue.id') ?>
					<?php echo $this->BcForm->input('MailStatusValue.id', ['type' => 'hidden']) ?>
				</td>
			</tr>
		<?php endif; ?>
		<tr>
			<th class="col-head bca-form-table__label"><?php echo $this->BcForm->label('MailStatusValue.name', __d('baser', 'メールステータス名')) ?>
				&nbsp;<span class="bca-label" data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span>
			</th>
			<td class="col-input bca-form-table__input">
				<?php echo $this->BcForm->input('MailStatusValue.name', ['type' => 'text', 'size' => 40, 'maxlength' => 255, 'autofocus' => true]) ?>
				<?php echo $this->BcForm->error('MailStatusValue.name') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head bca-form-table__label"><?php echo $this->BcForm->label('MailStatusValue.name', __d('baser', 'メールステータス名')) ?>
			</th>
			<td class="col-input bca-form-table__input">
				<?php echo $this->BcForm->input('MailStatusValue.color', ['type' => 'radio']) ?>
				<?php echo $this->BcForm->error('MailStatusValue.color') ?>
			</td>
		</tr>

		<?php echo $this->BcForm->dispatchAfterForm() ?>
	</table>
</div>

<?php echo $this->BcFormTable->dispatchAfter() ?>

<!-- button -->
<div class="submit bca-actions">
	<div class="bca-actions__main">
		<?php echo $this->BcForm->button(__d('baser', '保存'), [
			'div' => false, 'class' => 'button bca-btn bca-actions__item', 'id' => 'BtnSave',
			'data-bca-btn-type' => 'save',
			'data-bca-btn-size' => 'lg',
			'data-bca-btn-width' => 'lg',
		]) ?>
	</div>
	<?php if ($this->action == 'admin_edit' && $this->BcForm->value('MailStatusValue.id') != 1) : ?>
		<div class="bca-actions__sub">
			<?php
			$this->BcBaser->link(__d('baser', '削除'), ['action' => 'delete', $this->BcForm->value('MailStatusValue.id')], ['class' => 'submit-token button bca-btn bca-actions__item', 'data-bca-btn-type' => 'delete', 'data-bca-btn-size' => 'sm'], sprintf(__d('baser', '%s を本当に削除してもいいですか？'), $this->BcForm->value('MailStatusValue.name')), false);
			?>
		</div>
	<?php endif ?>
</div>

<?php echo $this->BcForm->end() ?>
