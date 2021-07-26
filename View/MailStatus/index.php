<?php
$this->BcBaser->js([
	'admin/libs/jquery.baser_ajax_data_list',
	'admin/libs/jquery.baser_ajax_batch',
	'admin/libs/baser_ajax_data_list_config',
	'admin/libs/baser_ajax_batch_config'
]);
$this->BcAdmin->addAdminMainBodyHeaderLinks([
	'url' => ['action' => 'add'],
	'title' => __d('baser', '新規追加'),
]);
?>

<script type="text/javascript">
	$(function() {
		$.baserAjaxDataList.init();
		$.baserAjaxBatch.init({
			url: $("#AjaxBatchUrl").html()
		});
	});
</script>

<div id="AlertMessage" class="message" style="display:none"></div>
<div id="MessageBox" style="display:none">
	<div id="flashMessage" class="notice-message"></div>
</div>
<div id="DataList" class="bca-data-list"><?php $this->BcBaser->element('mail_status_values/index_list') ?></div>
