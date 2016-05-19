<?php
	$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);

	$this->load_js_jqueryui();
?>
<div>
	
</div>

<div class="flexigrid" style='width: 100%;' data-unique-hash="<?php echo $unique_hash; ?>">
	
	<div id='main-table-box' class="main-table-box">


	<div id='ajax_list' class="ajax_list">
		<?php echo $list_view?>
	</div>
	<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>

	
	<?php echo form_close(); ?>
	</div>
</div>
