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
			<a href="<?php echo base_url('admin/seedproducers/doblacklist/edit').'/'.$row->user_id;?>" style="font-size:12px !important; color: white; padding: 2px !important;" class="edit_button btn btn-success" role="button">Blacklist</a>
		</td>
			<?php
				 foreach($row as $key => $val){
				 	if($key == 'user_id') {
						continue;
					}
					if($key == 'blacklisted')
					{
						if($val == 1){
							echo '<td>Yes</td>';
							continue;
						} else {
							echo '<td>No</td>';
							continue;
						}

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
