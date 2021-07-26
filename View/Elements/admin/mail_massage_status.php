<script type="text/javascript">
	$(function() {
		$('.bca-table-listup__thead').find('tr').append($('.mail_status_th').attr('style', ''));
		<?php foreach ($messages as $key => $data) : ?>
			$('#Row<?php echo h($key + 1) ?>').append($('.mail_status_td<?php echo h($key + 1) ?>').attr('style', ''));
			<?php if ($data['MailStatusValue']) : ?>
				$('#Row<?php echo h($key + 1) ?>').css('background-color', "<?php echo h($data['MailStatusValue']['color']); ?>")
			<?php endif ?>
		<?php endforeach; ?>
	});
</script>

<th class="bca-table-listup__thead-th mail_status_th" style="display:none;">ステータス</th>
<?php foreach ($messages as $key => $data) : ?>
	<?php if ($data['MailStatusValue']) : ?>
		<td class="row-tools bca-table-listup__tbody-td mail_status_td<?php echo h($key + 1) ?>" style="display:none;">
			<?php echo $data['MailStatusValue']['name'] ?>
		</td>
	<?php else : ?>
		<td class="row-tools bca-table-listup__tbody-td mail_status_td<?php echo h($key + 1) ?>" style="display:none;">
		</td>
	<?php endif ?>
<?php endforeach ?>
