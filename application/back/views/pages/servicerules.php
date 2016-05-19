<?php // var_dump($rules); ?>
<div class="content">	


			<h2>Service Rules</h2>

<div class="panel panel-default">
	<div class="panel-body">
		<table class="table">
			<tbody>
			<?php foreach ($rules as $rule):?>
				
				<tr align="left">
					<td><?php echo $rule['s_no'];?></td>
					<td><?php echo $rule['description'];?></td>
					<td><?php echo $rule['short_title'];?></td>
				</tr>
				
			<?php 
			endforeach;?>
				
			</tbody>
		</table>
	</div>
</div>


</div>