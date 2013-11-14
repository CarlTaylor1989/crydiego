<style>
	.iron-importer {
		position: relative;
	}
	.iron-importer .loader{
		display:none;
		position:absolute;
		background-image:url(<?php echo IRON_PARENT_URL; ?>/admin/assets/img/ajax-loader.gif);
		background-repeat:no-repeat;
		width:31px;
		height:31px;
		top: -4px;
		left: 145px;
	}
	.iron-importer .status{
		display:none;
		border:1px solid #ddd;
		padding:20px;
		margin-top:15px;
	}
	.iron-importer .status.error{
		border:1px solid red;
	}
	.iron-importer .status.success{
		border:1px solid green;
	}
</style>
<script>
	var iron_refresh_page = window.iron_refresh_page || false;

	jQuery(function($) {

		$('#iron-importer').click(function(e) {
			e.preventDefault();

			var $this = $(this);

			if ( iron_refresh_page ) {
				window.location.reload(true);
				return;
			}

			if ( ! confirm("Attention: This will flush all posts, post metas, comments, links in your actual DB before importing. Are you sure you want to continue?") )
				return -1;

			var postData = { action: 'iron_import_default_data' };
			var loader   = $('#iron-importer-loader');
			var status   = $('#iron-importer-status');

			loader.fadeIn();
			status.html('<p><strong>Flushing Current Data ... </strong></p>').fadeIn();

			$.ajax({
				url      : ajaxurl,
				data     : postData,
				type     : 'post',
				dataType : 'json',
				success  : function (data) {

					status.append(data.msg);

					if ( data.error )
					{
						status.removeClass('success');
						status.addClass('error');
						loader.fadeOut();

					} else {

						status.removeClass('error');
						status.addClass('success');

						status.append('<hr><p><strong>Assigning Pages To Template...</strong></p>');

						postData = { action: 'iron_import_assign_templates' };

						$.ajax({
							url      : ajaxurl,
							data     : postData,
							type     : 'POST',
							dataType : 'json',
							success  : function (data) {

								status.append(data.msg);

								if ( data.error )
								{
									status.removeClass('success');
									status.addClass('error');
								}

								$this.addClass('button-primary').val('Reload Page');
								iron_refresh_page = true;

								loader.fadeOut();
							}
						});

					}


				}
			});
		});
	});
</script>


<div class="iron-importer">
	<input id="iron-importer" type="button" class="button" value="Import Default Data">
	<div id="iron-importer-loader" class="loader"></div>
	<div id="iron-importer-status" class="status"></div>
</div>

