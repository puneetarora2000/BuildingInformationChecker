<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="<?php echo uniqid(); ?>">
	<thead>
		<tr>
			<th class="text-center">Actions</th>
			<?php foreach($columns as $column){
				if($column == 'user_id') {
					continue;
				}?>
				<th class="text-center"><?php echo str_replace('_',' ',ucwords($column,'_')); ?></th>
			<?php }?>
			
		</tr>
	</thead>
	<tbody>
		<?php 
		$num_row = 1;
		foreach($list as $row){ ?>
		<tr id='row-<?php echo $num_row?>'>
		<td>
			<a target="_blank" href="<?php echo base_url('admin/inspections/index').'/'.$row->user_id;?>" style="font-size:12px !important; color: white; padding: 2px !important;" class="edit_button btn btn-success" role="button">View Report</a>
		</td>
			<?php
				 foreach($row as $key => $val){
				 	if($key == 'user_id') {
						continue;
					}
				?>
				<td><?php echo $val; ?></td>
			<?php
				 }?>
			
		</tr>
		<?php 
		$num_row++;
		}?>
	</tbody>
	<tfoot>
		
	</tfoot>
</table>
