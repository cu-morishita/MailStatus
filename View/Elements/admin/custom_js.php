<script>
	$(function() {
		if ($('[name="data[MailStatusValue][color]"]').length) {
			$('[name="data[MailStatusValue][color]"]').each(function() {
				var color = $(this).val();
				$(this).closest('span').append('<span style="background: ' + color + ';margin-left: 10px;">　</span>');
			});
		}
	});
</script>
