<tr>
	<td class="bca-table-listup__tbody-td"><?php echo $data['MailStatusValue']['id'] ?></td>

	<td class="bca-table-listup__tbody-td">
		<?php
		if ($data['MailStatusValue']['id'] != 1) {
			$this->BcBaser->link($data['MailStatusValue']['name'], ['action' => 'edit', $data['MailStatusValue']['id']], ['escape' => true]);
		} else {
			$this->BcBaser->link($data['MailStatusValue']['name'], ['action' => 'edit', $data['MailStatusValue']['id']], ['escape' => true]);
			echo '（メール受信時デフォルトでステータスが設定されます）';
		}
		?>
	</td>

	<?php echo $this->BcListTable->dispatchShowRow($data) ?>

	<td class="bca-table-listup__tbody-td"><?php echo $this->BcTime->format('Y-m-d', $data['MailStatusValue']['created']); ?>
		<br />
		<?php echo $this->BcTime->format('Y-m-d', $data['MailStatusValue']['modified']); ?>
	</td>
	<td class="row-tools bca-table-listup__tbody-td bca-table-listup__tbody-td--actions">
		<?php $this->BcBaser->link('', ['action' => 'edit', $data['MailStatusValue']['id']], ['title' => __d('baser', '編集'), 'class' => 'bca-btn-icon', 'data-bca-btn-type' => 'edit', 'data-bca-btn-size' => 'lg']) ?>
		<?php if ($data['MailStatusValue']['id'] != 1) : ?>
			<?php $this->BcBaser->link('', ['action' => 'ajax_delete', $data['MailStatusValue']['id']], ['title' => __d('baser', '削除'), 'class' => 'btn-delete bca-btn-icon', 'data-bca-btn-type' => 'delete', 'data-bca-btn-size' => 'lg']) ?>
		<?php endif; ?>
	</td>
</tr>
